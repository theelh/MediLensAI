@extends('layouts.app')

@section('content')
<section class="relative h-screen flex items-center justify-center overflow-hidden">
<div class=" w-[52vw] shadow-xl shadow-black/30 bg-white rounded-xl z-20 mx-auto p-6">
    <h1 class="text-2xl font-bold">{{ $question->title }}</h1>
    <p class="mb-4">{{ $question->body }}</p>
    <p>Visibility : {{$question->visibility}}</p>

    <h2 class="text-xl mt-6 font-semibold">Answer :</h2>
    @forelse($question->answers as $answer)
        <div class="border p-3 rounded mb-2 bg-gray-100">
            <p>{{ $answer->body }}</p>
            <div class="flex items-center mt-2">
                <p class="text-sm text-gray-600">Answred by Dr. {{ $answer->doctor->name }}</p>
                <img class="w-4 h-4 ml-2" src="{{ asset('svg/download.svg') }}" />
            </div>
        </div>
    @empty
        <p>No response yet.</p>
    @endforelse

    @if(auth()->check() && auth()->user()->role === 'doctor')
        <form method="POST" action="{{ route('answers.store', $question) }}" class="mt-4">
            @csrf
            <textarea name="body" class="w-full border rounded p-2" placeholder="Answer patient..."></textarea>
            <button class="bg-green-600 text-white px-4 py-2 rounded mt-2">Submit</button>
        </form>
    @endif
</div>
</section>
@endsection