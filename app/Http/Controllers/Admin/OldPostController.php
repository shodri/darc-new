<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category', 'tags')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = new Post;
        $title = "Crear Nuevo Post";
        $action = route('admin.posts.store');
        return view('admin.posts.edit', compact('action', 'post', 'title', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'tags' => 'array'
        ]);

        // Manejar la creación de nuevas categorías
        if (is_numeric($validated['category_id'])) {
            $category = Category::find($validated['category_id']);
        } else {
            $category = Category::firstOrCreate(['name' => $validated['category_id']]);
        }

        // Crear el post
        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $category->id,
            'user_id' => auth()->id()
        ]);

        // Manejar la creación de nuevos tags
        $tagIds = [];
        if ($request->has('tags')) {
            foreach ($request->tags as $tagNameOrId) {
                if (is_numeric($tagNameOrId)) {
                    $tagIds[] = $tagNameOrId;
                } else {
                    $newTag = Tag::firstOrCreate(['name' => $tagNameOrId]);
                    $tagIds[] = $newTag->id;
                }
            }
        }
        
        $post->tags()->sync($tagIds);


        $image = $request->input('cropped_image');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.jpg';
        Storage::disk('local')->put($imageName, base64_decode($image));

        $post->addMedia(storage_path('app/' . $imageName))->toMediaCollection();

        Storage::disk('local')->delete($imageName);


        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('id')->toArray();
        $title = "Editar Post";
        $action = route('admin.posts.update', $post->id);

        return view('admin.posts.edit', compact('action', 'title', 'post', 'categories', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'tags' => 'array',
            'body' => 'required|string',
        ]);

        // Crear nueva categoría si no existe
        $categoryNameOrId = $request->category_id;
        if (is_numeric($categoryNameOrId)) {
            $categoryId = $categoryNameOrId;
        } else {
            $newCategory = Category::firstOrCreate(['name' => $categoryNameOrId]);
            $categoryId = $newCategory->id;
        }

        // Crear nuevos tags si no existen
        $tagIds = [];
        if ($request->has('tags')) {
            foreach ($request->tags as $tagNameOrId) {
                if (is_numeric($tagNameOrId)) {
                    $tagIds[] = $tagNameOrId;
                } else {
                    $newTag = Tag::firstOrCreate(['name' => $tagNameOrId]);
                    $tagIds[] = $newTag->id;
                }
            }
        }
    
        $post->update([
            'title' => $request->title,
            'category_id' => $categoryId,
            'body' => $request->body,
        ]);
    
        $post->tags()->sync($tagIds);

        $image = $request->input('cropped_image');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.jpg';
        Storage::disk('local')->put($imageName, base64_decode($image));

        $post->addMedia(storage_path('app/' . $imageName))->toMediaCollection();

        Storage::disk('local')->delete($imageName);

        return redirect()->route('admin.posts.index')->with('success', 'Post actualizado exitosamente.');

    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function removeImage(Post $post)
    {
        // Eliminar todas las imágenes asociadas al post
        $post->clearMediaCollection();

        return response()->json(['success' => 'Imagen eliminada exitosamente.']);
    }

    public function uploadImage(Request $request, Post $post)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'cropped_image' => 'required|string',
            'is_main_image' => 'required|boolean'

        ]);
    
        $post = Post::findOrFail($request->post_id);

        $image = $request->input('cropped_image');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.jpg';
        Storage::disk('local')->put($imageName, base64_decode($image));

        if ($request->is_main_image) {
            $post->addMedia(storage_path('app/' . $imageName))->toMediaCollection('main_image');
        } else {
            $post->addMedia(storage_path('app/' . $imageName))->toMediaCollection('summernote_images');
        }

        Storage::disk('local')->delete($imageName);

        $url = $post->getFirstMediaUrl(); // Esto asume que estás usando Spatie Media Library

        return response()->json(['url' => $url]);
    }
}
