@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">📂 Mes fichiers médicaux</h2>

    {{-- Formulaire d’upload --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf
            <input type="file" name="file" class="border p-2 rounded w-full" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Upload
            </button>
        </form>
    </div>

    {{-- Liste des fichiers --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-3">Historique</h3>
        <a href="{{route('files.all')}}">View all files</a>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Statut</th>
                    <th class="p-2 border">Résumé</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td class="p-2 border">{{ $file->filename }}</td>
                        <td class="p-2 border">
                            @if($file->status === 'done')
                                <span class="text-green-600 font-semibold">✅ Terminé</span>
                            @elseif($file->status === 'processing')
                                <span class="text-yellow-600 font-semibold">⏳ En cours</span>
                            @elseif($file->status === 'failed')
                                <span class="text-red-600 font-semibold">❌ Échec</span>
                            @else
                                <span class="text-gray-600">En attente</span>
                            @endif
                        </td>
                        <td class="p-2 border">
                            @if($file->insights->count())
                                <p class="text-sm text-gray-700">{{ $file->insights->first()->summary }}</p>
                            @else
                                <em class="text-gray-400">Pas encore disponible</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection