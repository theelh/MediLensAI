<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Question;
use App\Models\File;

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
    public function publicFeed(Request $request)
{
    $questions = Question::where('visibility', 'public')
        ->with(['user', 'answers.doctor'])
        ->latest()
        ->paginate(5);

    if ($request->ajax()) {
        return view('partials.questions', compact('questions'))->render();
    }

    return view('feed', compact('questions'));
}
public function loadFileComments(File $file)
{
    $comments = $file->comments()->with('user')->latest()->get();

    return response()->json([
        'comments' => $comments->map(function ($c) {
            return [
                'user' => $c->user->name ?? 'Utilisateur',
                'role' => $c->user->role ?? null,
                'content' => $c->body,  // assuming 'body' is the column in comments table
                'created_at' => $c->created_at->diffForHumans(),
            ];
        })
    ]);
}

public function fileFeed(Request $request)
{
    $files = File::where(function($q){
            $q->where('visibility','public')
              ->orWhere(function($q2){
                  $q2->where('visibility','private')
                     ->where('patient_id', auth()->id());
              });
        })
        ->with(['likes','comments.user','insights'])
        ->latest()
        ->paginate(5);

    if($request->ajax()) {
        return view('files.partials.file_list', compact('files'))->render();
    }

    return view('files.feed', compact('files'));
}

public function toggleLike($id)
{
    $file = File::findOrFail($id);
    $user = auth()->user();

    $existingLike = $file->likes()->where('user_id', $user->id)->first();

    if ($existingLike) {
        $existingLike->delete();
        $liked = false;
    } else {
        $file->likes()->create(['user_id' => $user->id]);
        $liked = true;
    }

    return response()->json([
        'liked' => $liked,
        'count' => $file->likes()->count(),
    ]);
}

public function storeComment(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $file = File::findOrFail($id);

    $comment = $file->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'body' => $comment->body,
            'user_name' => $comment->user->name,
            'created_at' => $comment->created_at->diffForHumans(),
        ],
    ]);
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