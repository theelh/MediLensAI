@extends('layouts.app')

@section('content')
<section class="relative h-screen flex items-center justify-center overflow-hidden">
<div class="max-w-[80%] p-7 rounded-3xl backdrop-blur-sm bg-white/25 border border-white border-spacing-5 z-20 mx-auto">
    <h2 class="text-2xl font-semibold mb-4">📂 File Uploaded</h2>
    {{-- Formulaire d’upload --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf
            <input type="file" name="file" class="border p-2 rounded w-full" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Upload
            </button>
        </form>
    </div>

    <table class="w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">File name</th>
                <th class="p-3 border">Patient</th>
                <th class="p-3 border">Statut</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $file->id }}</td>
                    <td class="p-3">{{ $file->filename }}</td>
                    <td class="p-3">{{ auth()->user()->name }}</td>
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
                        <a href="{{ route('files.show', $file) }}"
                        class="bg-blue-600 mx-5 text-white px-3 py-1 rounded hover:bg-blue-700">
                        View details
                        </a>

                        <form action="{{ route('files.destroy', $file) }}" method="POST" class="inline delete-file-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                    onclick="confirmDelete(this.form)">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
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
@endsection