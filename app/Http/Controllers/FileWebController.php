<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Jobs\ProcessUploadedFile;

class FileWebController extends Controller
{
    // List all files for the logged-in user
    public function index()
    {
        $files = File::with('insights')->latest()->get();
        return view('files.index', compact('files'));
    }

    // Store a newly uploaded file
    public function store(Request $req)
    {
        $user = auth()->user();

        // Limit free plan users to 3 uploads
        if (!$user->is_subscribed) {
            $uploadedCount = File::where('uploaded_by', $user->id)->count();

            if ($uploadedCount >= 3) {
                return redirect()->back()
                    ->with('error', 'Limit reached: Free plan users can upload up to 3 files only.');
            }
        }

        $req->validate([
            'file' => 'required|file|max:10240',
            'visibility' => 'required|in:public,private', // max 10MB
        ]);

        $path = $req->file('file')->store('uploads', 'public');

        $file = File::create([
            'uploaded_by' => $user->id,
            'filename' => $req->file('file')->getClientOriginalName(),
            'visibility' => $req->visibility,
            'path' => $path,
            'mime' => $req->file('file')->getMimeType(),
            'size' => $req->file('file')->getSize(),
        ]);

        ProcessUploadedFile::dispatch($file);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    // List all files for admin or management
    public function all()
{
    $files = File::with('user')
        ->where('visibility', 'public') // ✅ Only public files
        ->latest()
        ->get();

    return view('files.all', compact('files'));
}


    // Show details of a specific file
    public function show(File $file)
    {
        $file->load('insights');
        return view('files.show', compact('file'));
    }

    // Delete a file
    public function destroy(File $file)
    {
        $fileRecord = File::find($file->id);

        if (!$fileRecord) {
            return redirect()->back()
                ->with('error', 'File not found.');
        }

        $fileRecord->delete();

        return redirect()->back()
            ->with('success', 'File deleted successfully.');
    }
}
