<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    // Lister tous les patients
    public function index()
    {
        $patients = Patient::with('files')->get();
        return response()->json($patients);
    }

    // Créer un patient
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }

    // Détails d’un patient
    public function show(Patient $patient)
    {
        $patient->load('files.insights');
        return response()->json($patient);
    }

    // Mise à jour
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        $patient->update($request->all());
        return response()->json($patient);
    }

    // Supprimer
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'Patient supprimé']);
    }
}
