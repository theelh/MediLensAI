@extends('layouts.app')

@section('content')
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="max-w-3xl z-20 mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">📄 File Details</h2>

        <p><strong>File Name:</strong> {{ $file->filename }}</p>
        <p><strong>Patient:</strong> {{ $file->patient->metadata['name'] ?? '—' }}</p>
        <p><strong>Status:</strong>
            @if($file->status === 'done')
                <span class="text-green-600 font-semibold">✅ Completed</span>
            @elseif($file->status === 'processing')
                <span class="text-yellow-600 font-semibold">⏳ Processing</span>
            @elseif($file->status === 'failed')
                <span class="text-red-600 font-semibold">❌ Failed</span>
            @else
                <span class="text-gray-600">Pending</span>
            @endif
        </p>

        <h3 class="text-lg font-bold mt-4 mb-2">💡 Insights</h3>
        @if($file->insights->count())
            <ul class="list-disc list-inside">
                @foreach($file->insights as $insight)
                    <li>
                        <strong>Type:</strong> {{ $insight->type }} <br>
                        <strong>Summary:</strong> {{ $insight->summary ?? '—' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No insights generated for this file yet.</p>
        @endif

        <a href="{{ route('files.all') }}" class="mt-4 inline-block bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
            ← Back to list
        </a>
    </div>
</section>
@endsection
