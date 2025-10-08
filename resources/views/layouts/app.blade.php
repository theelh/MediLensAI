<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|inter:400|montserrat:500&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{asset('icons/fav-icon-medilens.png')}}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <body class="font-sans pt-[2rem] bg-gray-100 antialiased">
        <div class="min-h-screen ">
            <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/6917913_Motion_Graphics_Motion_Graphic_3840x2160.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @if(auth()->check() && auth()->user()->role === 'doctor')
                @include('layouts.doctornav')
            @elseif(auth()->check() && auth()->user()->role === 'admin')
                @include('layouts.adminav')
            @else
                @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <footer class="bg-gray-800 text-gray-300 p-4 text-center text-sm">
            © {{ date('Y') }} MediLens AI
        </footer>
    </body>
</html>
