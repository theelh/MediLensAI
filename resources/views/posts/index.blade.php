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
<div class="max-w-3xl border rounded-xl bg-white items-center justify-center flex flex-col relative pt-[7rem] mx-auto mt-8 space-y-6">

    @foreach($posts as $post)
        <div class="bg-white h-full border-b relative my-0 border-black/35 px-[7rem] rounded-t-lg py-[3rem]">
            <div class="flex flex-col mb-2">
                <div class="flex items-center">
                    <p class="text-lg underline font-semibold">{{ $post->user->name }}</p>
                    <img class="w-4 h-4 ml-2" src="{{ asset('svg/download.svg') }}" />
                </div>
            </div>

            
            @if($post->media->count())
                <div class="flex overflow-x-auto space-x-2 mb-3">
                    @foreach($post->media as $file)
                        @if(Str::contains($file->type, 'image'))
                            <img src="{{ asset('storage/' . $file->path) }}" class="w-92 h-72 object-cover rounded-lg" />
                        @elseif(Str::contains($file->type, 'pdf'))
                        <iframe src="{{ asset('storage/' . $file->path) }}" class="w-92 h-72 rounded-lg"></iframe>
                        @endif
                    @endforeach
                </div>
                @endif

            <!-- Likes & Comments -->
            <div class="flex itrems-center justify-between mb-3">
                <div class="flex-col my-2">
                    <button class="like-btn text-blue-600 hover:underline" data-id="{{ $post->id }}">
                        {{ $post->likes->count() }}🤍
                    </button>
                    <p class="text-sm">Liked by {{ $post->likes->count() }}</p>
                </div>
                <button class="view-comments-btn underline text-gray-600 hover:underline" data-id="{{ $post->id }}">
                💬 View comments ({{ $post->comments->count() }})
                </button>
            </div>

            <div class="flex items-center mb-3">
                <div class="flex items-center">
                    <p class="text-lg font-semibold">{{ $post->user->name }}</p>
                    <img class="w-4 h-4 ml-2" src="{{ asset('svg/download.svg') }}" />
                </div>
                <p class=" ml-2 text-gray-700">{{ $post->description }}</p>
            </div>

            <!-- Comment box -->
            <div class="flex justify-between" id="comments-{{ $post->id }}" class=" mt-2">
                <textarea id="comment-body-{{ $post->id }}" class="w-[70%] border rounded p-2 mb-1" rows="1" placeholder="Add comment..."></textarea>
                <button class="bg-green-600 text-white px-3 py-1 rounded send-comment" data-id="{{ $post->id }}">Submit</button>

            </div>
            <!-- Flyout read-only comments -->
            <div id="comments-container-{{ $post->id }}" 
                class="hidden absolute top-32 max-w-7xl right-0 w-[80%] bg-white border rounded shadow-lg z-50 p-4">

                <!-- Close button -->
                <button class="close-comments absolute top-1 right-1 text-gray-500 hover:text-gray-800">&times;</button>

                <!-- Comments list -->
                <div class="comments-list mt-2 max-h-64 overflow-y-auto"></div>
            </div>
        </div>
    @endforeach

</div>

    </div>
</section>
        </div> 

<script>
document.addEventListener('click', async function(e) {
    // ✅ Like
    if (e.target.classList.contains('like-btn')) {
        const postId = e.target.dataset.id;
        const res = await fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        e.target.textContent = data.liked ? ` ${data.count} ❤️` : ` ${data.count} 🤍`;
    }

    document.addEventListener('click', async function(e) {
    // Toggle flyout
    if (e.target.classList.contains('view-comments-btn')) {
        const postId = e.target.dataset.id;
        const container = document.getElementById(`comments-container-${postId}`);
        const list = container.querySelector('.comments-list');

        // Toggle visibility
        container.classList.toggle('hidden');

        // Load comments only once
        if (!container.classList.contains('hidden') && list.children.length === 0) {
            const res = await fetch(`/posts/${postId}/comments`);
            const data = await res.json();

            data.comments.forEach(comment => {
    const div = document.createElement('div');
    div.classList.add('bg-gray-50', 'rounded', 'p-2', 'w-full', 'mb-1', 'mx-auto');

    // Check if the COMMENT user is doctor (from backend)
    const isDoctor = comment.role === 'doctor';

    div.innerHTML = `
        <p class="text-sm font-semibold flex items-center">
            ${comment.user}
            ${isDoctor ? `<img class="w-4 h-4 ml-2" src="{{ asset('svg/download.svg') }}" />` : ''}
        </p>
        <p class="text-gray-700">${comment.content}</p>
        <span class="text-xs text-gray-500">${comment.created_at}</span>
    `;

    list.appendChild(div);
});

        }
    }

    // Close flyout
    if (e.target.classList.contains('close-comments')) {
        e.target.parentElement.classList.add('hidden');
    }

    // Send comment
    if (e.target.classList.contains('send-comment')) {
        const postId = e.target.dataset.id;
        const textarea = document.getElementById(`comment-body-${postId}`);
        const content = textarea.value.trim();
        if (!content) return;

        e.target.disabled = true;

        const res = await fetch(`/posts/${postId}/comment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ content })
        });

        const data = await res.json();
        e.target.disabled = false;

        if (data.success) {
            textarea.value = '';
            const list = document.querySelector(`#comments-container-${postId} .comments-list`);
            const div = document.createElement('div');
            div.classList.add('bg-gray-50', 'rounded', 'p-2', 'mb-1');
            div.innerHTML = `<p class="text-sm font-semibold">${data.comment.user}</p>
                             <p class="text-gray-700">${data.comment.content}</p>`;
            list.prepend(div);
        }
    }

    // ✅ Send comment
    if (e.target.classList.contains('send-comment')) {
        e.preventDefault(); // prevent default form behavior

        const postId = e.target.dataset.id;
        const textarea = document.getElementById(`comment-body-${postId}`);
        const content = textarea.value.trim();
        if (!content) return;

        // Disable button to prevent double-click
        e.target.disabled = true;

        const res = await fetch(`/posts/${postId}/comment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ content })
        });

        const data = await res.json();

        // Re-enable button
        e.target.disabled = false;

        if (data.success) {
            textarea.value = '';
            const list = document.querySelector(`#comments-container-${postId} .comments-list`);
            const div = document.createElement('div');
            div.classList.add('bg-gray-50', 'rounded', 'p-2', 'mb-1');
            div.innerHTML = `<p class="text-sm font-semibold">${data.comment.user}</p>
                             <p class="text-gray-700">${data.comment.content}</p>`;
            list.prepend(div);
        }
    }
});

});
</script>
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
