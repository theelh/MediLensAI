<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Medilens AI</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|inter:400|montserrat:500&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{asset('icons/fav-icon-medilens.png')}}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <body class="font-sans pt-[7rem] bg-gray-100 antialiased">
        <div class="min-h-screen ">
            @if(auth()->check() && auth()->user()->role === 'doctor')
                @include('layouts.doctornav')
            @elseif(auth()->check() && auth()->user()->role === 'admin')
                @include('layouts.adminav')
            @else
                @include('layouts.navigation')
            @endif
<section class="min-h-screen relative py-8">
    <div class="max-w-3xl z-20 mx-auto space-y-6">
<div class=" w-[52vw] shadow-xl shadow-black/30 bg-white rounded-xl z-20 mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Public Questions</h1>

    <a href="{{ route('questions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Pose a question</a>

    <div class="mt-6">
        @foreach($questions as $q)
            <div class="border p-4 rounded mb-4">
                <h2 class="text-xl font-semibold">{{ $q->title }}</h2>
                <p class="text-gray-700">{{ $q->body }}</p>
                <p class="text-sm text-gray-500">Posted by {{ $q->user->name }}</p>

                <a href="{{ route('questions.show', $q) }}" class="text-blue-600 underline">View details</a>
            </div>
        @endforeach
    </div>
</div>
    </div>
</section>
        </div>
    </body>
</html>