<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'answers')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        Question::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'body'    => $request->body,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question publiée avec succès !');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }
}