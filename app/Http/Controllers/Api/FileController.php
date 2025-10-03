<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Jobs\ProcessUploadedFile;

class FileController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'file' => 'required|file|max:10240'
        ]);

        $path = $req->file('file')->store('uploads', 'public');

        $file = File::create([
            'patient_id' => $req->input('patient_id'),
            'uploaded_by' => $req->user()->id,
            'filename' => $req->file('file')->getClientOriginalName(),
            'path' => $path,
            'mime' => $req->file('file')->getMimeType(),
            'size' => $req->file('file')->getSize(),
        ]);

        ProcessUploadedFile::dispatch($file);

        return response()->json(['id' => $file->id, 'status' => $file->status]);
    }

    public function status(File $file)
    {
        return response()->json([
            'status' => $file->status,
            'insights' => $file->insights
        ]);
    }
}

