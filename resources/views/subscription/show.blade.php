@extends('layouts.app')

@section('content')
<div class="min-h-screen z-20 bg-gray-100 flex items-center justify-center py-12 px-6">
    <div class="max-w-lg z-20 w-full bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl z-20 font-bold text-gray-800 mb-6 text-center">My Subscription</h1>

        <div class="space-y-4 z-20">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Username:</span>
                <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Subscription Type:</span>
                <span class="font-semibold {{ auth()->user()->is_subscribed ? 'text-blue-600' : 'text-gray-800' }}">
                    {{ auth()->user()->is_subscribed ? 'Premium' : 'Free' }}
                </span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Registration Date:</span>
                <span class="font-semibold text-gray-800">{{ auth()->user()->created_at->format('d/m/Y') }}</span>
            </div>
        </div>

        <div class="mt-8 z-20 text-center">
            @if(auth()->user()->is_subscribed)
                <form action="{{ route('subscription.cancel') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                        Cancel My Subscription
                    </button>
                </form>
            @else
                <a href="{{ route('subscription.choose') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Upgrade to Premium
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
