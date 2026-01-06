@extends('layouts.app')

@section('title', 'Detail Registrasi')

@section('content')
<section class="bg-gray-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-[#118C8C] transition-colors">Dashboard</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('admin.registrations.index') }}" class="text-gray-500 hover:text-[#118C8C] transition-colors">Registrasi</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-600">{{ $registration->registration_code }}</span>
            </div>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">📋 Detail Registrasi</h1>
                    <p class="text-gray-600">Kode: <span class="font-mono font-semibold">{{ $registration->registration_code }}</span></p>
                </div>
                <div class="flex gap-2">
                    @if($registration->payment_status === 'paid' && $registration->verification_status === 'pending')
                    <form action="{{ route('admin.registrations.verify', $registration) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-all shadow-md hover:shadow-lg"
                            onclick="return confirm('Verifikasi pembayaran ini?')">
                            ✓ Verifikasi
                        </button>
                    </form>
                    <form action="{{ route('admin.registrations.reject', $registration) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors"
                            onclick="return confirm('Tolak pembayaran ini?')">
                            ✗ Tolak
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Status Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Status Registrasi</h2>
            <div class="flex flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Pembayaran:</span>
                    @if($registration->payment_status === 'paid')
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Sudah Bayar</span>
                    @else
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Belum Bayar</span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Verifikasi:</span>
                    @if($registration->verification_status === 'verified')
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">✓ Terverifikasi</span>
                    @elseif($registration->verification_status === 'rejected')
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">✗ Ditolak</span>
                    @else
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">Menunggu</span>
                    @endif
                </div>
                @if($registration->is_checked_in)
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Check-in:</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-semibold rounded-full">Sudah Check-in</span>
                </div>
                @endif
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Peserta Info -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Informasi Peserta
                </h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Nama Lengkap</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Email</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">No. Telepon</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Sekolah</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->school ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Kelas</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->grade ?? '-' }}</dd>
                    </div>
                    @if($registration->user)
                    <div>
                        <dt class="text-sm text-gray-500">User Terdaftar</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->user->name }} ({{ $registration->user->email }})</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <!-- Tiket Info -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#F2BB16]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                    </svg>
                    Informasi Tiket
                </h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Paket Tiket</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->ticketPackage->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Jumlah</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->quantity ?? 1 }} tiket</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Total Pembayaran</dt>
                        <dd class="font-bold text-xl text-[#118C8C]">Rp {{ number_format($registration->total_amount, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Metode Pembayaran</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->payment_method ?? '-' }}</dd>
                    </div>
                    @if($registration->paid_at)
                    <div>
                        <dt class="text-sm text-gray-500">Waktu Pembayaran</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->paid_at->format('d M Y H:i') }}</dd>
                    </div>
                    @endif
                    @if($registration->verified_at)
                    <div>
                        <dt class="text-sm text-gray-500">Waktu Verifikasi</dt>
                        <dd class="font-semibold text-gray-900">{{ $registration->verified_at->format('d M Y H:i') }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Bukti Pembayaran -->
        @if($registration->payment_proof)
        <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                Bukti Pembayaran
            </h2>
            <div class="border rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $registration->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full h-auto">
            </div>
        </div>
        @endif

        <!-- Catatan -->
        @if($registration->payment_notes)
        <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Catatan</h2>
            <p class="text-gray-700">{{ $registration->payment_notes }}</p>
        </div>
        @endif

        <!-- Timestamps -->
        <div class="bg-gray-100 rounded-xl p-4 mt-6 text-sm text-gray-600">
            <p>Didaftarkan: {{ $registration->created_at->format('d M Y H:i') }}</p>
            <p>Terakhir diupdate: {{ $registration->updated_at->format('d M Y H:i') }}</p>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('admin.registrations.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</section>
@endsection