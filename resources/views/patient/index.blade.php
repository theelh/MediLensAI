@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">👤 Patients</h2>

    {{-- Formulaire ajout patient --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('patients.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf
            <input type="text" name="dob" placeholder="Date de naissance (YYYY-MM-DD)" class="border p-2 rounded">
            <select name="gender" class="border p-2 rounded">
                <option value="">Sexe</option>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
            <input type="text" name="metadata[name]" placeholder="Nom" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</button>
        </form>
    </div>

    {{-- Liste des patients --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">DOB</th>
                    <th class="p-2 border">Sexe</th>
                    <th class="p-2 border">Fichiers / Insights</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td class="p-2 border">{{ $patient->id }}</td>
                        <td class="p-2 border">{{ $patient->metadata['name'] ?? '-' }}</td>
                        <td class="p-2 border">{{ $patient->dob ?? '-' }}</td>
                        <td class="p-2 border">{{ $patient->gender ?? '-' }}</td>
                        <td class="p-2 border">
                            @foreach($patient->files as $file)
                                <div class="mb-1">
                                    📄 {{ $file->filename }}
                                    @foreach($file->insights as $insight)
                                        <div class="ml-4 text-sm text-gray-700">💡 {{ $insight->summary ?? 'Pas encore' }}</div>
                                    @endforeach
                                </div>
                            @endforeach
                        </td>
                        <td class="p-2 border flex gap-2">
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Supprimer ce patient ?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection