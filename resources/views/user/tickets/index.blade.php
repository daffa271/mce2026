@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">🎫 Tiket Saya</h1>
                <p class="text-gray-600">Pantau status pembelian tiket Anda dan akses e-ticket setelah terverifikasi.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
        @endif
        @if(session('info'))
        <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">{{ session('info') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">{{ session('error') }}</div>
        @endif

        @if($registrations->isEmpty())
        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
            <div class="text-5xl mb-4">📭</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum ada tiket</h3>
            <p class="text-gray-600 mb-6">Lakukan pembelian tiket untuk mendapatkan akses ke seluruh rangkaian MCE 2026.</p>
            <div class="flex justify-center">
                @if(!$hasActiveRegistration)
                <a href="{{ route('user.tickets.select') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-xl shadow hover:shadow-lg transition">
                    Pilih Paket Tiket
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
                    </svg>
                </a>
                @else
                <span class="inline-flex items-center gap-2 px-4 py-3 bg-gray-200 text-gray-600 font-semibold rounded-xl">
                    Pembelian sudah dilakukan
                </span>
                @endif
            </div>
        </div>
        @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($registrations as $registration)
            @php
            $paymentStatus = $registration->payment_status ?? 'pending';
            $verificationStatus = $registration->verification_status ?? 'pending';
            $badgeText = 'Menunggu Pembayaran';
            $badgeStyle = 'bg-orange-100 text-orange-800';
            if ($verificationStatus === 'verified') {
            $badgeText = 'Terverifikasi';
            $badgeStyle = 'bg-green-100 text-green-800';
            } elseif ($verificationStatus === 'rejected') {
            $badgeText = 'Ditolak';
            $badgeStyle = 'bg-red-100 text-red-800';
            } elseif ($paymentStatus === 'paid') {
            $badgeText = 'Menunggu Verifikasi';
            $badgeStyle = 'bg-yellow-100 text-yellow-800';
            }
            @endphp
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 flex flex-col gap-4">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-gray-500">Paket</p>
                        <h3 class="text-xl font-bold text-gray-900">{{ optional($registration->ticketPackage)->name ?: 'Tiket' }}</h3>
                        <p class="text-xs text-gray-500">Kode: {{ $registration->registration_code }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeStyle }}">{{ $badgeText }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <p class="text-gray-500">Jumlah</p>
                        <p class="font-semibold">{{ $registration->quantity ?? 1 }} tiket</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Bayar</p>
                        <p class="font-semibold">Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    @if($verificationStatus === 'verified')
                    <a href="{{ route('tickets.show', $registration->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white font-semibold rounded-lg hover:shadow transition">
                        Lihat Tiket
                    </a>
                    @elseif($paymentStatus !== 'paid')
                    <a href="{{ route('user.tickets.payment', $registration->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                        Lanjutkan Pembayaran
                    </a>
                    @else
                    <a href="{{ route('user.tickets.payment', $registration->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Lihat Status Pembayaran
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection