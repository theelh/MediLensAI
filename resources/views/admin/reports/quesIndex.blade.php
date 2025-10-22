@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Reported Questions</h1>

<table class="w-full border-collapse bg-white rounded-lg shadow">
    <thead>
        <tr class="bg-gray-200 text-left">
            <th class="p-3">Question</th>
            <th class="p-3">Reason</th>
            <th class="p-3">Reported By</th>
            <th class="p-3 text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($reports->count() > 0 )
            @foreach($reports as $report)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-3 font-semibold">{{ $report->question->title }}</td>
            <td class="p-3">{{ $report->reason }}</td>
            <td class="p-3">{{ $report->reporter->name }}</td>
            <td class="p-3 text-center flex items-center justify-center gap-2">

                <!-- VIEW QUESTION -->
                <a href="{{ route('admin.reportsques.show', $report->question->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    View
                </a>

                <!-- DELETE REPORT -->
                <form action="{{ route('admin.reportsques.destroy', $report->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Delete Report
                    </button>
                </form>

                <!-- DELETE QUESTION -->
                <form action="{{ route('admin.question.delete', $report->question->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-black">
                        Delete Question
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4" class="p-3 text-center text-gray-500">No reported questions found.</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection
