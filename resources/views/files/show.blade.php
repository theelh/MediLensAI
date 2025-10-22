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
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="max-w-3xl z-20 mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">📄 File Details</h2>

        <p><strong>File Name:</strong> {{ $file->filename }}</p>
        <p><strong>Visibility:</strong> {{ $file->visibility }}</p>
        <p><strong>Patient:</strong> {{ $file->patient->metadata['name'] ?? '—' }}</p>
        <p><strong>Status:</strong>
            @if($file->status === 'done')
                <span class="text-green-600 font-semibold">✅ Completed</span>
            @elseif($file->status === 'processing')
                <span class="text-yellow-600 font-semibold">⏳ Processing</span>
            @elseif($file->status === 'failed')
                <span class="text-red-600 font-semibold">❌ Failed</span>
            @else
                <span class="text-gray-600">Pending</span>
            @endif
        </p>

        <h3 class="text-lg font-bold mt-4 mb-2">💡 Insights</h3>
        @if($file->insights->count())
            <ul class="list-disc list-inside">
                @foreach($file->insights as $insight)
                    <li>
                        <strong>Type:</strong> {{ $insight->type }} <br>
                        <strong>Summary:</strong> {{ $insight->summary ?? '—' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No insights generated for this file yet.</p>
        @endif

        <a href="{{ route('files.all') }}" class="mt-4 inline-block bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
            ← Back to list
        </a>
    </div>
</section>
        </div>
    </body>
    <footer class="bg-[#FBF9FE] border-black/35 border-t text-black/70 font-satoshi font-semibold p-4 py-7 text-center text-sm">
            <div class="max-w-7xl mx-auto flex justify-between">
                <p>© {{ date('Y') }} MediLens AI </p>
                <div class="flex gap-3">
                    <p>My LinkedIn <a class="underline" target="_blank" href="https://www.linkedin.com/in/marwane-elhosni/">Marwane Elhosni</a></p>
                    <p>My Github <a class="underline" target="_blank" href="https://github.com/theelh">Marwane Elhosni</a></p>
                </div>
            </div>
        </footer>
</html>
