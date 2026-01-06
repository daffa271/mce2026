@extends('layouts.app')

@section('title', 'Galeri - Preview')

@section('content')
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Galeri MCE 2026</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Lihat momen-momen MCE. Daftar dan login untuk melihat galeri lengkap.
            </p>
        </div>

        @if($galleries->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada foto di galeri.</p>
        </div>
        @else
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            @foreach($galleries as $gallery)
            <div class="bg-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group aspect-square">
                @if($gallery->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->image_path))
                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                    alt="{{ $gallery->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <span class="text-gray-400">Foto tidak tersedia</span>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="text-center space-y-4">
            <p class="text-gray-600">Menampilkan {{ count($galleries) }} dari {{ \App\Models\Gallery::count() }} foto</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-teal-600 text-white rounded-xl font-semibold shadow hover:bg-teal-700">
                    Login untuk Galeri Lengkap
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