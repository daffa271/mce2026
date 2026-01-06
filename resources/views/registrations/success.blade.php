@extends('layouts.app')

@section('content')
<section class="max-w-3xl mx-auto px-6 py-12 text-center">
    <div class="bg-white shadow-lg rounded-2xl p-10 border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Pendaftaran Berhasil ✅</h1>
        <p class="text-gray-700 mb-6">Simpan QR code ini dan tunjukkan saat check-in.</p>

        <div class="space-y-2 text-sm text-gray-700">
            <div><strong>ID:</strong> {{ $registration->registration_code }}</div>
            <div><strong>Nama:</strong> {{ $registration->name }}</div>
            <div><strong>Sekolah:</strong> {{ $registration->school }}</div>
        </div>

        @if($registration->qr_code_path)
        <div class="mt-6 flex justify-center">
            <img src="{{ asset('storage/' . $registration->qr_code_path) }}" alt="QR Code" class="w-56 h-56">
        </div>
        <a href="{{ asset('storage/' . $registration->qr_code_path) }}" download class="inline-block mt-4 text-teal-700 font-semibold">
            Download QR
        </a>
        @endif

        <div class="mt-8">
            <a href="{{ route('home') }}" class="text-teal-600 font-semibold">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@endsection