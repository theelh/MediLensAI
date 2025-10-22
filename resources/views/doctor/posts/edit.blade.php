@extends('layouts.doctor')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">✏️ Modifier le post</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Titre</label>
            <input type="text" name="title" value="{{ $post->title }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Description</label>
            <textarea name="description" class="w-full border rounded p-2" rows="4">{{ $post->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Ajouter des fichiers (images/PDF)</label>
            <input type="file" name="media[]" multiple accept="image/*,application/pdf" class="w-full">
        </div>

        <div class="mb-4">
            <h3 class="font-semibold mb-2">📎 Fichiers existants :</h3>
            <div class="grid grid-cols-2 gap-3">
                @foreach($post->media as $media)
                    <div class="relative">
                        @if($media->type === 'image')
                            <img src="{{ asset('storage/'.$media->path) }}" class="w-full h-32 object-cover rounded">
                        @else
                            <div class="flex items-center justify-center h-32 bg-gray-100 rounded">
                                <a href="{{ asset('storage/'.$media->path) }}" target="_blank" class="text-blue-600 underline">
                                    📄 Voir le PDF
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>

            <form action="{{ route('doctor.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Supprimer ce post ?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Supprimer
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
