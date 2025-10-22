<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\ReportQuestion;

class QuestionController extends Controller
{
    // List all questions with their users and answers
    public function index()
    {
        $questions = Question::with('user', 'answers')->where('visibility', 'public')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function report($id)
{
    ReportQuestion::create([
        'question_id' => $id,
        'reported_by' => auth()->id(),
        'reason' => 'Inappropriate content', // later can be a textarea
    ]);

    return response()->json(['message' => 'Report sent']);
}


    // Show form to create a new question
    public function create()
    {
        return view('questions.create');
    }

    // Store a new question
    public function store(Request $req)
{
    $user = auth()->user();

    // Limit free plan users to 5 questions
    if (!$user->is_subscribed) {
        $questionCount = Question::where('user_id', $user->id)->count();

        if ($questionCount >= 5) {
            return redirect()->route('questions.index')
                ->with('error', 'Limit reached: Free plan users can ask up to 5 questions only.');
        }
    }

    $validated = $req->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'visibility' => 'required|in:public,private',
    ]);

    Question::create([
        'user_id' => $user->id,
        'title' => $validated['title'],
        'body' => $validated['body'],
        'visibility' => $validated['visibility'], // ✅ use validated data
    ]);

    return redirect()->route('questions.index')
        ->with('success', 'Question created successfully.');
}


    // Show a specific question with answers
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function toggleLike($id)
{
    $question = Question::findOrFail($id);

    $user = auth()->user();

    if ($question->likes()->where('user_id', auth()->id())->exists()) {
        $question->likes()->where('user_id', auth()->id())->delete();
        $liked = false;
    } else {
        $question->likes()->create(['user_id' => auth()->id()]);
        $liked = true;
    }

    return response()->json([
        'liked' => $liked,
        'count' => $question->likes()->count(),
    ]);
}

}
