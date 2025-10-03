<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Jobs\ProcessUploadedFile;

class FileWebController extends Controller
{
    public function index()
    {
        $files = File::with('insights')->latest()->get();
        return view('files.index', compact('files'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'file' => 'required|file|max:10240'
        ]);

        $path = $req->file('file')->store('uploads', 'public');

        $file = File::create([
            'patient_id' => null,
            'uploaded_by' => auth()->id() ?? 1, // fallback test
            'filename' => $req->file('file')->getClientOriginalName(),
            'path' => $path,
            'mime' => $req->file('file')->getMimeType(),
            'size' => $req->file('file')->getSize(),
        ]);

        ProcessUploadedFile::dispatch($file);

        return redirect()->route('files.index')->with('success', 'Fichier uploadé avec succès.');
    }

    // Liste tous les fichiers
    public function all()
    {
        $files = File::with('patient')->latest()->get();
        return view('files.all', compact('files'));
    }

    // Détails d'un fichier
    public function show(File $file)
    {
        $file->load('insights');
        return view('files.show', compact('file'));
    }
}
