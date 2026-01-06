<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200/80 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/logo/logomce26.png') }}" alt="MCE Logo" class="block h-12 w-auto object-contain" />
                        <div class="hidden md:flex flex-col">
                            <span class="text-base font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">Magetan Campus Expo</span>
                            <span class="text-xs text-gray-500 font-medium">2026</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                @if(auth()->user()->isAdmin())
                <!-- Admin Menu -->
                <div class="hidden lg:flex space-x-1 ms-12">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Dashboard Admin') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.registrations.index')" :active="request()->routeIs('admin.registrations.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.registrations.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Registrasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.ticket-packages.index')" :active="request()->routeIs('admin.ticket-packages.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.ticket-packages.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Paket Tiket') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.aspirations.index')" :active="request()->routeIs('admin.aspirations.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.aspirations.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Aspirasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.discount-codes.index')" :active="request()->routeIs('admin.discount-codes.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.discount-codes.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Kode Diskon') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.checkin.index')" :active="request()->routeIs('admin.checkin.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('admin.checkin.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Check-in Peserta') }}
                    </x-nav-link>
                </div>
                @else
                <!-- User Menu -->
                <div class="hidden lg:flex space-x-1 ms-12">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('campus.index')" :active="request()->routeIs('campus.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('campus.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Kampus') }}
                    </x-nav-link>
                    <x-nav-link :href="route('schedule.index')" :active="request()->routeIs('schedule.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('schedule.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Jadwal') }}
                    </x-nav-link>
                    <x-nav-link :href="route('gallery.index')" :active="request()->routeIs('gallery.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('gallery.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Galeri') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('contact') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Kontak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.tickets.index')" :active="request()->routeIs('user.tickets.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('user.tickets.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Tiket Saya') }}
                    </x-nav-link>
                    <x-nav-link :href="route('feedback.create')" :active="request()->routeIs('feedback.*')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('feedback.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Feedback') }}
                    </x-nav-link>
                </div>
                @endif
                @else
                <!-- Guest Menu -->
                <div class="hidden lg:flex space-x-1 ms-12">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('home') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('about') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Tentang') }}
                    </x-nav-link>
                    <x-nav-link :href="route('campus.preview')" :active="request()->routeIs('campus.preview')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('campus.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Kampus') }}
                    </x-nav-link>
                    <x-nav-link :href="route('schedule.preview')" :active="request()->routeIs('schedule.preview')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('schedule.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Jadwal') }}
                    </x-nav-link>
                    <x-nav-link :href="route('gallery.preview')" :active="request()->routeIs('gallery.preview')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('gallery.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Galeri') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('contact') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Kontak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('feedback.guest-form')" :active="request()->routeIs('feedback.guest-form')" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 {{ request()->routeIs('feedback.guest-form') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                        {{ __('Feedback') }}
                    </x-nav-link>
                </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex items-center ms-6">
                @auth
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-[#BAD9CE]/10 hover:border-[#118C8C] focus:outline-none focus:ring-2 focus:ring-[#118C8C] focus:ring-offset-2 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-lg flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="text-left">
                                <div class="font-semibold">{{ Auth::user()->name }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</div>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 hover:bg-[#BAD9CE]/10">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 text-red-600 hover:bg-red-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-[#118C8C] transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                        Register
                    </a>
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-gray-500 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#118C8C] transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-gray-200/80 bg-white/95 backdrop-blur-md">
        @auth
        @if(auth()->user()->isAdmin())
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.dashboard') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Dashboard Admin') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.registrations.index')" :active="request()->routeIs('admin.registrations.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.registrations.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Registrasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.ticket-packages.index')" :active="request()->routeIs('admin.ticket-packages.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.ticket-packages.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Paket Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.aspirations.index')" :active="request()->routeIs('admin.aspirations.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.aspirations.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Aspirasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.discount-codes.index')" :active="request()->routeIs('admin.discount-codes.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.discount-codes.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Kode Diskon') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.checkin.index')" :active="request()->routeIs('admin.checkin.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('admin.checkin.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Check-in Peserta') }}
            </x-responsive-nav-link>
        </div>
        @else
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('dashboard') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('campus.index')" :active="request()->routeIs('campus.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('campus.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Kampus') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('schedule.index')" :active="request()->routeIs('schedule.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('schedule.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Jadwal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gallery.index')" :active="request()->routeIs('gallery.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('gallery.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Galeri') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('contact') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Kontak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.tickets.index')" :active="request()->routeIs('user.tickets.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('user.tickets.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Tiket Saya') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('feedback.create')" :active="request()->routeIs('feedback.*')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('feedback.*') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-gray-200/80">
            <div class="px-4 mb-3">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-xl flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-base text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center gap-2 px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 px-4 py-3 rounded-xl text-base font-semibold text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('home') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('about') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Tentang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('campus.preview')" :active="request()->routeIs('campus.preview')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('campus.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Kampus') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('schedule.preview')" :active="request()->routeIs('schedule.preview')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('schedule.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Jadwal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gallery.preview')" :active="request()->routeIs('gallery.preview')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('gallery.preview') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Galeri') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('contact') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Kontak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('feedback.guest-form')" :active="request()->routeIs('feedback.guest-form')" class="block px-4 py-3 rounded-xl text-base font-semibold text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all {{ request()->routeIs('feedback.guest-form') ? 'text-[#118C8C] bg-[#BAD9CE]/30' : '' }}">
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200/80 px-4">
            <div class="space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center px-6 py-3 bg-white border-2 border-[#118C8C] text-[#118C8C] font-semibold rounded-xl hover:bg-[#BAD9CE]/10 transition-all">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center px-6 py-3 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                    Register
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>