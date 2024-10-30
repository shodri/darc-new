<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Landing;
use App\Http\Requests\LandingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        return view('admin.landings.index')->with(['landings' => Landing::all()]);
    }


    public function create()
    {
        return view('admin.landings.edit')->with([
            'title' => 'Nueva Landing',
            'landing' => new Landing,
            'action' => route('admin.landings.store'),
        ]);
    }

    public function store(LandingRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['url'] = Str::slug($data['url']);
        $landing = Landing::create($data);

        return redirect(route('admin.landings.index'))->withSuccess('Landing creada correctamente !');

    }

    public function edit(Landing $landing) :View
    {

        return view('admin.landings.edit')->with([
            'title' => 'Editar Landing',
            'landing' => $landing,
            'action' => route('admin.landings.update', ['landing' => $landing->id]),
        ]);
    }

    public function  update(LandingRequest $request, Landing $landing): View
    {
        $data = $request->validated();

        $data['url'] = Str::slug($data['url']);
        $landing->update($data);

        return view('admin.landings.index')->with([
            'success' => 'Landing editada exitosamente !', 
            'landings' => Landing::all(),
        ]);

    }

    public function destroy(Landing $landing)
    {
        $landing->delete();
        return redirect(route('admin.landings.index'))->withSuccess('¡La Landing fue borrada correctamente !');
    }

    public function showLanding($url) : View
    {
        $landing = Landing::where('url', $url)->firstOrFail();

        $landing->content = str_replace('../', $landing->site_base, $landing->content);
        $landing->content = str_replace('%%_value1_%%', $landing->value_1, $landing->content);
        $landing->content = str_replace('%%_value2_%%', $landing->value_2, $landing->content);

        return view('admin.landings.show')->with(['landing' => $landing]);
    }

    public function updateField(Request $request)
    {
        $landing = Landing::find($request->id);
        if ($landing) {
            $landing->value_1 = $request->value_1;
            $landing->value_2 = $request->value_2;
            $landing->save();
            return response()->json(['success' => true, 'message' => 'Valores actualizados correctamente']);
        }
        return response()->json(['success' => false, 'message' => 'Error al actualizar los valores']);
    }

    public function home() : View
    {
        $landing = Landing::inRandomOrder()->firstOrFail();

        $landing->content = str_replace('../', $landing->site_base, $landing->content);
        $landing->content = str_replace('%%_value1_%%', $landing->value_1, $landing->content);
        $landing->content = str_replace('%%_value2_%%', $landing->value_2, $landing->content);

        return view('admin.landings.show')->with(['landing' => $landing]);
    }
}
