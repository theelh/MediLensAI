<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index(){
        return view('doctor.dashboard');
    }

    public function showCertificationForm()
    {
        return view('doctor.upload_certificate');
    }

    public function uploadCertificate(Request $request)
    {
        $request->validate([
            'certificate' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        $path = $request->file('certificate')->store('certificates', 'public');

        $user = Auth::user();
        $user->doctor_certificate = $path;
        $user->role = 'doctor'; // il devient "docteur en attente de validation"
        $user->is_verified_doctor = false;
        $user->save();

        return redirect()->back()->with('success', 'Certificat envoyé. En attente de validation par un administrateur.');
    }
}