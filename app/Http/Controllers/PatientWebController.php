<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientWebController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }

    public function service()
    {
        return view('service');
    }

    public function file()
    {
        $patients = Patient::with('files.insights')->get();
        return view('patients.index', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé.');
    }
}