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
<section class="min-h-screen relative py-8">
    <div class="max-w-7xl z-20 mx-auto space-y-6">
<div class="max-w-[80%] p-7 rounded-3xl backdrop-blur-sm bg-white/25 border border-white border-spacing-5 z-20 mx-auto">
    <h2 class="text-2xl font-semibold mb-4">📂 File Uploaded</h2>
    {{-- Formulaire d’upload --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <div class="flex">
                <input type="file" name="file" class="border p-2 rounded w-full" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Upload
                </button>
            </div>
            <div>
                <label for="visibility" class="block font-semibold">Visibility :</label>
                <select name="visibility" id="visibility" class="w-full border rounded p-2" required>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
        </form>
    </div>

    <table class="w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">File name</th>
                <th class="p-3 border">Visibility</th>
                <th class="p-3 border">Statut</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $file->id }}</td>
                    <td class="p-3">{{ $file->filename }}</td>
                    <td class="p-3">{{ $file->visibility }}</td>
                    <td class="p-3">
                        @if($file->status === 'done')
                            <span class="text-green-600 font-semibold">✅ Finished</span>
                        @elseif($file->status === 'processing')
                            <span class="text-yellow-600 font-semibold">⏳ In progress</span>
                        @elseif($file->status === 'failed')
                            <span class="text-red-600 font-semibold">❌ Failed</span>
                        @else
                            <span class="text-gray-600">On hold</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <a href="{{ route('files.showe', $file) }}"
                        class="bg-blue-600 mx-5 text-white px-3 py-1 rounded hover:bg-blue-700">
                        View details
                        </a>

                        @if (auth()->user()->id == $file->uploaded_by)
                            <form action="{{ route('files.destroye', $file) }}" method="POST" class="inline delete-file-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                        onclick="confirmDelete(this.form)">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
<script>
function confirmDelete(form) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // rouge
        cancelButtonColor: '#6b7280',  // gris
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
</html>