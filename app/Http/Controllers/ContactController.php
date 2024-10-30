<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $contact = Contact::create($data);

        return redirect()->back()->with('success', 'El formulario ha sido enviado correctamente.');
    }
}

