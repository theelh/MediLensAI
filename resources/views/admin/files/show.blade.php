@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg">

    {{-- File Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">File Details</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Back to Files</a>
    </div>

    {{-- File Information --}}
    <div class="space-y-4">
        <p><strong>Title:</strong> {{ $file->title ?? 'Untitled' }}</p>
        <p><strong>User:</strong> {{ $file->user->name ?? 'N/A' }}</p>
        <p><strong>Path:</strong> {{ $file->path }}</p>
    </div>

    {{-- File Preview --}}
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Preview</h2>
        @php
            $ext = strtolower(pathinfo($file->path, PATHINFO_EXTENSION));
        @endphp

        @if(in_array($ext, ['jpg','jpeg','png','gif']))
            <img src="{{ asset('storage/' . $file->path) }}" class="w-full max-h-96 object-contain rounded-lg shadow">
        @elseif($ext === 'pdf')
            <iframe src="{{ asset('storage/' . $file->path) }}" class="w-full h-96 rounded-lg border"></iframe>
        @elseif(in_array($ext, ['mp4','webm','ogg']))
            <video controls class="w-full rounded-lg">
                <source src="{{ asset('storage/' . $file->path) }}" type="video/{{ $ext }}">
            </video>
        @else
            <p class="text-gray-500">No preview available for this file type.</p>
        @endif

        {{-- Download Button --}}
        <a href="{{ asset('storage/' . $file->path) }}" 
           download 
           class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            Download File
        </a>
    </div>

    {{-- Comments Section --}}
<div class="mt-10">
    <h2 class="text-xl font-semibold mb-4">Comments</h2>
    @forelse($file->comments as $comment)
        <div class="p-4 mb-2 border rounded-lg bg-gray-100 flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-600">
                    <strong>By:</strong> {{ $comment->user->name ?? 'Unknown' }}
                </p>
                <p>{{ $comment->body }}</p>
            </div>

            {{-- Delete Button --}}
            <form id="delete-comment-{{ $comment->id }}" 
                action="{{ route('admin.comments.destroy', $comment->id) }}" 
                method="POST" 
                class="inline-block">
                @csrf
                @method('DELETE')
                <button type="button" 
                        class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600" 
                        onclick="confirmDelete({{ $comment->id }})">
                    Delete
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">No comments yet.</p>
    @endforelse
</div>


    {{-- Insights Section --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Insights</h2>
        @forelse($file->insights as $insight)
            <div class="p-4 mb-2 border rounded-lg bg-gray-100">
                <p>{{ $insight->content }}</p>
            </div>
        @empty
            <p class="text-gray-500">No insights available.</p>
        @endforelse
    </div>
</div>
@endsection

<script>
    function confirmDelete(commentId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This comment will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-comment-${commentId}`).submit();
            }
        });
    }
</script>
