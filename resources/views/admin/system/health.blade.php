@extends('layouts.admin')
@section('content')
<h2 class="text-2xl font-bold mb-4">System Health</h2>
<div class="grid grid-cols-2 gap-4">
    <div class="bg-gray-200/35 p-4 border border-white border-spacing-5 backdrop-blur-sm rounded">
        <h3 class="font-semibold">Storage</h3>
        <p>Total: {{ number_format($health['storage']['total'] / (1024*1024*1024),2) }} GB</p>
        <p>Free: {{ number_format($health['storage']['free'] / (1024*1024*1024),2) }} GB</p>
    </div>
    <div class="bg-gray-200/35 p-4 border border-white border-spacing-5 backdrop-blur-sm rounded">
        <h3 class="font-semibold">Memory</h3>
        <p>Usage: {{ number_format($health['memory']['usage'] / (1024*1024),2) }} MB</p>
        <p>Peak: {{ number_format($health['memory']['peak'] / (1024*1024),2) }} MB</p>
    </div>
    <div class="bg-gray-200/35 p-4 border border-white border-spacing-5 backdrop-blur-sm rounded">
        <h3 class="font-semibold">Database</h3>
        <p>Size: {{ number_format($health['database']['size'] / (1024*1024),2) }} MB</p>
    </div>
    <div class="bg-gray-200/35 p-4 border border-white border-spacing-5 backdrop-blur-sm rounded">
        <h3 class="font-semibold">PHP</h3>
        <p>Version: {{ $health['php']['version'] }}</p>
        <p>Max Execution: {{ $health['php']['max_execution_time'] }} sec</p>
        <p>Memory Limit: {{ $health['php']['memory_limit'] }}</p>
    </div>
    <div class="bg-gray-200/35 p-4 border border-white border-spacing-5 backdrop-blur-sm rounded">
        <h3 class="font-semibold">Laravel</h3>
        <p>Version: {{ $health['laravel']['version'] }}</p>
        <p>Environment: {{ $health['laravel']['env'] }}</p>
    </div>
</div>
@endsection