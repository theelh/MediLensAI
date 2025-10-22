@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto rounded-xl">
<h2 class="text-2xl font-bold mb-4">Files</h2>
<table class="w-full table-auto bg-white rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
        <tr class="border-b border-gray-200">
            <td class="px-4 py-2">{{ $file->id }}</td>
            <td class="px-4 py-2">{{ $file->filename }}</td>
           <td class="px-4 py-2">
                @php
                    $extension = strtolower(pathinfo($file->path, PATHINFO_EXTENSION));
                @endphp

                @if(in_array($extension, ['jpg','jpeg','png','gif']))
                    <img src="{{ asset('storage/' . $file->path) }}" class="w-48 h-32 object-cover rounded-lg" />
                @elseif($extension === 'pdf')
                    <a href="{{ asset('storage/' . $file->path) }}" download
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
                        Download PDF
                    </a>
                @else
                    <span class="text-gray-400">{{ strtoupper($extension) }} file</span>
                @endif
            </td>
            <td class="px-4 py-2 space-x-2">
                <a href="{{ route('files.show', $file) }}" class="bg-blue-500 px-2 py-1 rounded hover:bg-blue-600">View</a>
                <form action="{{ route('files.destroy', $file) }}" method="POST" class="inline">
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
<div class="mt-4">{{ $files->links() }}</div>
@endsection