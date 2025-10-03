@extends('layouts.admin')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">👨‍⚕️ Docteurs en attente de validation</h2>

    @foreach($pendingDoctors as $doctor)
        <div class="bg-white p-4 rounded shadow mb-3">
            <p><strong>Nom :</strong> {{ $doctor->name }}</p>
            <p><strong>Email :</strong> {{ $doctor->email }}</p>
            <p><strong>Certificat :</strong>
                <a href="{{ asset('storage/' . $doctor->doctor_certificate) }}" target="_blank" class="text-blue-600 underline">
                    Voir certificat
                </a>
            </p>

        @if ($doctor->is_verified_doctor)
            <form method="POST" action="{{ route('admin.doctors.unvalidate', $doctor) }}">
                @csrf
                <button class="bg-red-600 text-white px-3 py-1 rounded mt-2">❌ Unvalide</button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.doctors.validate', $doctor) }}">
                @csrf
                <button class="bg-green-600 text-white px-3 py-1 rounded mt-2">✅ Valide</button>
            </form>
        @endif
        </div>
    @endforeach
</div>
@endsection