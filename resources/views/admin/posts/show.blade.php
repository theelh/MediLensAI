@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto rounded-xl">
<h2 class="text-2xl font-bold mb-4">Post Details</h2>
<p><strong>Title:</strong> {{ $post->title }}</p>
<p><strong>User:</strong> {{ $post->user->name ?? 'N/A' }}</p>
<h3 class="mt-4 font-semibold">Files</h3>
<ul class="list-disc ml-6">
@foreach($post->files as $file)
    <li>{{ $file->title }}</li>
@endforeach
</ul>
<h3 class="mt-4 font-semibold">Media</h3>
<ul class="list-disc ml-6">
@foreach($post->media as $media)
    {{-- File Preview --}}
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Preview</h2>
        @php
            $ext = strtolower(pathinfo($media->path, PATHINFO_EXTENSION));
        @endphp

        @if(in_array($ext, ['jpg','jpeg','png','gif']))
            <img src="{{ asset('storage/' . $media->path) }}" class="w-full max-h-96 object-contain rounded-lg shadow">
        @elseif($ext === 'pdf')
            <iframe src="{{ asset('storage/' . $media->path) }}" class="w-full h-96 rounded-lg border"></iframe>
        @elseif(in_array($ext, ['mp4','webm','ogg']))
            <video controls class="w-full rounded-lg">
                <source src="{{ asset('storage/' . $media->path) }}" type="video/{{ $ext }}">
            </video>
        @else
            <p class="text-gray-500">No preview available for this file type.</p>
        @endif

        {{-- Download Button --}}
        <a href="{{ asset('storage/' . $media->path) }}" 
           download 
           class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            Download File
        </a>
    </div>
@endforeach
</ul>
<h3 class="mt-4 font-semibold">Comments</h3>
<ul class="list-disc ml-6">
    {{-- Comments Section --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Comments</h2>
    @forelse($post->comments as $comment)
        <div class="p-4 mb-2 border rounded-lg bg-gray-100 flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-600">
                    <strong>By:</strong> {{ $comment->user->name ?? 'Unknown' }}
                </p>
                <p>{{ $comment->content }}</p>
            </div>

            {{-- Delete Button --}}
            <form id="delete-comment-{{ $comment->id }}" 
                action="{{ route('admin.pscomments.destroy', $comment->id) }}" 
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
</ul>
<h3 class="mt-4 font-semibold">Likes</h3>
<p>Total Likes: {{ $post->likes->count() }}</p>
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
