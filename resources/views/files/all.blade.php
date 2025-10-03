@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">📂 Fichiers uploadés</h2>

    <table class="w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Nom du fichier</th>
                <th class="p-3 border">Patient</th>
                <th class="p-3 border">Statut</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $file->id }}</td>
                    <td class="p-3">{{ $file->filename }}</td>
                    <td class="p-3">{{ $file->patient->metadata['name'] ?? '—' }}</td>
                    <td class="p-3">
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
                    <td class="p-3">
                        <a href="{{ route('files.show', $file) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                           Voir détails
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
