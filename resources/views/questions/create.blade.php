@extends('layouts.app')

@section('content')
<section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
<div class=" w-[52vw] shadow-xl shadow-black/30 bg-white rounded-xl z-20 mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Poser une nouvelle question</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block font-semibold">Titre de la question :</label>
            <input type="text" name="title" id="title"
                   class="w-full border rounded p-2"
                   placeholder="Ex: Quels sont les symptômes de la grippe ?" 
                   required>
        </div>

        <div>
            <label for="body" class="block font-semibold">Détails :</label>
            <textarea name="body" id="body" rows="5"
                      class="w-full border rounded p-2"
                      placeholder="Expliquez vos symptômes ou votre question en détail..."
                      required></textarea>
        </div>

        <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Publier ma question
            </button>
            <a href="{{ route('questions.index') }}" 
               class="ml-3 text-gray-600 hover:underline">
               Annuler
            </a>
        </div>
    </form>
</div>
</section>
@endsection