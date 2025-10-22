@foreach($files as $file)
<div class="bg-white shadow-md rounded p-4 mb-4 relative">

    <div class="flex justify-between items-center mb-2">
        <div class="flex-col items-center gap-4">
            <p class="font-semibold">{{ $file->filename }}</p>
            <span class="text-sm text-gray-500">{{ $file->visibility === 'public' ? 'Publique' : 'Privée' }}</span>
        </div>
            <!-- Report Button -->
            <button class="bg-red-500 text-white flex items-center px-3 py-1 rounded report-btn" data-id="{{ $file->id }}">
                <span class="ph ph-warning-circle text-lg mr-2"></span> Report
            </button>

            <!-- Report Modal -->
            <div id="report-modal-{{ $file->id }}" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
                <div class="bg-white p-6 rounded shadow-lg w-96">
                    <h3 class="text-lg font-bold mb-2">Report this content</h3>
                    <textarea id="report-reason-{{ $file->id }}" class="w-full border rounded p-2" rows="3"
                        placeholder="Why are you reporting this?"></textarea>
                    <div class="flex justify-end mt-3">
                        <button class="bg-gray-300 px-3 py-1 rounded mr-2 close-report">Cancel</button>
                        <button class="bg-red-600 text-white px-3 py-1 rounded send-report" data-id="{{ $file->id }}">Send</button>
                    </div>
                </div>
            </div>
        </div>

    <div class="mb-2">
        @php
            $url = Storage::url($file->path);
        @endphp

        @if(Str::endsWith($file->filename, ['.jpg','.jpeg','.png','.gif']))
            <img src="{{ $url }}" alt="{{ $file->filename }}" class="w-48 h-48 object-cover rounded mb-2">
        @else
            <a href="{{ $url }}" target="_blank" class="text-blue-600 hover:underline">
                Télécharger {{ $file->filename }}
            </a>
        @endif
    </div>

    <!-- Show insights summary -->
    @if($file->insights->count() > 0)
        <div class="bg-gray-50 p-3 rounded mb-2 border-l-4 border-blue-400">
            <h4 class="font-semibold mb-1">Insights :</h4>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($file->insights as $insight)
                    <li>{{ $insight->summary ?? 'Summary not generated' }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Likes & view comments -->
    <div class="flex items-center gap-4 mb-2">
        <button class="like-btn text-gray-700" data-id="{{ $file->id }}">
            like 🤍 {{ $file->likes->count() }}
        </button>

        <button class="view-comments-btn text-gray-600 hover:underline" data-id="{{ $file->id }}">
            💬 View comments ({{ $file->comments->count() }})
        </button>
    </div>
    <!-- Comment box -->
    <div class="mb-2">
        <textarea id="comment-body-{{ $file->id }}" class="w-full border rounded p-2 mb-1" rows="2" placeholder="Add comment..."></textarea>
        <button class="bg-green-600 text-white px-3 py-1 rounded send-comment" data-id="{{ $file->id }}">Submit</button>
    </div>

    <!-- Flyout read-only comments -->
    <div id="comments-container-{{ $file->id }}" 
         class="hidden absolute top-8 right-0 w-80 bg-white border rounded shadow-lg z-50 p-4">

        <!-- Close button -->
        <button class="close-comments absolute top-1 right-1 text-gray-500 hover:text-gray-800">&times;</button>

        <!-- Comments list -->
        <div class="comments-list max-h-64 overflow-y-auto"></div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('click', async function(e) {
    // Toggle flyout
    if (e.target.classList.contains('view-comments-btn')) {
        const fileId = e.target.dataset.id;
        const container = document.getElementById(`comments-container-${fileId}`);
        const list = container.querySelector('.comments-list');

        container.classList.toggle('hidden');

        // Load comments only once
        if (!container.classList.contains('hidden') && list.children.length === 0) {
            const res = await fetch(`/files/${fileId}/comments`);
            const data = await res.json();

            data.comments.forEach(comment => {
    const div = document.createElement('div');
    div.classList.add('bg-gray-50', 'rounded', 'p-2', 'mb-1');

    // Set role icon if user is doctor
    const roleIcon = comment.role === 'doctor'
        ? `<img class="w-4 h-4 ml-2" src="{{ asset('svg/download.svg') }}" />`
        : '';

    div.innerHTML = `
        <p class="text-sm font-semibold flex items-center">
            ${comment.user} ${roleIcon}
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
});

</script>

<script>
document.addEventListener('click', async function(e) {
    // Open modal
    if (e.target.classList.contains('report-btn')) {
        document.getElementById(`report-modal-${e.target.dataset.id}`).classList.remove('hidden');
    }

    // Close modal
    if (e.target.classList.contains('close-report')) {
        e.target.closest('.fixed').classList.add('hidden');
    }

    // Send report
    if (e.target.classList.contains('send-report')) {
        let fileId = e.target.dataset.id;
        let reason = document.getElementById(`report-reason-${fileId}`).value;

        await fetch(`/report/${fileId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ reason })
        });

        Swal.fire({
            icon: 'success',
            title: 'Report sent!',
            text: 'Thank you for your feedback.',
            });
        // Close modal
        e.target.closest('.fixed').classList.add('hidden');
    }
});
</script>

