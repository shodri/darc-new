<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Banner;
use App\Models\Page;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function info()
    {
        echo phpinfo();
    }
    public function construccion()
    {
        return view('front.construccion');
    }
    public function index()
    {
        $banners = Banner::orderBy('order', 'asc')->get();
        $recentPosts = Post::latest()->take(5)->get();

        return view('front.index', compact('banners', 'recentPosts'));
    }

    public function empresa()
    {
        $page = Page::where('url', 'empresa')->first();
        return view('front.empresa', compact('page'));
    }

    public function servicios()
    {
        $page = Page::where('url', 'servicios')->first();
        return view('front.servicios', compact('page'));
    }

    public function rrhh()
    {
        return view('front.rrhh');
    }

    public function sucursales()
    {
        return view('front.sucursales');
    }

    public function peugeot()
    {
        return view('front.peugeot');
    }
    public function citroen()
    {
        return view('front.citroen');
    }
    public function ds()
    {
        return view('front.ds');
    }

    public function blog(Request $request)
    {
        $query = Post::orderBy('created_at', 'desc');
        $selectedCategory = null;
        $selectedTag = null;

        // Almacenar filtros en la sesión
        if ($request->has('category')) {
            session(['selectedCategory' => $request->category]);
        }
        if ($request->has('clear_category')) {
            session()->forget('selectedCategory');
        }

        if ($request->has('tag')) {
            session(['selectedTag' => $request->tag]);
        } elseif ($request->has('clear_tag')) {
            session()->forget('selectedTag');
        }

        // Recuperar filtros de la sesión
        $sessionCategory = session('selectedCategory', null);
        $sessionTag = session('selectedTag', null);

        // Filtrar por categoría
        if ($sessionCategory) {

            if (is_numeric($sessionCategory)) {
                $selectedCategory = Category::findOrFail($sessionCategory);
            } else {
                $selectedCategory = Category::where('name', $sessionCategory)->firstOrFail();
            }
            $query->where('category_id', $selectedCategory->id);
        }

        // Filtrar por tag
        if ($sessionTag) {
            if (is_numeric($sessionTag)) {
                $selectedTag = Tag::findOrFail($sessionTag);
            } else {
                $selectedTag = Tag::where('name', $sessionTag)->firstOrFail();
            }
            $query->whereHas('tags', function ($q) use ($selectedTag) {
                $q->where('tags.id', $selectedTag->id);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(6);

        // Obtener categorías que tienen posts dentro de la selección actual
        $categories = Category::whereHas('posts', function ($q) use ($selectedTag) {
            if ($selectedTag) {
                $q->whereHas('tags', function ($q) use ($selectedTag) {
                    $q->where('tags.id', $selectedTag->id);
                });
            }
        })->get();

        // Obtener tags que tienen posts dentro de la selección actual
        $tags = Tag::whereHas('posts', function ($q) use ($selectedCategory) {
            if ($selectedCategory) {
                $q->where('category_id', $selectedCategory->id);
            }
        })->get();

        $recentPosts = Post::latest()->take(5)->get();


        return view('front.blog', compact('posts', 'categories', 'tags', 'selectedCategory', 'selectedTag', 'recentPosts'));
    }


    public function post(Request $request, Post $post)
    {

        $selectedCategory = null;
        $selectedTag = null;

        // Almacenar filtros en la sesión
        if ($request->has('category')) {
            session(['selectedCategory' => $request->category]);
        }
        if ($request->has('clear_category')) {
            session()->forget('selectedCategory');
        }

        if ($request->has('tag')) {
            session(['selectedTag' => $request->tag]);
        } elseif ($request->has('clear_tag')) {
            session()->forget('selectedTag');
        }

        // Recuperar filtros de la sesión
        $sessionCategory = session('selectedCategory', null);
        $sessionTag = session('selectedTag', null);

        // Filtrar por categoría
        if ($sessionCategory) {

            if (is_numeric($sessionCategory)) {
                $selectedCategory = Category::findOrFail($sessionCategory);
            } else {
                $selectedCategory = Category::where('name', $sessionCategory)->firstOrFail();
            }
        }

        // Filtrar por tag
        if ($sessionTag) {
            if (is_numeric($sessionTag)) {
                $selectedTag = Tag::findOrFail($sessionTag);
            } else {
                $selectedTag = Tag::where('name', $sessionTag)->firstOrFail();
            }

        }

        $categories = Category::whereHas('posts', function ($q) use ($selectedTag) {
            if ($selectedTag) {
                $q->whereHas('tags', function ($q) use ($selectedTag) {
                    $q->where('tags.id', $selectedTag->id);
                });
            }
        })->get();

        // Obtener tags que tienen posts dentro de la selección actual
        $tags = Tag::whereHas('posts', function ($q) use ($selectedCategory) {
            if ($selectedCategory) {
                $q->where('category_id', $selectedCategory->id);
            }
        })->get();

        $recentPosts = Post::latest()->take(5)->get();

        return view('front.post', compact('post', 'categories', 'tags', 'selectedCategory', 'selectedTag', 'recentPosts'));
    }



    public function contacto()
    {
        return view('front.contacto');
    }
}
