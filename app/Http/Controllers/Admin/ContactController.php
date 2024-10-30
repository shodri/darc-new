<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\CurriculumContact;

class ContactController extends Controller
{
    public function contacts()
    {
        return view('admin.contacts.index')->with(['contacts' => Contact::orderBy('created_at', 'desc')->get()]);
    }

    public function curriculums()
    {
        return view('admin.contacts.curriculums')->with(['curriculums' => CurriculumContact::orderBy('created_at', 'desc')->get()]);
    }
}
