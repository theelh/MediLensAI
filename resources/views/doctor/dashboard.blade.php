@extends('layouts.doctor')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as doctor") }}
                </div>
            </div>
            <a href="{{ route('questions.index') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Répondre aux questions
        </a>
        </div>
    </div>
@endsection
