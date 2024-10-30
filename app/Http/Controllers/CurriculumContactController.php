<?php

namespace App\Http\Controllers;

use App\Models\CurriculumContact;
use Illuminate\Http\Request;
use App\Http\Requests\CurriculumContactRequest;
use Illuminate\Support\Facades\Storage;

class CurriculumContactController extends Controller
{
    public function store(CurriculumContactRequest $request)
    {
        // dd($request);
        $data = $request->validated();
        $curriculumContact = CurriculumContact::create($data);

        if ($request->hasFile('cv')) {
            $curriculumContact->addMedia($request->file('cv'))->toMediaCollection('cvs');
        }

        return redirect()->back()->with('success', 'El Curriculum ha sido enviado correctamente.');
    }
}
