<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DoctorValidationController extends Controller
{
    public function index()
    {
        $pendingDoctors = User::where('role', 'doctor')
            ->get();

        return view('admin.doctors.index', compact('pendingDoctors'));
    }

    public function validateDoctor(User $user)
    {
        $user->is_verified_doctor = true;
        $user->is_subscribed = true;
        $user->save();

        return redirect()->back()->with('success', 'Doctor validated succefully.');
    }

    public function unvalidateDoctor(User $user): RedirectResponse
    {
        $user->is_verified_doctor = false;
        $user->is_subscribed = false;
        $user->save();

        return redirect()->back()->with('success', 'Doctor unvalidated succefully.');
    }

}