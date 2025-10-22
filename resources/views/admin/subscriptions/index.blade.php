@extends('layouts.admin')
@section('content')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#181819] shadow-sm sm:rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Subscribed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-[#1E1E1E] divide-y divide-gray-700">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-gray-200">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-200">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" 
                                        onchange="document.getElementById('toggle-form-{{ $user->id }}').submit()"
                                        {{ $user->is_subscribed ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-400 rounded-full peer peer-checked:bg-green-500
                                                peer-focus:ring-2 peer-focus:ring-green-300 transition-all"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-200">
                                        {{ $user->is_subscribed ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>

                                <form id="toggle-form-{{ $user->id }}" action="{{ route('admin.subscriptions.toggle', $user) }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <!-- Optional future actions like delete -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection