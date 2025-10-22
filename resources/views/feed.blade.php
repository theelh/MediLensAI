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
    <div class="max-w-3xl z-20 mx-auto space-y-6">

        <h1 class="text-3xl z-20 font-bold text-center mb-6">🩺 Publique Questions</h1>
        @if(auth()->check() && auth()->user()->role === 'doctor')
        <a href="{{ route('questions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <i class="ph ph-arrow-right text-[26px] text-white font-semibold mr-3 text-lg"></i>
            Answer question
        </a>
        @else
        <a href="{{ route('questions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <i class="ph ph-question text-[26px] text-white font-semibold mr-3 text-lg"></i>
            Ask question
        </a>
        @endif
        
        <div class="z-20" id="questions-container">
            @include('partials.questions', ['questions' => $questions])
        </div>

        <div class="text-center mt-6 z-20">
            <button id="load-more" 
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700"
                    data-next-page="{{ $questions->nextPageUrl() }}">
                Show more
            </button>
        </div>
    </div>
</section>

<script>
document.addEventListener('click', async function(e) {
    // ✅ Charger plus
    if (e.target.id === 'load-more') {
        const nextPage = e.target.dataset.nextPage;
        if (!nextPage) return e.target.remove();

        const res = await fetch(nextPage, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const html = await res.text();

        document.querySelector('#questions-container').insertAdjacentHTML('beforeend', html);

        // Mettre à jour la pagination
        const newNext = res.headers.get('X-Next-Page');
        e.target.dataset.nextPage = newNext;
        if (!newNext) e.target.remove();
    }

    // ✅ Like
    if (e.target.classList.contains('like-btn')) {
        const questionId = e.target.dataset.id;
        const res = await fetch(`/questions/${questionId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        e.target.textContent = data.liked ? `liked ❤️ ${data.count}` : `like 🤍 ${data.count}`;
    }

    // ✅ Réponse (pour docteurs)
    if (e.target.classList.contains('send-answer')) {
        const questionId = e.target.dataset.id;
        const textarea = document.querySelector(`#answer-body-${questionId}`);
        const body = textarea.value.trim();
        if (!body) return;

        const res = await fetch(`/answers`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ question_id: questionId, body })
        });

        const data = await res.json();
        if (data.success) {
            textarea.value = '';
            alert('Réponse envoyée avec succès !');
            location.reload(); // simplifié
        }
    }
});
</script>
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