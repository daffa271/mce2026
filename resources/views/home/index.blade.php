@extends('layouts.app')

@section('content')
<!-- Hero Section - Custom Color Palette Theme -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#0E6973] via-[#118C8C] to-[#0E6973] text-white min-h-screen flex items-center">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-48 h-48 md:w-72 lg:w-96 md:h-72 lg:h-96 bg-[#F2BB16] rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 md:w-72 lg:w-96 md:h-72 lg:h-96 bg-[#BAD9CE] rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s"></div>
    </div>

    <!-- Mountain Silhouette SVG -->
    <div class="absolute bottom-0 left-0 right-0 opacity-20">
        <svg viewBox="0 0 1200 200" class="w-full h-auto">
            <path d="M0,150 L300,50 L600,100 L900,30 L1200,120 L1200,200 L0,200 Z" fill="currentColor" />
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 lg:py-20 z-10">
        <div class="text-center space-y-6 sm:space-y-8">
            <!-- Event Badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-6 py-2 mb-4">
                <span class="w-2 h-2 bg-[#F2BB16] rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-[#BAD9CE]">Event Tahunan 2026</span>
            </div>

            <!-- Main Title with Cultural Touch -->
            <div class="space-y-3 sm:space-y-4">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.15]">
                    <span class="inline-block overflow-visible bg-gradient-to-r from-[#BAD9CE] via-white to-[#BAD9CE] bg-clip-text text-transparent leading-[1.25] pb-2">
                        Magetan Campus Expo
                    </span>

                    <span class="block text-2xl sm:text-3xl md:text-4xl mt-2 font-light text-[#F2BB16]">
                        2026
                    </span>
                </h1>

                <!-- Theme -->
                <div class="inline-block">
                    <p class="text-lg md:text-xl text-[#F2BB16] font-semibold italic border-b-2 border-[#F2BB16] pb-1">
                        "Mega Gumelar Paraning Lawu"
                    </p>
                </div>
            </div>

            <!-- Tagline -->
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-[#BAD9CE] max-w-3xl mx-auto leading-relaxed px-4">
                Tentukan Kampus Impian, Meraih Masa Depan Cemerlang,
                <span class="font-semibold text-white">Wujudkan Magetan Gemilang</span>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center pt-6 sm:pt-8 w-full sm:w-auto px-4">
                <a href="{{ route('register') }}"
                    class="group relative inline-flex items-center justify-center gap-2 bg-[#F2BB16] text-[#0E6973] font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-full shadow-xl hover:shadow-2xl hover:bg-[#BF820F] transform hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto">
                    <span>Jelajahi Kampus</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:bg-white/20 transition-all duration-300 w-full sm:w-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Lihat Jadwal</span>
                </a>
            </div>

            <!-- Scroll Indicator -->
            <div class="pt-12 animate-bounce">
                <svg class="w-6 h-6 mx-auto text-[#BAD9CE]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Acara - Enhanced with Cultural Elements -->
<section class="py-12 sm:py-16 lg:py-24 bg-gradient-to-b from-white to-[#BAD9CE]/20 relative overflow-hidden">
    <!-- Decorative Pattern -->
    <div class="absolute top-0 right-0 w-64 h-64 opacity-5">
        <svg viewBox="0 0 100 100" class="w-full h-full">
            <pattern id="batik-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <circle cx="10" cy="10" r="2" fill="currentColor" />
                <circle cx="5" cy="5" r="1" fill="currentColor" />
                <circle cx="15" cy="15" r="1" fill="currentColor" />
            </pattern>

        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
            <!-- Content -->
            <div class="space-y-4 sm:space-y-6 order-2 lg:order-1">
                <div class="inline-block">
                    <span class="text-[#118C8C] font-semibold text-sm uppercase tracking-wider">Tentang Event</span>
                    <div class="h-1 w-20 bg-gradient-to-r from-[#118C8C] to-[#0E6973] mt-2 rounded-full"></div>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    Magetan Campus Expo
                </h2>

                <div class="space-y-3 sm:space-y-4 text-gray-600 leading-relaxed text-base sm:text-lg">
                    <p>
                        Magetan Campus Expo (MCE) merupakan kegiatan tahunan yang mempertemukan
                        siswa SMA/SMK sederajat dengan berbagai perguruan tinggi dari seluruh Indonesia.
                    </p>
                    <p>
                        Kegiatan ini bertujuan untuk memberikan informasi, inspirasi, dan motivasi kepada
                        generasi muda dalam menentukan langkah pendidikan tinggi mereka.
                    </p>
                    <div class="bg-gradient-to-r from-[#BAD9CE]/30 to-[#BAD9CE]/10 border-l-4 border-[#118C8C] p-6 rounded-r-xl">
                        <p class="text-[#0E6973] font-semibold text-xl">
                            Tema 2026: <span class="italic">"Mega Gumelar Paraning Lawu"</span>
                        </p>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 pt-6 sm:pt-8">
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#118C8C]">25+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Kampus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#0E6973]">3000+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Pengunjung</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#F2BB16]">10 Hari</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Roadshow</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-[#F2BB16]">1 Hari</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Acara Puncak</div>
                    </div>
                </div>
            </div>

            <!-- Image with Decorative Frame -->
            <div class="relative order-1 lg:order-2">
                <div class="absolute -inset-4 bg-gradient-to-r from-[#118C8C] to-[#0E6973] rounded-3xl opacity-20 blur-2xl"></div>
                <div class="relative">
                    <img src="{{ asset('images/logo/logomce26.png') }}"
                        alt="Magetan Campus Expo"
                        class="rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0E6973]/50 to-transparent rounded-3xl"></div>

                    <!-- Floating Badge -->
                    <div class="absolute -bottom-4 -right-4 sm:-bottom-6 sm:-right-6 bg-white rounded-xl sm:rounded-2xl shadow-xl p-3 sm:p-6 max-w-[140px] sm:max-w-xs">
                        <div class="flex items-center gap-2 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-lg sm:rounded-xl flex items-center justify-center text-white text-xl sm:text-2xl">
                                🎓
                            </div>
                            <div>
                                <div class="text-lg sm:text-2xl font-bold text-gray-900">2026</div>
                                <div class="text-xs sm:text-sm text-gray-600">Event Pendidikan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Highlight Info - Modern Card Design -->
<section class="py-12 sm:py-16 lg:py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12 lg:mb-16">
            <span class="inline-block text-[#118C8C] font-semibold text-xs sm:text-sm uppercase tracking-wider mb-3 sm:mb-4">Keunggulan</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-3 sm:mb-4">
                Kenapa Harus Ikut MCE 2026?
            </h2>
            <p class="text-gray-600 text-base sm:text-lg px-4">
                Temukan berbagai keuntungan dan pengalaman berharga di Magetan Campus Expo
            </p>
        </div>

        <!-- Feature Cards -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Card 1 -->
            <div class="group relative bg-gradient-to-br from-[#BAD9CE]/20 to-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-[#BAD9CE] hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#118C8C]/10 to-transparent rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>

                <div class="relative">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-xl sm:rounded-2xl flex items-center justify-center text-2xl sm:text-3xl mb-4 sm:mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        🎓
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                        Informasi Kampus Lengkap
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Temukan berbagai pilihan universitas, politeknik, dan sekolah tinggi dari seluruh Indonesia dalam satu tempat.
                    </p>

                    <div class="mt-6 flex items-center text-[#118C8C] font-semibold group-hover:gap-2 transition-all">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group relative bg-gradient-to-br from-[#BAD9CE]/20 to-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-[#BAD9CE] hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#118C8C]/10 to-transparent rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>

                <div class="relative">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-xl sm:rounded-2xl flex items-center justify-center text-2xl sm:text-3xl mb-4 sm:mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        💬
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                        Konsultasi Langsung
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Bertanya langsung kepada perwakilan kampus tentang jurusan, beasiswa, hingga kehidupan kuliah.
                    </p>

                    <div class="mt-6 flex items-center text-[#118C8C] font-semibold group-hover:gap-2 transition-all">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group relative bg-gradient-to-br from-[#BAD9CE]/20 to-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-[#BAD9CE] hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#F2BB16]/10 to-transparent rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>

                <div class="relative">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-xl sm:rounded-2xl flex items-center justify-center text-2xl sm:text-3xl mb-4 sm:mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        🚀
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                        Bangun Motivasi & Relasi
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan inspirasi dan jaringan baru untuk menyiapkan perjalanan pendidikan yang lebih baik.
                    </p>

                    <div class="mt-6 flex items-center text-[#F2BB16] font-semibold group-hover:gap-2 transition-all">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Powerful Call to Action -->
<section class="relative py-12 sm:py-16 lg:py-24 overflow-hidden">
    <!-- Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0E6973] via-[#118C8C] to-[#0E6973]"></div>

    <!-- Animated Patterns -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1/4 left-1/4 w-48 h-48 sm:w-64 lg:w-72 sm:h-64 lg:h-72 bg-[#F2BB16] rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 sm:w-64 lg:w-72 sm:h-64 lg:h-72 bg-[#BAD9CE] rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1.5s"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 text-center">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-white/10 backdrop-blur-md rounded-full mb-6 sm:mb-8">
            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
        </div>

        <!-- Title -->
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 px-4">
            Siap Menentukan Masa Depanmu?
        </h2>

        <!-- Description -->
        <p class="text-base sm:text-lg lg:text-xl text-[#BAD9CE] mb-8 sm:mb-10 max-w-2xl mx-auto leading-relaxed px-4">
            Ikuti Magetan Campus Expo 2026 dan mulai jelajahi pilihan kampus terbaik sesuai impianmu. Wujudkan mimpi, raih prestasi!
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center w-full sm:w-auto px-4">
            <a href="{{ route('feedback.guest-form') }}"
                class="group inline-flex items-center justify-center gap-2 sm:gap-3 bg-[#F2BB16] text-[#0E6973] font-bold px-6 sm:px-10 py-4 sm:py-5 rounded-full shadow-2xl hover:shadow-[#F2BB16]/50 hover:bg-[#BF820F] hover:scale-105 transition-all duration-300 w-full sm:w-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Beri Aspirasi & Masukan</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>

            <a href="{{ route('register') }}"
                class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-semibold px-6 sm:px-8 py-4 sm:py-5 rounded-full hover:bg-white/20 transition-all duration-300 w-full sm:w-auto">
                <span>Daftar & Buat Akun</span>
            </a>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-white/20 px-4">
            <p class="text-[#BAD9CE] text-xs sm:text-sm">
                Bergabunglah dengan ribuan pelajar lainnya di acara terbesar tahun ini
            </p>
        </div>
    </div>
</section>

<!-- Additional Styles -->
<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endsection