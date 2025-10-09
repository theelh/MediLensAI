<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // List all questions with their users and answers
    public function index()
    {
        $questions = Question::with('user', 'answers')->latest()->get();
        return view('questions.index', compact('questions'));
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

        $req->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Question::create([
            'user_id' => $user->id,
            'title' => $req->title,
            'content' => $req->content,
        ]);

        return redirect()->route('questions.index')
            ->with('success', 'Question created successfully.');
    }

    // Show a specific question with answers
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }
}
