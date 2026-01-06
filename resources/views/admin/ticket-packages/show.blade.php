@extends('layouts.app')

@section('title', 'Detail Paket Tiket')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-block bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">DETAIL PAKET</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">🎫 {{ $package->name }}</h1>
            <p class="text-gray-600">Informasi lengkap tentang paket tiket ini.</p>
        </div>

        <!-- Package Details -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200 mb-6">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Nama Paket</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $package->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Harga</h3>
                        <p class="text-3xl font-bold text-[#BF820F]">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Status</h3>
                        @if($package->is_active)
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 text-sm font-bold rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Aktif
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-800 text-sm font-bold rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            Nonaktif
                        </span>
                        @endif
                    </div>

                    @if($package->is_bundle)
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Tipe Paket</h3>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-100 text-purple-800 text-sm font-bold rounded-full">
                            Bundle {{ $package->bundle_size }} Tiket
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Kuota</h3>
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <p class="text-3xl font-bold text-gray-900">{{ $package->quota }}</p>
                                <p class="text-xs text-gray-500">Total</p>
                            </div>
                            <div class="text-center">
                                <p class="text-3xl font-bold text-blue-600">{{ $package->sold }}</p>
                                <p class="text-xs text-gray-500">Terjual</p>
                            </div>
                            <div class="text-center">
                                <p class="text-3xl font-bold {{ $package->remaining_quota > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $package->remaining_quota }}</p>
                                <p class="text-xs text-gray-500">Sisa</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Periode Berlaku</h3>
                        <p class="text-gray-900 font-semibold">
                            {{ $package->valid_from ? $package->valid_from->format('d F Y') : 'Tidak dibatasi' }}
                        </p>
                        <p class="text-gray-500">s/d</p>
                        <p class="text-gray-900 font-semibold">
                            {{ $package->valid_until ? $package->valid_until->format('d F Y') : 'Tidak dibatasi' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Tanggal Dibuat</h3>
                        <p class="text-gray-900">{{ $package->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($package->description)
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">{{ $package->description }}</p>
            </div>
            @endif

            <!-- Benefits -->
            @if($package->benefits && count($package->benefits) > 0)
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">✨ Benefit</h3>
                <ul class="space-y-3">
                    @foreach($package->benefits as $benefit)
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700 font-medium">{{ $benefit }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <a href="{{ route('admin.ticket-packages.edit', $package->id) }}" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] hover:from-[#BF820F] hover:to-[#F2BB16] text-white text-center rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                Edit Paket
            </a>
            <a href="{{ route('admin.ticket-packages.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition-colors">
                Kembali
            </a>
        </div>
    </div>
</section>
@endsection