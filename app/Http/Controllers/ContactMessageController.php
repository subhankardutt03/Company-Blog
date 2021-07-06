<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function allContactMessage()
    {
        $contactMessage = ContactForm::all();
        return view('admin.contact-message.index', compact('contactMessage'));
    }

    public function deleteContactMessage($id)
    {
        ContactForm::find($id)->delete();
        return redirect()->route('allContact.message')->with('success', 'Contact message has been Deleted Successfully');
    }
}