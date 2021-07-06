<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function allContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact()
    {
        return view('admin.contact.create');
    }

    public function storeContact(Request $request)
    {
        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('all.contact')->with('success', 'Contact Profile has been Added Successfully');
    }

    public function editContact($id)
    {
        $contacts = Contact::find($id);
        return view('admin.contact.edit', compact('contacts'));
    }

    public function updateContact(Request $request, $id)
    {
        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('all.contact')->with('success', 'Contact Profile has been updated Successfully');
    }

    public function deleteContact($id)
    {
        Contact::find($id)->delete();
        return redirect()->route('all.contact')->with('success', 'Contact Profile has ben deleted successfully ');
    }

    public function contact()
    {
        $contacts = DB::table('contacts')->first();
        return view('pages.contact', compact('contacts'));
    }

    public function contactForm(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('contact')->with('success', 'Contact Form has been Inserted Successfully');
    }
}