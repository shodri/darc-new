<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.edit')->with([
            'title' => 'Nueva Galería',
            'page' => new Page,
            'action' => route('admin.pages.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        Page::create($request->only(['title', 'description', 'section', 'height', 'width']));

        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page)
    {

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'content' => 'nullable|string',
        ]);
    
        $page->update([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')->withSuccess('La galería se ha editado correctamente');
    }
}
