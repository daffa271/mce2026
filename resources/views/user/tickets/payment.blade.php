@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <div class="inline-block bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">LANGKAH 2 dari 3</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">💰 Verifikasi Pembayaran</h1>
            <p class="text-lg text-gray-600">Upload bukti pembayaran untuk menyelesaikan registrasi Anda</p>
        </div>

        <!-- Success/Info Message -->
        @php
        $alreadyPaid = (($registration->payment_status ?? 'pending') === 'paid');
        $showSuccess = session('success') || $alreadyPaid;
        $successTitle = $alreadyPaid
        ? 'Bukti Pembayaran Berhasil Dikirim! 🎉'
        : 'Registrasi berhasil! Silakan lakukan pembayaran sekarang.';
        $successText = session('success') ?? ($alreadyPaid ? 'Tunggu verifikasi admin untuk mendapatkan QR Code.' : '');
        @endphp
        @if($showSuccess)
        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-6 shadow-lg animate-fade-in" x-data="{ show: true }" x-show="show" x-transition>
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-green-900 mb-1">{{ $successTitle }}</h3>
                    @if($successText)
                    <p class="text-green-800">{{ $successText }}</p>
                    @endif
                </div>
                <button @click="show = false" class="flex-shrink-0 text-green-500 hover:text-green-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Session Error Message -->
        @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-6 shadow-lg">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-red-900 mb-2">❌ Gagal Mengunggah Bukti Pembayaran</h3>
                    <p class="text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-6 shadow-lg">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-red-900 mb-2">❌ Ada kesalahan:</h3>
                    <ul class="list-disc list-inside text-red-800 space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Step Indicator -->
        <div class="mb-8 step-indicator">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white border-2 border-green-500 rounded-full flex items-center justify-center text-green-600 font-bold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-semibold text-green-600">Registrasi</span>
                    </div>
                    <div class="w-20 h-1 bg-gradient-to-r from-green-500 to-[#118C8C] mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-[#118C8C] to-[#0E6973] rounded-full flex items-center justify-center text-white font-bold animate-pulse">
                            2
                        </div>
                        <span class="ml-2 text-sm font-semibold text-[#118C8C]">Pembayaran</span>
                    </div>
                    <div class="w-20 h-1 bg-gray-300 mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold">
                            3
                        </div>
                        <span class="ml-2 text-sm font-semibold text-gray-500">Verifikasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Info Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-t-4 border-[#118C8C]">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">📋 Detail Registrasi</h3>
            </div>

            <div class="grid md:grid-cols-2 gap-6 info-grid">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 border border-blue-200">
                    <p class="text-sm text-blue-700 font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                        Kode Registrasi
                    </p>
                    <p class="font-mono font-bold text-xl text-blue-900 bg-white px-4 py-2 rounded-lg border-2 border-blue-300">{{ $registration->registration_code }}</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-5 border border-purple-200">
                    <p class="text-sm text-purple-700 font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                        </svg>
                        Paket Tiket
                    </p>
                    <p class="font-bold text-xl text-purple-900">{{ $registration->ticketPackage->name ?? 'N/A' }}</p>
                    <p class="text-xs text-purple-600 mt-1">{{ $registration->quantity ?? 1 }} Tiket</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-5 border border-green-200">
                    <p class="text-sm text-green-700 font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                        Total Pembayaran
                    </p>
                    @php
                    $baseTotal = ($registration->ticketPackage->price ?? 0) * ($registration->quantity ?? 1);
                    $finalTotal = $registration->total_amount ?? $baseTotal;
                    $discountAmount = max(0, $baseTotal - $finalTotal);
                    @endphp
                    <div class="space-y-1">
                        <p class="text-3xl font-bold text-green-700">Rp{{ number_format($finalTotal, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-600">Subtotal: Rp{{ number_format($baseTotal, 0, ',', '.') }}</p>
                        @if($discountAmount > 0)
                        <p class="text-xs text-emerald-700 font-semibold">Diskon: -Rp{{ number_format($discountAmount, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl p-5 border border-yellow-200">
                    <p class="text-sm text-yellow-700 font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Status Pembayaran
                    </p>
                    @php
                    $badgeText = 'Menunggu Pembayaran';
                    $badgeBg = 'bg-orange-200 text-orange-900';
                    $dotBg = 'bg-orange-600';
                    if (($registration->payment_status ?? 'pending') === 'paid' && ($registration->verification_status ?? 'pending') === 'pending') {
                    $badgeText = 'Menunggu Verifikasi';
                    $badgeBg = 'bg-yellow-200 text-yellow-900';
                    $dotBg = 'bg-yellow-600';
                    }
                    if (($registration->verification_status ?? 'pending') === 'verified') {
                    $badgeText = 'Terverifikasi';
                    $badgeBg = 'bg-green-200 text-green-900';
                    $dotBg = 'bg-green-600';
                    }
                    @endphp
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-bold shadow-sm {{ $badgeBg }}">
                        <span class="w-2 h-2 rounded-full animate-pulse {{ $dotBg }}"></span>
                        {{ $badgeText }}
                    </span>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="mt-6 bg-gradient-to-r from-orange-50 to-red-50 border-l-4 border-orange-500 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-orange-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-bold text-orange-900 mb-1">⚠️ Penting!</p>
                        <p class="text-sm text-orange-800">Pastikan jumlah transfer <strong>sesuai persis</strong> dengan total pembayaran di atas untuk mempercepat proses verifikasi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discount Code -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-t-4 border-emerald-500">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-6 0h6v6" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">🎟️ Kode Diskon</h3>
            </div>
            @if(!($registration->payment_status === 'paid' || $registration->verification_status === 'verified'))
            <form action="{{ route('user.tickets.apply-discount', $registration->id) }}" method="POST" class="space-y-4" id="discount-form">
                @csrf
                <input type="hidden" id="base-price" value="{{ (int)(($registration->ticketPackage->price ?? 0) * ($registration->quantity ?? 1)) }}">
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Masukkan Kode Diskon</label>
                        <input type="text" name="code" id="discount_code" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 uppercase" placeholder="MISAL: MCE50" value="">
                    </div>
                    <div class="flex items-end">
                        <button type="button" id="btn-check-discount" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg">Cek Kode</button>
                    </div>
                </div>
                <div id="discount-message" class="text-sm mt-1"></div>
                <div class="hidden" id="apply-wrapper">
                    <button type="submit" class="mt-2 w-full md:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-teal-600 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-lg shadow">Terapkan Diskon</button>
                </div>
            </form>
            @else
            <p class="text-sm text-gray-600">Diskon tidak dapat diterapkan setelah pembayaran atau verifikasi.</p>
            @endif
        </div>

        <!-- Bank Transfer Info -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-8 mb-8 shadow-xl">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">🏦 Pilih Metode Pembayaran</h3>
                    <p class="text-sm text-gray-600">Transfer ke salah satu rekening berikut</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <!-- BCA -->
                <div class="bg-white p-6 rounded-xl border-2 border-blue-300 hover:border-blue-500 transition-all hover:shadow-lg transform hover:-translate-y-1 duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <picture class="w-8 h-8">
                                <source srcset="{{ asset('images/logobank/bca.png') }}" type="image/svg+xml">
                                <source srcset="{{ asset('images/logobank/bca.png') }}" type="image/png">
                                <img src="{{ asset('images/logobank/bca.jpeg') }}" alt="BCA Logo" class="w-8 h-8 object-contain">
                            </picture>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Bank BCA</p>
                            <p class="text-lg font-bold text-gray-900">1234567890</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                        <p class="text-xs text-blue-700 font-semibold">Atas Nama:</p>
                        <p class="text-sm font-bold text-blue-900">MCE PANITIA</p>
                    </div>
                </div>

                <!-- seabank -->
                <div class="bg-white p-6 rounded-xl border-2 border-cyan-300 hover:border-cyan-500 transition-all hover:shadow-lg transform hover:-translate-y-1 duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-cyan-500 rounded-lg flex items-center justify-center">
                            <picture class="w-8 h-8">
                                <source srcset="{{ asset('images/logobank/seabanklogo.png') }}" type="image/svg+xml">
                                <source srcset="{{ asset('images/logobank/seabanklogo.png') }}" type="image/png">
                                <img src="{{ asset('images/logobank/seabanklogo.png') }}" alt="SeaBank Logo" class="w-8 h-8 object-contain">
                            </picture>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">SeaBank</p>
                            <p class="text-lg font-bold text-gray-900">9876543210</p>
                        </div>
                    </div>
                    <div class="bg-cyan-50 rounded-lg p-3 border border-cyan-200">
                        <p class="text-xs text-cyan-700 font-semibold">Atas Nama:</p>
                        <p class="text-sm font-bold text-cyan-900">MCE PANITIA</p>
                    </div>
                </div>

                <!-- BRI -->
                <div class="bg-white p-6 rounded-xl border-2 border-indigo-300 hover:border-indigo-500 transition-all hover:shadow-lg transform hover:-translate-y-1 duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <picture class="w-8 h-8">
                                <source srcset="{{ asset('images/logobank/bri.png') }}" type="image/svg+xml">
                                <source srcset="{{ asset('images/logobank/bri.png') }}" type="image/png">
                                <img src="{{ asset('images/logobank/bri.jpeg') }}" alt="BRI Logo" class="w-8 h-8 object-contain">
                            </picture>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Bank BRI</p>
                            <p class="text-lg font-bold text-gray-900">5555666677</p>
                        </div>
                    </div>
                    <div class="bg-indigo-50 rounded-lg p-3 border border-indigo-200">
                        <p class="text-xs text-indigo-700 font-semibold">Atas Nama:</p>
                        <p class="text-sm font-bold text-indigo-900">MCE PANITIA</p>
                    </div>
                </div>

                <!-- QRIS -->
                <div class="bg-white p-6 rounded-xl border-2 border-green-300 hover:border-green-500 transition-all hover:shadow-lg transform hover:-translate-y-1 duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <picture class="w-8 h-8">
                                <source srcset="{{ asset('images/logobank/qris.png') }}" type="image/svg+xml">
                                <source srcset="{{ asset('images/logobank/qris.png') }}" type="image/png">
                                <img src="{{ asset('images/logobank/qris.png') }}" alt="QRIS Logo" class="w-8 h-8 object-contain">
                            </picture>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">QRIS / E-Wallet</p>
                            <p class="text-lg font-bold text-gray-900">081234567890</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                        <p class="text-xs text-green-700 font-semibold">Hubungi:</p>
                        <p class="text-sm font-bold text-green-900">WhatsApp untuk QRIS</p>
                    </div>
                </div>
            </div>

            <!-- Pro Tip -->
            <div class="bg-white rounded-xl p-5 border-2 border-blue-200 shadow-md">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-blue-900 mb-1">💡 Tips Agar Verifikasi Cepat:</p>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 font-bold">•</span>
                                <span>Sertakan <strong class="font-bold">kode registrasi ({{ $registration->registration_code }})</strong> di deskripsi/berita transfer</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 font-bold">•</span>
                                <span>Transfer sesuai <strong class="font-bold">nominal persis</strong> untuk mempermudah identifikasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 font-bold">•</span>
                                <span>Screenshot bukti transfer yang <strong class="font-bold">jelas dan lengkap</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Proof Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-t-4 border-[#F2BB16]">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">📸 Upload Bukti Pembayaran</h3>
            </div>

            @if(!$alreadyPaid)
            <form action="{{ route('user.tickets.upload', $registration->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Bundle Participants Form (Jika paket bundle) -->
                @if($registration->ticketPackage->is_bundle)
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 border-2 border-purple-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">👥 Data Peserta Bundle</h3>
                    </div>

                    <p class="text-gray-700 mb-6 bg-white rounded-lg p-4 border border-purple-200">
                        <span class="font-bold text-purple-900">Paket Bundle Anda adalah untuk {{ $registration->ticketPackage->bundle_size }} peserta.</span><br>
                        Silakan isi data lengkap setiap peserta di bawah ini. Data ini akan tercantum dalam e-ticket masing-masing peserta.
                    </p>

                    <div class="space-y-6">
                        @for($i = 1; $i <= $registration->ticketPackage->bundle_size; $i++)
                            <div class="bg-white rounded-xl p-6 border-2 border-purple-200 hover:border-purple-400 transition-all">
                                <h4 class="font-bold text-purple-900 mb-4 text-lg flex items-center gap-2">
                                    <span class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ $i }}
                                    </span>
                                    Peserta {{ $i }} <span class="text-red-500">*</span>
                                </h4>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text"
                                            name="participant_{{ $i }}_name"
                                            required
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all @error('participant_' . $i . '_name') border-red-500 @enderror"
                                            placeholder="Masukkan nama lengkap peserta {{ $i }}"
                                            value="{{ old('participant_' . $i . '_name') }}">
                                        @error('participant_' . $i . '_name')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m3.419 0H9m0 0a2 2 0 100-4m0 4a2 2 0 110-4m0 0V7m0 4a2 2 0 100-4m0 4a2 2 0 110-4m0 0V7" />
                                            </svg>
                                            Asal Sekolah
                                        </label>
                                        <input type="text"
                                            name="participant_{{ $i }}_school"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                            placeholder="Contoh: SMA Negeri 1 Magetan"
                                            value="{{ old('participant_' . $i . '_school') }}">
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </div>

                    <div class="mt-6 bg-gradient-to-r from-purple-100 to-pink-100 rounded-lg p-4 border border-purple-300">
                        <p class="text-sm text-purple-900">
                            <span class="font-bold">📋 Catatan:</span> Data peserta yang Anda isikan akan digunakan untuk membuat e-ticket individual. Pastikan nama dan sekolah sudah benar karena akan ditampilkan di QR code masing-masing peserta.
                        </p>
                    </div>
                </div>
                @endif

                <!-- Payment Method Selection -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-200">
                    <label for="payment_method" class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 002-2h10a2 2 0 002 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                        </svg>
                        Metode Pembayaran yang Digunakan <span class="text-red-500">*</span>
                    </label>
                    <select id="payment_method" name="payment_method" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all" required>
                        <option value="">🔽 Pilih metode pembayaran yang Anda gunakan</option>
                        <option value="bank_transfer">🏦 Transfer Bank (BCA/Mandiri/BRI)</option>
                        <option value="qris">📱 QRIS / E-Wallet (OVO/DANA/GoPay/ShopeePay)</option>
                        <option value="other">💳 Metode Lainnya</option>
                    </select>
                    <p class="text-xs text-gray-600 mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Pilih sesuai dengan metode yang Anda gunakan untuk transfer
                    </p>
                </div>

                <!-- File Upload -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-200">
                    <label for="payment_proof" class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                        Upload Screenshot/Foto Bukti Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <div class="relative border-3 border-dashed border-[#118C8C] rounded-xl p-8 bg-white hover:bg-blue-50 transition-all">
                        <input type="file" id="payment_proof" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*,.pdf" required onchange="updateFileName(this)">
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-[#118C8C] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm font-semibold text-gray-700 mb-1" id="file-label">
                                Klik atau drag & drop file di sini
                            </p>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, atau PDF • Maksimal 5MB</p>
                        </div>
                    </div>
                    <div class="mt-3 bg-blue-50 rounded-lg p-3 border border-blue-200">
                        <p class="text-xs font-semibold text-blue-900 mb-2">✅ Pastikan bukti pembayaran mencakup:</p>
                        <ul class="text-xs text-blue-800 space-y-1">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                Nama bank & nomor rekening tujuan
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                Nominal transfer yang dibayarkan
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                Tanggal & waktu transaksi
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                                Status transaksi "BERHASIL" atau "SUCCESS"
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-200">
                    <label for="notes" class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Catatan Tambahan (Opsional)
                    </label>
                    <textarea id="payment_notes" name="payment_notes" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all" rows="4" placeholder="Contoh: &#10;• Nama pengirim: Budi Santoso&#10;• Waktu transfer: 14:30 WIB&#10;• Bank pengirim: BCA&#10;• Catatan lainnya..."></textarea>
                    <p class="text-xs text-gray-600 mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Informasi tambahan untuk mempermudah verifikasi
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-4 cta-buttons">
                    <button type="submit" class="group relative w-full bg-gradient-to-r from-[#118C8C] to-[#0E6973] hover:from-[#0E6973] hover:to-[#118C8C] text-white font-bold py-5 px-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-lg">Kirim Bukti Pembayaran</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>

                    <p class="text-center text-sm text-gray-600 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Data Anda aman dan akan diverifikasi oleh tim kami</span>
                    </p>
                </div>
            </form>
            @else
            <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-xl p-6">
                <p class="text-yellow-800 font-semibold">Anda sudah mengirim bukti pembayaran. Silakan tunggu verifikasi admin. Form upload dinonaktifkan untuk mencegah pengiriman ulang.</p>
            </div>
            @endif
        </div>
        <!-- Contact Admin -->
        <div class="bg-gradient-to-r from-white via-emerald-50 to-emerald-100 rounded-2xl shadow-xl p-8 text-gray-900 border border-emerald-100 mb-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 shadow">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-emerald-900">Butuh Bantuan? 🤝</h3>
                <p class="mb-6 text-emerald-800">Tim kami siap membantu Anda 24/7</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center contact-actions">
                    <a href="https://wa.me/6285904300285?text=Halo,%20saya%20butuh%20bantuan%20terkait%20pembayaran%20dengan%20kode%20{{ $registration->registration_code }}" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-50 text-green-700 font-bold px-6 py-3 rounded-xl hover:bg-white transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                    <a href="mailto:support@mce2026.com?subject=Bantuan Pembayaran - {{ $registration->registration_code }}" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-blue-50 text-blue-700 font-bold px-6 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 border border-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span class="text-blue-700">Email Support</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('user.tickets.index') }}" class="inline-flex items-center gap-2 text-[#118C8C] hover:text-[#0E6973] font-bold text-lg group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Tiket Saya</span>
            </a>
        </div>
    </div>
</section>

<!-- JavaScript for file name display -->
<script>
    function updateFileName(input) {
        const label = document.getElementById('file-label');
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            label.innerHTML = `
                <span class="text-green-600 font-bold">✓ File dipilih:</span>
                ${file.name}
                <span class="text-gray-500">(${sizeMB} MB)</span>
            `;
        }
    }

    (function() {
        const btn = document.getElementById('btn-check-discount');
        if (!btn) return;

        const input = document.getElementById('discount_code');
        const msg = document.getElementById('discount-message');
        const applyWrapper = document.getElementById('apply-wrapper');
        const basePriceEl = document.getElementById('base-price');
        const basePrice = Number(basePriceEl?.value || 0);

        btn.addEventListener('click', async () => {
            const code = input.value.trim();
            msg.className = 'text-sm mt-1';
            msg.textContent = '';
            applyWrapper.classList.add('hidden');

            if (!code) {
                msg.classList.add('text-red-600');
                msg.textContent = 'Masukkan kode terlebih dahulu.';
                return;
            }

            try {
                const res = await fetch('{{ route("api.validate-discount") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code,
                        price: basePrice
                    })
                });

                const data = await res.json();

                if (!res.ok || !data.valid) {
                    msg.classList.add('text-red-600');
                    msg.textContent = data.message || 'Kode tidak valid.';
                    return;
                }

                msg.classList.add('text-emerald-700', 'font-semibold');
                msg.textContent =
                    `${data.message} • Potongan: Rp${Number(data.discount_amount).toLocaleString('id-ID')} • Total: Rp${Number(data.final_price).toLocaleString('id-ID')}`;

                applyWrapper.classList.remove('hidden');

            } catch (err) {
                msg.classList.add('text-red-600');
                msg.textContent = 'Gagal memvalidasi kode. Coba lagi.';
            }
        });
    })();
</script>


<!-- Animation -->
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.4s ease-out;
    }

    @media (max-width: 640px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .contact-actions a {
            width: 100%;
        }

        .cta-buttons button {
            width: 100%;
        }

        .step-indicator .w-20.h-1 {
            width: 2.5rem;
        }
    }
</style>
@endsection