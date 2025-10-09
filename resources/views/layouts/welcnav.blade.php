<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 backdrop-blur-sm bg-white/40 w-[80%] rounded-full mt-5 mx-auto border border-gray-100 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img class="w-36" src="{{asset('img/medilens-ai-logo.png')}}" alt="">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('pricing')" :active="request()->routeIs('pricing')">
                        {{ __('Pricing') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About us') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                    @if(auth()->check() && auth()->user()->role === 'patient')
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] font-semibold font-Inter border text-[#391986] dark:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Welcome Patient
                        </a>
                    @elseif(auth()->check() && auth()->user()->role === 'doctor')
                        <a
                            href="{{ url('/doctor/dashboard') }}"
                            class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] font-semibold font-Inter border text-[#391986] dark:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Welcome Doctor
                        </a>
                    @elseif(auth()->check() && auth()->user()->role === 'admin')
                        <a
                            href="{{ url('/admin/dashboard') }}"
                            class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] font-semibold font-Inter border text-[#391986] dark:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Welcome Admin
                        </a>
                    @endif
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 text-[#391986] font-Inter font-semibold border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <a class="inline-flex items-center px-4 py-4 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <i class="ph ph-crown"></i>
                Get Started
            </a>
        </div>
    </div>
</nav>
