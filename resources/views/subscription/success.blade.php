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


    <body class="font-sans pt-[2rem] bg-gray-100 antialiased">
<div class="text-center z-20 mt-10">
    <h1 class="text-2xl z-20 font-bold text-green-600">✅ Payment Successful</h1>
    <p class="mt-3 z-20">Thank you! Your account is now subscribed to the Premium plan.</p>
    <a href="{{ route('dashboard') }}" class="mt-5 z-20 inline-block bg-blue-600 text-white px-4 py-2 rounded">
        Back to Dashboard
    </a>
</div>
    </body>
</html>
