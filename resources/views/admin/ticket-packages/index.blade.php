@extends('layouts.app')

@section('title', 'Kelola Paket Tiket')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-block bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">KELOLA PAKET TIKET</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">🎫 Paket Tiket</h1>
                    <p class="text-gray-600">Kelola semua paket tiket yang tersedia untuk MCE 2026.</p>
                </div>
                <a href="{{ route('admin.ticket-packages.create') }}" class="px-6 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] hover:from-[#BF820F] hover:to-[#F2BB16] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Paket Baru
                    </span>
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#F2BB16]">
                <p class="text-sm text-gray-600 font-semibold mb-2">Total Paket</p>
                <p class="text-4xl font-bold text-[#BF820F]">{{ $packages->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-green-500">
                <p class="text-sm text-gray-600 font-semibold mb-2">Paket Aktif</p>
                <p class="text-4xl font-bold text-green-600">{{ $packages->where('is_active', true)->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-blue-500">
                <p class="text-sm text-gray-600 font-semibold mb-2">Total Terjual</p>
                <p class="text-4xl font-bold text-blue-600">{{ $packages->sum('sold') }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-purple-500">
                <p class="text-sm text-gray-600 font-semibold mb-2">Total Kuota</p>
                <p class="text-4xl font-bold text-purple-600">{{ $packages->sum('quota') }}</p>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
        @endif

        <!-- Ticket Packages List -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            @if($packages->isEmpty())
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Paket Tiket</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan paket tiket pertama Anda.</p>
                <a href="{{ route('admin.ticket-packages.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Paket Baru
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Nama Paket</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Harga</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Kuota</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Terjual</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Sisa</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Periode</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($packages as $package)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#F2BB16] to-[#BF820F] flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $package->name }}</p>
                                        @if($package->is_bundle)
                                        <span class="inline-block px-2 py-0.5 bg-purple-100 text-purple-800 text-xs font-bold rounded-full mt-1">
                                            Bundle {{ $package->bundle_size }} Tiket
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-[#BF820F]">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $package->quota }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-blue-600">{{ $package->sold }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold {{ $package->remaining_quota > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $package->remaining_quota }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @if($package->is_active)
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    Nonaktif
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $package->valid_from?->format('d/m/Y') ?? '-' }}</p>
                                <p class="text-sm text-gray-600">s/d {{ $package->valid_until?->format('d/m/Y') ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.ticket-packages.show', $package->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.ticket-packages.edit', $package->id) }}" class="p-2 text-[#F2BB16] hover:bg-yellow-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.ticket-packages.destroy', $package->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</section>
@endsection