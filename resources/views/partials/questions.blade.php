@if ($questions)
    @foreach ($questions as $question)
<div class="bg-white shadow-md rounded-2xl relative p-5 mb-5">

    <!-- USER INFO -->
    <div class="flex items-center justify-between space-x-3 mb-3">
        <div class="flex items-center space-x-3 mb-3">
            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center font-semibold">
                {{ strtoupper(substr($question->user->name, 0, 1)) }}
            </div>
            <div>
                <p class="font-semibold">{{ $question->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $question->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <button onclick="openReportModal({{ $question->id }})" class="report-question text-red-600 flex items-center font-semibold hover:underline">
            <span class="ph ph-warning-circle text-lg mr-2"></span> Report
        </button>
        <div id="reportModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl w-96">
                <h2 class="text-lg font-bold mb-3">Report Question</h2>
                <input type="hidden" id="reportQuestionId">

                <textarea id="reportReason"
                        class="w-full border rounded p-2 mb-3"
                        rows="3"
                        placeholder="Reason for report (required)"></textarea>

                <div class="flex justify-end gap-3">
                    <button onclick="closeReportModal()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button onclick="sendReport()" class="px-4 py-2 bg-red-600 text-white rounded">Send Report</button>
                </div>
            </div>
        </div>
    </div>

    <!-- QUESTION CONTENT -->
    <div class="mb-3">
        <h2 class="text-lg font-semibold mb-1">{{ $question->title }}</h2>
        <p class="text-gray-700">{{ $question->body }}</p>
    </div>

    <!-- BUTTONS -->
    <div class="flex items-center gap-4 mb-3">
        <button class="like-btn text-gray-700" data-id="{{ $question->id }}">
            like 🤍 {{ $question->likes->count() }}
        </button>

        @if($question->answers->count() > 0)
            <button class="text-blue-600 font-semibold hover:underline show-comments" data-id="{{ $question->id }}">
                👁️ Show Comments ({{ $question->answers->count() }})
            </button>
        @endif
    </div>

    <!-- HIDDEN COMMENTS OVERLAY -->
    <div id="comments-{{ $question->id }}" class="hidden absolute top-0 left-0 w-full h-full bg-white shadow-lg rounded-2xl p-6 overflow-auto z-50">
        <button class="text-red-600 font-bold mb-3 close-comments">✖ Close</button>
        <h3 class="text-lg font-bold mb-3">Comments</h3>

        @foreach ($question->answers as $answer)
            <div class="bg-gray-50 rounded-lg p-3 mb-2">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-blue-700 flex items-center font-semibold">
                        Dr. {{ $answer->doctor->name ?? 'Inconnu' }} 
                        <img class="w-4 h-4 ml-2" src="{{asset('svg/download.svg')}}" />
                    </p>
                    <span class="text-xs text-gray-500">{{ $answer->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-700">{{ $answer->body }}</p>
            </div>
        @endforeach
    </div>

</div>
@endforeach
    @else
    <p class="text-center text-gray-500">No questions found.</p>
@endif

<script>
document.querySelectorAll('.show-comments').forEach(button => {
    button.addEventListener('click', () => {
        let id = button.getAttribute('data-id');
        document.getElementById('comments-' + id).classList.remove('hidden');
    });
});

document.querySelectorAll('.close-comments').forEach(button => {
    button.addEventListener('click', (e) => {
        e.target.parentElement.classList.add('hidden');
    });
});
</script>

<script>
function openReportModal(id) {
    document.getElementById('reportQuestionId').value = id;
    document.getElementById('reportModal').classList.remove('hidden');
}

function closeReportModal() {
    document.getElementById('reportModal').classList.add('hidden');
}

async function sendReport() {
    let id = document.getElementById('reportQuestionId').value;
    let reason = document.getElementById('reportReason').value;

    if (!reason.trim()) {
        alert("Please provide a reason.");
        return;
    }

    const res = await fetch(`/questions/${id}/report`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ reason })
    });

    const data = await res.json();
    Swal.fire({
            icon: 'success',
            title: 'Report sent!',
            text: 'Thank you for your feedback.',
            });
    closeReportModal();
}
</script>


