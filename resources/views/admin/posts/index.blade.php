@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto rounded-xl">
<h2 class="text-2xl font-bold mb-4">Posts</h2>
<table class="w-full table-auto bg-gray-200 rounded">
    <thead>
        <tr class="bg-gray-300">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr class="border-b border-gray-700">
            <td class="px-4 py-2">{{ $post->id }}</td>
            <td class="px-4 py-2">{{ $post->title }}</td>
            <td class="px-4 py-2">{{ $post->user->name ?? 'N/A' }}</td>
            <td class="px-4 py-2 space-x-2">
                <a href="{{ route('posts.show', $post) }}" class="bg-blue-500 px-2 py-1 rounded hover:bg-blue-600">View</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection