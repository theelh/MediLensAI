@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-3">{{ $question->title }}</h1>
    <p class="text-gray-700 mb-4">{{ $question->body }}</p>

    <h3 class="text-lg font-semibold mb-2">Answers:</h3>
    @foreach($question->answers as $answer)
        <div class="bg-gray-100 p-3 rounded mb-2">
            <p><strong>Dr. {{ $answer->doctor->name ?? 'Unknown' }}:</strong></p>
            <p>{{ $answer->body }}</p>
            <span class="text-xs text-gray-500">{{ $answer->created_at->diffForHumans() }}</span>
        </div>
    @endforeach

    <a href="{{ route('admin.reportsques.index') }}"
       class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded">
       Back to Reports
    </a>
</div>
@endsection
