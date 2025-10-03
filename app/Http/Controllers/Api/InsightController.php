<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Insight;
use App\Models\File;

class InsightController extends Controller
{
    // Lister tous les insights
    public function index()
    {
        $insights = Insight::with('file.patient')->get();
        return response()->json($insights);
    }

    // Créer un insight pour un fichier
    public function store(Request $request)
    {
        $request->validate([
            'file_id' => 'required|exists:files,id',
            'type' => 'required|string',
            'content' => 'nullable|array',
            'summary' => 'nullable|string',
            'confidence' => 'nullable|numeric',
        ]);

        $insight = Insight::create($request->all());
        return response()->json($insight, 201);
    }

    // Détails
    public function show(Insight $insight)
    {
        $insight->load('file.patient');
        return response()->json($insight);
    }

    // Mise à jour
    public function update(Request $request, Insight $insight)
    {
        $request->validate([
            'type' => 'nullable|string',
            'content' => 'nullable|array',
            'summary' => 'nullable|string',
            'confidence' => 'nullable|numeric',
        ]);

        $insight->update($request->all());
        return response()->json($insight);
    }

    // Supprimer
    public function destroy(Insight $insight)
    {
        $insight->delete();
        return response()->json(['message' => 'Insight supprimé']);
    }
}
