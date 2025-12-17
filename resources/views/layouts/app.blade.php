<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Magetan Campus Expo 2026 - Mega Gumelar Paraning Lawu">
    <title>{{ $title ?? 'Magetan Campus Expo 2026' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#E6F2F3',
                            100: '#CCE5E7',
                            200: '#99CBCF',
                            300: '#66B1B7',
                            400: '#33979F',
                            500: '#118C8C', // Main teal
                            600: '#0E7070',
                            700: '#0B5454',
                            800: '#0E6973', // Dark teal
                            900: '#051C1E',
                        },
                        secondary: {
                            50: '#FEF9E7',
                            100: '#FDF3CF',
                            200: '#FBE79F',
                            300: '#F9DB6F',
                            400: '#F7CF3F',
                            500: '#F2BB16', // Golden yellow
                            600: '#BF820F', // Dark gold
                            700: '#8F6C0B',
                            800: '#5F4807',
                            900: '#2F2404',
                        },
                        accent: {
                            50: '#F5FBFA',
                            100: '#EBF7F5',
                            200: '#D7EFEB',
                            300: '#C3E7E1',
                            400: '#AFDFD7',
                            500: '#BAD9CE', // Mint light
                            600: '#95AEA4',
                            700: '#70827B',
                            800: '#4A5752',
                            900: '#252B29',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth Page Transitions */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        main {
            animation: fadeIn 0.6s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #118C8C, #0E6973);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #0E7070, #0E6973);
        }

        /* Mobile Menu Animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-menu-enter {
            animation: slideDown 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-3 sm:px-6">
            <div class="flex justify-between items-center h-16 sm:h-20">

                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group">
                    <div class="relative flex-shrink-0">
                        <!-- Logo Background with Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#66B1B7] via-[#118C8C] to-[#0E7070] rounded-lg sm:rounded-xl blur-md opacity-60 group-hover:opacity-80 transition-opacity"></div>
                        <div class="relative w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#99CBCF] via-[#118C8C] to-[#0E6973] rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold text-lg sm:text-xl shadow-xl group-hover:scale-110 transition-transform">
                            <img src="{{ asset('images/logo/logomce.png') }}" alt="logo mce" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors truncate">
                            Magetan Campus Expo
                        </span>
                        <span class="text-[10px] sm:text-xs text-gray-500 font-medium truncate hidden xs:block">
                            Mega Gumelar Paraning Lawu
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <ul class="hidden lg:flex items-center gap-1">
                    <li>
                        <a href="{{ route('home') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 font-medium {{ request()->routeIs('home') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('campuses.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 font-medium {{ request()->routeIs('campuses.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                            Kampus
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('schedule.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 font-medium {{ request()->routeIs('schedule.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                            Jadwal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 font-medium {{ request()->routeIs('gallery.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all duration-200 font-medium {{ request()->routeIs('contact.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                            Kontak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('feedback.create') }}"
                            class="ml-2 px-5 py-2.5 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Feedback
                        </a>
                    </li>
                </ul>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-4 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all font-medium {{ request()->routeIs('home') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                    🏠 Home
                </a>
                <a href="{{ route('campuses.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all font-medium {{ request()->routeIs('campuses.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                    🎓 Kampus
                </a>
                <a href="{{ route('schedule.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all font-medium {{ request()->routeIs('schedule.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                    📅 Jadwal
                </a>
                <a href="{{ route('gallery.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all font-medium {{ request()->routeIs('gallery.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                    🖼️ Galeri
                </a>
                <a href="{{ route('contact.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:text-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all font-medium {{ request()->routeIs('contact.*') ? 'text-[#118C8C] bg-[#BAD9CE]/20' : '' }}">
                    📞 Kontak
                </a>
                <a href="{{ route('feedback.create') }}"
                    class="block px-4 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white rounded-lg font-semibold text-center">
                    ✍️ Beri Feedback
                </a>
            </div>
        </div>
    </nav>

    <!-- Spacer for Fixed Navbar -->
    <div class="h-20"></div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
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
                        <div class="w-12 h-12 bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-xl flex items-center justify-center shadow-lg overflow-hidden">
                            <img src="{{ asset('images/logo/logomce.png') }}" alt="MCE Logo" class="w-full h-full object-contain">
                        </div>
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
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-[#BAD9CE]">Menu Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Home</a></li>
                        <li><a href="{{ route('campuses.index') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Daftar Kampus</a></li>
                        <li><a href="{{ route('schedule.index') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Jadwal Acara</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-300 hover:text-[#F2BB16] transition-colors">Galeri Foto</a></li>
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
                            <span class="text-sm">info@magetancampusexpo.id</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 mt-0.5 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm">+62 xxx xxxx xxxx</span>
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

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');

            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                mobileMenu.classList.add('mobile-menu-enter');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            }
        });

        // Close mobile menu when window is resized to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.add('hidden');
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            }
        });
    </script>

</body>

</html>