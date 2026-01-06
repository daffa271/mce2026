@extends('layouts.app')

@section('title', 'Tentang MCE 2026')

@section('content')
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="space-y-2">
            <p class="text-sm font-semibold text-teal-700 uppercase tracking-wide">Tentang</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Magetan Campus Expo 2026</h1>
            <p class="text-gray-600 text-lg leading-relaxed">
                Magetan Campus Expo (MCE) adalah ajang tahunan yang mempertemukan pelajar SMA/SMK sederajat
                dengan berbagai perguruan tinggi se-Indonesia untuk eksplorasi kampus, jurusan, dan peluang beasiswa.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="p-6 rounded-2xl border border-gray-100 shadow-sm bg-teal-50/50">
                <h2 class="text-xl font-semibold text-teal-800 mb-2">Tujuan</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>Membantu siswa menemukan kampus dan jurusan yang tepat.</li>
                    <li>Memberi akses informasi beasiswa dan jalur masuk.</li>
                    <li>Membangun jejaring antara sekolah, kampus, dan industri.</li>
                </ul>
            </div>
            <div class="p-6 rounded-2xl border border-gray-100 shadow-sm bg-white">
                <h2 class="text-xl font-semibold text-teal-800 mb-2">Highlight</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>Pameran kampus & konsultasi one-on-one.</li>
                    <li>Seminar karier & workshop persiapan kuliah.</li>
                    <li>Zona beasiswa dan info jalur prestasi.</li>
                </ul>
            </div>
        </div>

        <div class="p-6 rounded-2xl border border-gray-100 shadow-sm bg-white">
            <h2 class="text-xl font-semibold text-teal-800 mb-3">Info Penyelenggaraan</h2>
            <div class="grid sm:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-semibold">15-17 Januari 2026</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Lokasi</p>
                    <p class="font-semibold">Gor Ki Mageti, Magetan</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Peserta</p>
                    <p class="font-semibold">Siswa SMA/SMK/MA sederajat</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kampus Peserta</p>
                    <p class="font-semibold">25+ Perguruan Tinggi</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('campus.preview') }}" class="px-6 py-3 rounded-xl bg-teal-600 text-white font-semibold shadow hover:bg-teal-700">Lihat Kampus (Preview)</a>
            <a href="{{ route('schedule.preview') }}" class="px-6 py-3 rounded-xl border border-teal-200 text-teal-700 font-semibold hover:bg-teal-50">Lihat Jadwal (Preview)</a>
        </div>
    </div>
</section>
@endsection