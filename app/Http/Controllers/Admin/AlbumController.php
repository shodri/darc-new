<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::all();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.edit')->with([
            'title' => 'Nueva Galería',
            'album' => new Album,
            'action' => route('admin.albums.store'),
        ]);
    }

    public function store(Request $request)
    {
        // Validación de los datos del request (si es necesario)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'section' => 'nullable|string',
            'height' => 'nullable|integer',
            'width' => 'nullable|integer',
        ]);

        // Creación del nuevo álbum utilizando asignación masiva
        Album::create($request->only(['title', 'description', 'section', 'height', 'width']));

        return redirect()->route('admin.albums.index');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit')->with([
            'title' => 'Editar Galería',
            'album' => $album,
            'action' => route('admin.albums.update', ['album' => $album->id]),
        ]);
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'section' => 'nullable|string',
            'height' => 'nullable|integer',
            'width' => 'nullable|integer',
        ]);

        $album->update([
            'title' => $request->title,
            'description' => $request->description,
            'section' => $request->section,
            'height' => $request->height,
            'width' => $request->width,
        ]);

        return redirect()->route('admin.albums.index')->withSuccess('La galería se ha editado correctamente');
    }


    public function photos(Album $album)
    {
        $photos = $album->getMedia();
        return view('admin.albums.photos', compact('album', 'photos'));
    }

    public function integrantes(Album $album)
    {
        $photos = $album->getMedia();
        return view('admin.albums.integrantes', compact('album', 'photos'));
    }

    public function crop_store(Album $album, Request $request)
    {
        if ($request->has('photo_id') && $request->photo_id != "" ) {
            //$media = $album->getMedia()->where('id', $request->photo_id);
            $media = Media::findOrFail($request->photo_id);

            // Procesar la nueva imagen si se proporciona
            if ($request->has('image')) {
                $image = $request->image;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10) . '.png';
                Storage::disk('local')->put($imageName, base64_decode($image));

                $media = $album->getMedia();
                $image = $media->where('id', $request->photo_id)->first();
                $image->delete();

                $media = $album->addMedia(storage_path('app/' . $imageName))->toMediaCollection(); // Asegurarse de que esta línea es correcta en tu entorno

                // Eliminar el archivo temporal
                Storage::disk('local')->delete($imageName);
            }

            // Actualizar propiedades personalizadas según la sección del álbum
            if ($album->section == 'integrantes') {
                $media->setCustomProperty('name', $request->name);
                $media->setCustomProperty('type', $request->type);
                $media->setCustomProperty('rol', $request->rol);
                $media->setCustomProperty('institution', $request->institution);
                $media->setCustomProperty('order', $request->order);
            } else {
                $media->setCustomProperty('title', $request->title);
                $media->setCustomProperty('description', $request->description);
                $media->setCustomProperty('order', $request->order);
            }

            // Guardar los cambios en el medio
            $media->save();

        } else {
            // Proceso para crear una nueva imagen si no se proporciona photo_id
            if ($request->has('image')) {
                // Procesar la nueva imagen como lo hiciste antes para crear un nuevo medio
                $image = $request->image;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10) . '.png';
                Storage::disk('local')->put($imageName, base64_decode($image));

                $media = $album->addMedia(storage_path('app/' . $imageName))->toMediaCollection();

                // Agregar propiedades personalizadas según la sección del álbum
                if ($album->section == 'integrantes') {
                    $media->setCustomProperty('name', $request->name);
                    $media->setCustomProperty('type', $request->type);
                    $media->setCustomProperty('rol', $request->rol);
                    $media->setCustomProperty('institution', $request->institution);
                    $media->setCustomProperty('order', $request->order);

                } else {
                    $media->setCustomProperty('title', $request->title);
                    $media->setCustomProperty('description', $request->description);
                    $media->setCustomProperty('order', $request->order);

                }

                // Guardar el nuevo medio
                $media->save();

                // Eliminar el archivo temporal
                Storage::disk('local')->delete($imageName);
            }
        }
        return response()->json(['success' => 'Crop Image Saved/Uploaded Successfully']);
    }

    public function updateOrder(Request $request, Album $album)
    {
        foreach ($request->order as $order) {
            $mediaItem = $album->getMedia()->find($order['id']);
            $mediaItem->setCustomProperty('order', $order['order']);
            $mediaItem->save();
        }

        return response()->json(['success' => 'Order updated successfully']);
    }

    public function updateImageText(Request $request, Album $album)
    {
        $mediaItem = $album->getMedia()->find($request->input('id'));
        if ($mediaItem) {
            $mediaItem->setCustomProperty('title', $request->input('title'));
            $mediaItem->setCustomProperty('description', $request->input('description'));
            $mediaItem->setCustomProperty('name', $request->input('name'));
            $mediaItem->setCustomProperty('type', $request->input('type'));
            $mediaItem->setCustomProperty('rol', $request->input('rol'));
            $mediaItem->setCustomProperty('institution', $request->input('institution'));
            $mediaItem->save();

            return response()->json(['success' => 'Image text updated successfully']);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->back();
    }

    public function upload(Request $request, Album $album)
    {
        if ($request->has('image')) {
            $album->addMedia($request->image)->toMediaCollection();
        }
        return redirect()->back();
    }

    public function showImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();

        return view('admin.albums.image-show', compact('album', 'image'));
    }

    public function destroyImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();
        $image->delete();

        return redirect()->back();
    }
}
