@extends('layouts.app')

@section('content')
<div class="min-h-screen z-20 bg-gray-100 flex flex-col items-center justify-center px-4 py-10">

    <h1 class="text-3xl z-20 font-bold mb-8 text-gray-800 text-center">Choose Your Plan</h1>

    <div class="grid z-20 grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">

        <!-- ✅ Free Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Free Plan</h2>
            <p class="text-gray-600 mb-6">
                Access basic features for free.  
                Ideal for casual users.
            </p>
            <ul class="text-left text-gray-700 mb-6 space-y-2">
                <li>✔️ Basic consultation</li>
                <li>✔️ Limited file uploads</li>
                <li>❌ No advanced analysis</li>
                <li>❌ No priority support</li>
            </ul>

            <form action="{{ route('dashboard') }}" method="GET">
                <button type="submit"
                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-xl transition">
                    Continue for Free
                </button>
            </form>
        </div>

        <!-- 💎 Premium Plan -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white rounded-2xl shadow-xl p-8 text-center">
            <h2 class="text-2xl font-semibold mb-4">Premium Plan</h2>
            <p class="text-blue-100 mb-6">
                Unlock all advanced features with the Premium plan.
            </p>
            <ul class="text-left mb-6 space-y-2">
                <li class="flex items-center"><i class="ph ph-star mr-2"></i> Full access to all AI analyses</li>
                <li class="flex items-center"><i class="ph ph-star mr-2"></i> Unlimited uploads</li>
                <li class="flex items-center"><i class="ph ph-star mr-2"></i> 24/7 priority support</li>
                <li class="flex items-center"><i class="ph ph-star mr-2"></i> Advanced dashboard</li>
            </ul>

            @if (auth()->user()->is_subscribed)
                <p class="my-3">Already Subscribed</p>
                <a href="{{ route('subscription.show') }}" class="w-full bg-white flex items-center justify-center hover:bg-gray-100 text-blue-700 font-semibold py-2 px-4 rounded-xl transition">
                    Manager you plan
                </a>
                @else
                    <form action="{{ route('subscription.create') }}" method="GET">
                        <button type="submit"
                            class="w-full bg-white hover:bg-gray-100 text-blue-700 font-semibold py-2 px-4 rounded-xl transition">
                            Subscribe - $9.99 / month
                        </button>
                    </form>
                @endif
        </div>
    </div>
</div>
@endsection
