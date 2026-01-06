@extends('layouts.app')

@section('title', 'Kampus - Preview')

@section('content')
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Kampus Peserta MCE 2026</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Jelajahi kampus-kampus terkemuka se-Indonesia. Daftar dan login untuk melihat daftar lengkap.
            </p>
        </div>

        @if($campuses->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada kampus yang terdaftar.</p>
        </div>
        @else
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            @foreach($campuses as $campus)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition p-6 space-y-3">
                <h3 class="text-xl font-semibold text-gray-900">{{ $campus->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $campus->address ?? '-' }}</p>
                <p class="text-gray-700 line-clamp-3">{{ $campus->description ?? 'Informasi lengkap tersedia setelah login.' }}</p>
                <div class="flex gap-2 pt-3">
                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2 bg-teal-600 text-white rounded-lg text-sm font-semibold hover:bg-teal-700">
                        Login untuk Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center space-y-4">
            <p class="text-gray-600">Hanya menampilkan {{ count($campuses) }} dari {{ \App\Models\Campus::count() }} kampus</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-teal-600 text-white rounded-xl font-semibold shadow hover:bg-teal-700">
                    Login untuk Lihat Semua
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 border border-teal-200 text-teal-700 rounded-xl font-semibold hover:bg-teal-50">
                    Daftar Akun Baru
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection