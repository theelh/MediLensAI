@extends('layouts.admin')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Users Card -->
<a href="{{ route('users.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
<h3 class="text-lg font-semibold">Users</h3>
<p class="text-2xl font-bold mt-2">{{ $stats['users'] }}</p>
<p class="mt-1">Manage all users</p>
</a>


<!-- Files Card -->
<a href="{{ route('files.index') }}" class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
<h3 class="text-lg font-semibold">Files</h3>
<p class="text-2xl font-bold mt-2">{{ $stats['files'] }}</p>
<p class="mt-1">Manage uploaded files</p>
</a>

<a href="{{ route('admin.reports.index') }}" 
   class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
    <h3 class="text-lg font-semibold">Reports</h3>
    <p class="text-2xl font-bold mt-2">⚠️</p>
    <p class="mt-1">View Abuse Reports</p>
</a>
<a href="{{ route('admin.reportsques.index') }}" 
   class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
    <h3 class="text-lg font-semibold">Question Reports</h3>
    <p class="text-2xl font-bold mt-2">⚠️</p>
    <p class="mt-1">View Abuse Reports</p>
</a>


<a href="{{ route('admin.subscriptions.index') }}" 
   class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
    <h3 class="text-lg font-semibold">Subscriptions</h3>
    <p class="text-2xl font-bold mt-2">{{ \App\Models\User::where('is_subscribed', true)->count() }}</p>
    <p class="mt-1">Manage all user subscriptions</p>
</a>


<!-- Posts Card -->
<a href="{{ route('posts.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-700 text-white p-6 rounded-lg shadow hover:shadow-lg transition">
<h3 class="text-lg font-semibold">Posts</h3>
<p class="text-2xl font-bold mt-2">{{ $stats['posts'] }}</p>
<p class="mt-1">Manage all posts</p>
</a>
</div>


<a href="{{route('admin.system.health')}}">
<div class="mt-8 bg-gray-800 p-6 rounded-lg shadow">
<h3 class="text-xl font-semibold text-white mb-4">System Health</h3>
<ul class="text-gray-300 space-y-2">
<li><strong>Storage Used:</strong> {{ round($systemHealth['storage']['used'] / 1024 / 1024, 2) }} MB</li>
<li><strong>Storage Free:</strong> {{ round($systemHealth['storage']['free'] / 1024 / 1024, 2) }} MB</li>
<li><strong>Memory Usage:</strong> {{ round($systemHealth['memory']['usage'] / 1024 / 1024, 2) }} MB</li>
</ul>
</div>
</a>
@endsection