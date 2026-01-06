@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="bg-gradient-to-br from-gray-50 via-[#BAD9CE]/10 to-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-[#118C8C] via-[#0E6973] to-[#118C8C] rounded-2xl lg:rounded-3xl shadow-xl p-8 lg:p-12 text-white mb-8 lg:mb-12">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#BAD9CE]/20 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-1.5 mb-4">
                            <span class="w-2 h-2 bg-[#F2BB16] rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-[#BAD9CE]">Dashboard Peserta</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3">
                            Selamat Datang, <span class="text-[#F2BB16]">{{ Auth::user()->name }}</span>!
                        </h1>
                        <p class="text-lg text-[#BAD9CE] leading-relaxed">Kembangkan karir impianmu bersama MCE 2026</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-2xl flex items-center justify-center text-5xl shadow-2xl transform hover:rotate-6 transition-transform">
                            🎓
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8 lg:mb-12">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 group hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl lg:text-4xl font-bold text-[#0E6973] mb-1">
                    {{ Auth::user()->registrations()->count() ?? 0 }}
                </div>
                <p class="text-gray-600 text-sm font-medium">Tiket Terbeli</p>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 group hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl lg:text-4xl font-bold text-[#0E6973] mb-1">
                    {{ \App\Models\Campus::count() }}
                </div>
                <p class="text-gray-600 text-sm font-medium">Kampus Tersedia</p>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 group hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#F2BB16]/20 to-[#BF820F]/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl lg:text-4xl font-bold text-[#BF820F] mb-1">
                    {{ \App\Models\Schedule::count() }}
                </div>
                <p class="text-gray-600 text-sm font-medium">Jadwal Event</p>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 group hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#F2BB16]/20 to-[#BF820F]/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl lg:text-4xl font-bold text-[#BF820F] mb-1">
                    {{ \App\Models\Gallery::count() }}
                </div>
                <p class="text-gray-600 text-sm font-medium">Foto Galeri</p>
            </div>
        </div>

        <!-- Main Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-8 lg:mb-12">
            
            <!-- Feature Card: Tiket -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <span class="bg-[#BAD9CE]/30 text-[#0E6973] text-sm font-bold px-3 py-1.5 rounded-full border border-[#118C8C]/20">
                            {{ Auth::user()->registrations()->where('payment_status', 'paid')->count() ?? 0 }}
                        </span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Tiket Saya</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Lihat dan kelola tiket MCE 2026 Anda dengan mudah</p>
                    <a href="{{ route('user.tickets.index') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Lihat Tiket</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feature Card: Kampus -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="bg-[#BAD9CE]/30 text-[#0E6973] text-sm font-bold px-3 py-1.5 rounded-full border border-[#118C8C]/20">
                            {{ \App\Models\Campus::count() }}
                        </span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Kampus</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Jelajahi kampus dan jurusan impian Anda</p>
                    <a href="{{ route('campus.index') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Jelajahi Kampus</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feature Card: Jadwal -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#F2BB16] to-[#BF820F]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#F2BB16]/20 to-[#BF820F]/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-[#F2BB16]/20 text-[#BF820F] text-sm font-bold px-3 py-1.5 rounded-full border border-[#F2BB16]/30">
                            {{ \App\Models\Schedule::count() }}
                        </span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Jadwal</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Lihat jadwal lengkap acara MCE 2026</p>
                    <a href="{{ route('schedule.index') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Lihat Jadwal</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feature Card: Galeri -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-[#BAD9CE]/30 text-[#0E6973] text-sm font-bold px-3 py-1.5 rounded-full border border-[#118C8C]/20">
                            {{ \App\Models\Gallery::count() }}
                        </span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Galeri</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Lihat koleksi foto MCE dan event terdahulu</p>
                    <a href="{{ route('gallery.index') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Lihat Galeri</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feature Card: Feedback -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Feedback</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Bagikan aspirasi dan saran Anda untuk MCE</p>
                    <a href="{{ route('feedback.create') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Kirim Feedback</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feature Card: Profile -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-[#118C8C]/30">
                <div class="h-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973]"></div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3">Profile</h3>
                    <p class="text-gray-600 text-sm lg:text-base mb-6 leading-relaxed">Kelola data pribadi dan informasi akun Anda</p>
                    <a href="{{ route('profile.edit') }}" class="group/btn inline-flex items-center justify-center w-full px-6 py-3.5 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        <span>Edit Profile</span>
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Info Section -->
        <div class="bg-gradient-to-r from-white to-[#BAD9CE]/20 rounded-2xl shadow-lg p-6 lg:p-8 border-l-4 border-[#F2BB16]">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#F2BB16]/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        Informasi Penting
                    </h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#118C8C] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm lg:text-base leading-relaxed">MCE 2026 akan diselenggarakan pada <span class="font-semibold text-[#0E6973]">15-17 Januari 2026</span> di Gor Ki Mageti, Magetan</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#118C8C] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm lg:text-base leading-relaxed">Jangan lupa beli tiket untuk mendapatkan akses dan merchandise eksklusif</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#118C8C] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm lg:text-base leading-relaxed">Konsultasi langsung dengan panitia tersedia di halaman Kontak</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection