@extends('layouts.app')

@section('content')
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="max-w-3xl z-20 mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">📄 Détails du fichier</h2>

        <p><strong>Nom du fichier :</strong> {{ $file->filename }}</p>
        <p><strong>Patient :</strong> {{ $file->patient->metadata['name'] ?? '—' }}</p>
        <p><strong>Statut :</strong>
            @if($file->status === 'done')
                <span class="text-green-600 font-semibold">✅ Terminé</span>
            @elseif($file->status === 'processing')
                <span class="text-yellow-600 font-semibold">⏳ En cours</span>
            @elseif($file->status === 'failed')
                <span class="text-red-600 font-semibold">❌ Échec</span>
            @else
                <span class="text-gray-600">En attente</span>
            @endif
        </p>

        <h3 class="text-lg font-bold mt-4 mb-2">💡 Insights</h3>
        @if($file->insights->count())
            <ul class="list-disc list-inside">
                @foreach($file->insights as $insight)
                    <li>
                        <strong>Type :</strong> {{ $insight->type }} <br>
                        <strong>Résumé :</strong> {{ $insight->summary ?? '—' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Pas encore d'insights générés pour ce fichier.</p>
        @endif

        <a href="{{ route('files.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
            ← Retour à la liste
        </a>
    </div>
</section>
@endsection