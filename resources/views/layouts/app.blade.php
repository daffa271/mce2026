<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @hasSection('content')
            @yield('content')
            @else
            {{ $slot ?? '' }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="relative bg-gradient-to-br from-gray-900 via-[#0E6973] to-[#118C8C] text-white overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-[#F2BB16] rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#BAD9CE] rounded-full filter blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 py-16">
                <div class="grid md:grid-cols-4 gap-12">

                    <!-- Brand Column -->
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-3 mb-4">
                            <img src="{{ asset('images/logo/logomce.png') }}" alt="Magetan Campus Expo Logo" class="w-12 h-12 rounded-xl shadow-lg object-contain bg-white/10 p-1" />
                            <div>
                                <h3 class="text-xl font-bold">Magetan Campus Expo</h3>
                                <p class="text-sm text-[#BAD9CE]">Mega Gumelar Paraning Lawu</p>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Event tahunan yang mempertemukan siswa dengan berbagai perguruan tinggi terbaik dari seluruh Indonesia. Wujudkan impian pendidikan tinggi Anda bersama kami.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/magetancampusexpo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 462.799" aria-hidden="true">
                                    <path fill-rule="nonzero" d="M403.229 0h78.506L310.219 196.04 512 462.799H354.002L230.261 301.007 88.669 462.799h-78.56l183.455-209.683L0 0h161.999l111.856 147.88L403.229 0zm-27.556 415.805h43.505L138.363 44.527h-46.68l283.99 371.278z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-[#BAD9CE]">Menu Cepat</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Home</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Tentang</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Kontak</a></li>
                            <li><a href="{{ route('feedback.create') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Feedback</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-[#BAD9CE]">Hubungi Kami</h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 mt-0.5 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">Kabupaten Magetan, Jawa Timur</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 mt-0.5 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">magetancampusexpo1@gmail.com</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 mt-0.5 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm">+6285904300285</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-white/10 mt-12 pt-8 text-center">
                    <p class="text-gray-400 text-sm">
                        © 2026 Magetan Campus Expo. All rights reserved. | Powered by <span class="text-[#F2BB16]">MCE Team</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>