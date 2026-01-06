@extends('layouts.app')

@section('title', 'Jadwal - Preview')

@section('content')
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Jadwal MCE 2026</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Lihat jadwal lengkap acara MCE 2026. Daftar dan login untuk melihat detail semua kegiatan.
            </p>
        </div>

        @if($schedules->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada jadwal yang tersedia.</p>
        </div>
        @else
        <div class="space-y-4 mb-8">
            @foreach($schedules as $schedule)
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex gap-4">
                <div class="flex-shrink-0 bg-teal-600 text-white rounded-lg p-4 w-24 text-center">
                    <div class="text-sm font-semibold">{{ \Carbon\Carbon::parse($schedule->date)->format('d') }}</div>
                    <div class="text-xs">{{ \Carbon\Carbon::parse($schedule->date)->format('M') }}</div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $schedule->title }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ $schedule->description ?? 'Detail jadwal tersedia setelah login.' }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center space-y-4">
            <p class="text-gray-600">Menampilkan {{ count($schedules) }} dari {{ \App\Models\Schedule::count() }} jadwal</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-teal-600 text-white rounded-xl font-semibold shadow hover:bg-teal-700">
                    Login untuk Jadwal Lengkap
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