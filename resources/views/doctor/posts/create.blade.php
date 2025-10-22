@extends('layouts.doctor')

@section('content')
<div class="max-w-5xl z-20 py-[7rem] pt-[9rem] mx-auto  shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">🩺 Créer un nouveau post</h2>

    @if (session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Titre</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Description</label>
            <textarea name="description" class="w-full border rounded p-2" rows="4"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Images / PDF</label>
            <input type="file" name="media[]" multiple accept="image/*,application/pdf" class="w-full">
        </div>

        <div id="preview" class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4"></div>

        <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700">
            Publier
        </button>
    </form>
</div>

<script>
document.querySelector('input[name="media[]"]').addEventListener('change', (e) => {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';

    Array.from(e.target.files).forEach(file => {
        if (file.type.includes('image')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add('w-full', 'h-32', 'object-cover', 'rounded');
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else if (file.type === 'application/pdf') {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'justify-center', 'h-32', 'bg-gray-100', 'rounded');
            div.innerHTML = `<span class="text-sm text-gray-600">📄 ${file.name}</span>`;
            preview.appendChild(div);
        }
    });
});
</script>
@endsection
