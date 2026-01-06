@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <div class="inline-block bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">ADMIN PANEL</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">📊 Dashboard</h1>
            <p class="text-gray-600">Ringkasan cepat aktivitas dan data sistem.</p>
        </div>

        <!-- Stats Row 1 -->
        <div class="grid md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#118C8C] hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-600 font-semibold">Total Kampus</p>
                    <div class="w-10 h-10 rounded-lg bg-[#118C8C]/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#118C8C]">{{ $campusCount }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-blue-500 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-600 font-semibold">Total Peserta</p>
                    <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-blue-500">{{ $participantCount }}</p>
                <p class="text-xs text-gray-500 mt-1">User yang registrasi</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#F2BB16] hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-600 font-semibold">Tiket Terbeli</p>
                    <div class="w-10 h-10 rounded-lg bg-[#F2BB16]/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#F2BB16]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#BF820F]">{{ $ticketsSoldCount }}</p>
                <p class="text-xs text-gray-500 mt-1">Terverifikasi</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-green-500 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-600 font-semibold">Feedback Masuk</p>
                    <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-green-600">{{ $feedbackCount }}</p>
                <p class="text-xs text-gray-500 mt-1">Guest & User</p>
            </div>
        </div>

        <!-- Stats Row 2 - Verification Status -->
        <div class="grid md:grid-cols-2 gap-6 mb-10">
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-yellow-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-yellow-800 font-semibold mb-1">⏳ Menunggu Verifikasi</p>
                        <p class="text-3xl font-bold text-yellow-700">{{ $pendingVerificationCount }}</p>
                        <p class="text-xs text-yellow-600 mt-1">Pembayaran perlu diverifikasi</p>
                    </div>
                    <a href="{{ route('admin.registrations.index') }}" class="px-4 py-2 border-2 border-gray-900 text-gray-900 rounded-lg font-semibold text-sm hover:bg-gray-900 hover:text-white transition-colors">
                        Cek Sekarang
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-green-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-green-800 font-semibold mb-1">✅ Terverifikasi</p>
                        <p class="text-3xl font-bold text-green-700">{{ $verifiedCount }}</p>
                        <p class="text-xs text-green-600 mt-1">Pembayaran sudah disetujui</p>
                    </div>
                    <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-semibold text-sm">
                        Selesai
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#118C8C] to-[#0E6973] flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">⚡ Aksi Cepat</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-5">
                <a href="{{ route('admin.registrations.index') }}" class="group relative block p-6 rounded-xl border-2 border-[#118C8C]/30 hover:border-[#118C8C] hover:shadow-xl transition-all transform hover:-translate-y-1 bg-gradient-to-br from-white to-[#118C8C]/5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#118C8C] to-[#0E6973] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Kelola Registrasi</h3>
                            @if($pendingVerificationCount > 0)
                            <span class="inline-block px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">{{ $pendingVerificationCount }} perlu verifikasi</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">Verifikasi pembayaran, lihat detail peserta, dan ekspor data registrasi.</p>
                </a>

                <a href="{{ route('admin.ticket-packages.index') }}" class="group relative block p-6 rounded-xl border-2 border-[#F2BB16]/30 hover:border-[#F2BB16] hover:shadow-xl transition-all transform hover:-translate-y-1 bg-gradient-to-br from-white to-[#F2BB16]/5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#F2BB16] to-[#BF820F] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Buat & Kelola Paket Tiket</h3>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">Tambah paket baru, atur harga, kuota, dan jadwal penjualan tiket.</p>
                </a>

                <a href="{{ route('admin.aspirations.index') }}" class="group relative block p-6 rounded-xl border-2 border-green-300 hover:border-green-500 hover:shadow-xl transition-all transform hover:-translate-y-1 bg-gradient-to-br from-white to-green-50">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: none;
                                            stroke: #020202;
                                            stroke-miterlimit: 10;
                                            stroke-width: 1.91px;
                                        }
                                    </style>
                                </defs>
                                <path class="cls-1" d="M18.68,8.16V15.8a2.86,2.86,0,0,1-2.86,2.86H13.91v2.86L8.18,18.66H4.36A2.86,2.86,0,0,1,1.5,15.8V8.16A2.86,2.86,0,0,1,4.36,5.3H15.82A2.86,2.86,0,0,1,18.68,8.16Z" />
                                <path class="cls-1" d="M18.68,14.84h1A2.86,2.86,0,0,0,22.5,12V4.34a2.86,2.86,0,0,0-2.86-2.86H8.18A2.86,2.86,0,0,0,5.32,4.34v1" />
                                <line class="cls-1" x1="5.32" y1="11.98" x2="7.23" y2="11.98" />
                                <line class="cls-1" x1="9.14" y1="11.98" x2="11.05" y2="11.98" />
                                <line class="cls-1" x1="12.95" y1="11.98" x2="14.86" y2="11.98" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Tinjau Aspirasi & Feedback</h3>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">Baca dan kelola masukan dari guest dan peserta yang sudah login.</p>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection