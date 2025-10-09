<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function pricin()
    {
        return view('pricing');
    }

    public function about(){
        return view('about');
    }


    //Contact controller
    public function contact(){
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        Mail::to('support@medilens.group')->send(new ContactMail($validated));

        return back()->with('success', 'Message send succefully !');
    }
}
