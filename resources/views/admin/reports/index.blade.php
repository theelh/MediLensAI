@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Reported Content</h1>

    @if ($reports->count() > 0)
        @foreach($reports as $report)
        <div class="bg-white p-4 rounded shadow mb-4">
            <div class="flex justify-between">
                <div>
                    <p><strong>Reported By:</strong> {{ $report->user->name }}</p>
                    <p><strong>File/Post:</strong> {{ $report->file->filename ?? 'N/A' }}</p>
                    <p><strong>Reason:</strong> {{ $report->reason }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-1 text-sm rounded 
                            {{ $report->status === 'pending' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </p>
                </div>
                <div class="flex gap-2">
                    @if($report->status === 'pending')
                        <form action="{{ route('admin.reports.review', $report) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">Mark Reviewed</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @else
        <p class="text-gray-600">No reports found.</p>
    @endif

    {{ $reports->links() }}

</div>
@endsection
