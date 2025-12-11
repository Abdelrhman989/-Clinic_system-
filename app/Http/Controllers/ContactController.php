<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('front.contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
            'subject' => 'required|min:3|max:255',
            'message' => 'required|min:3|max:255',
        ]);
        Contact::create($request->all());
        return redirect()->route('front.contact')->with('success', 'Your message has been sent successfully');
    }
    
}
