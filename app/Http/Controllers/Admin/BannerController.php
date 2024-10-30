<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banners.index')->with(['banners' => Banner::all()]);
    }


    public function create()
    {
        return view('admin.banners.edit')->with([
            'title' => 'Nuevo Banner',
            'banner' => new Banner,
            'action' => route('admin.banners.store'),
        ]);
    }
    public function store(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();

        $banner = Banner::create($data);
    
        return redirect()->route('admin.banners.edit', ['banner' => $banner->id])
                         ->with('success', 'Banner creado y guardado exitosamente.');
    }

    public function edit(Banner $banner): View
    {

        return view('admin.banners.edit')->with([
            'title' => 'Editar Banner',
            'banner' => $banner,
            'action' => route('admin.banners.update', ['banner' => $banner->id]),
        ]);
    }

    public function update(BannerRequest $request, Banner $banner): View
    {
        $data = $request->validated();

        $banner->update($data);

        return view('admin.banners.index')->with([
            'success' => '¡Banner editado exitosamente!',
            'banners' => Banner::all(),
        ]);

    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect(route('admin.banners.index'))->withSuccess('¡El Banner fue eliminado correctamente !');
    }

    public function crop_store(Banner $banner, Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg',
            'type' => 'string',
        ]);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $type = $request->input('type');
            $imagePath = $image->store('temp', 'local');

            //$banner->clearMediaCollection('banners');  // Eliminar imágenes anteriores si es necesario
            $banner->addMedia(storage_path('app/' . $imagePath))
                    ->withCustomProperties(['type' => $type])  // Agregar la propiedad personalizada 'type'
                    ->toMediaCollection('banners', 'uploads');

            Storage::disk('local')->delete($imagePath);

            return response()->json(['success' => 'Imagen recortada guardada exitosamente.']);
        }
    }

    public function destroyImage(Banner $banner, $id)
    {
        // dd($banner, $id);
        $media = $banner->getMedia('banners');
        $image = $media->where('id', $id)->first();
        $image->delete();

        return redirect()->back();
    }

}
