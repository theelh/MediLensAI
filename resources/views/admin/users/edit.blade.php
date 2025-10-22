@extends('layouts.admin')
@section('content')
<h2 class="text-2xl font-bold mb-4">Edit User</h2>
<form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block">Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 rounded bg-gray-200" required>
    </div>
    <div>
        <label class="block">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 rounded bg-gray-200" required>
    </div>
    <div>
        <label class="block">Password (leave blank to keep)</label>
        <input type="password" name="password" class="w-full p-2 rounded bg-gray-200">
    </div>
    <div>
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_admin" value="1" class="mr-2" {{ $user->is_admin ? 'checked' : '' }}>
            Admin
        </label>
    </div>
    <button type="submit" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Update</button>
</form>
@endsection