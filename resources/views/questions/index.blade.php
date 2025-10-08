@extends('layouts.app')

@section('content')
<section class="relative h-screen flex items-center justify-center overflow-hidden">
<div class=" w-[52vw] shadow-xl shadow-black/30 bg-white rounded-xl z-20 mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Questions Publiques</h1>

    <a href="{{ route('questions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Poser une question</a>

    <div class="mt-6">
        @foreach($questions as $q)
            <div class="border p-4 rounded mb-4">
                <h2 class="text-xl font-semibold">{{ $q->title }}</h2>
                <p class="text-gray-700">{{ $q->body }}</p>
                <p class="text-sm text-gray-500">Posté par {{ $q->user->name }}</p>

                <a href="{{ route('questions.show', $q) }}" class="text-blue-600 underline">Voir détails</a>
            </div>
        @endforeach
    </div>
</div>
</section>
@endsection