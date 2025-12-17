@extends('layouts.app')

@section('title', 'Jadwal Kegiatan')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-emerald-100 to-white">
    <div class="bg-white/80 backdrop-blur-md shadow-lg rounded-2xl p-8 text-center max-w-lg">
        <h1 class="text-2xl font-semibold text-emerald-700 mb-4">📅 Jadwal Kegiatan</h1>
        <p class="text-gray-600 mb-6">
            Saat ini jadwal kegiatan belum tersedia.  
            Silakan cek kembali nanti ya!
        </p>
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 bg-emerald-600 text-white font-semibold px-6 py-3 rounded-full hover:bg-emerald-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
