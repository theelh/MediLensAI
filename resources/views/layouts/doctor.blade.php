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

    <body class="font-sans  antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.doctornav')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endisset
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    });
                </script>
                @elseif (session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <footer class="bg-[#FBF9FE] border-black/35 border-t text-black/70 font-satoshi font-semibold p-4 py-7 text-center text-sm">
            <div class="max-w-7xl mx-auto flex justify-between">
                <p>© {{ date('Y') }} MediLens AI </p>
                <div class="flex gap-3">
                    <p>My LinkedIn <a class="underline" target="_blank" href="https://www.linkedin.com/in/marwane-elhosni/">Marwane Elhosni</a></p>
                    <p>My Github <a class="underline" target="_blank" href="https://github.com/theelh">Marwane Elhosni</a></p>
                </div>
            </div>
        </footer>
    </body>
</html>
