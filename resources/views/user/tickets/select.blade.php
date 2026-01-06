@extends('layouts.app')

@section('title', 'Pilih Paket Tiket')

@section('content')
<section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">🎫 Pilih Paket Tiket MCE 2026</h1>
            <p class="text-gray-600 max-w-2xl">Pilih paket tiket yang sesuai dengan kebutuhan Anda. Setiap paket dilengkapi dengan berbagai keuntungan eksklusif.</p>
        </div>

        <!-- Ticket Packages Grid -->
        @php
        $packages = \App\Models\TicketPackage::where('is_active', true)->get();
        @endphp

        @if($packages->count() > 0)
        <div class="grid md:grid-cols-{{ $packages->count() <= 2 ? 2 : 3 }} gap-8 mb-12">
            @foreach($packages as $package)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden flex flex-col">
                <!-- Header -->
                <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">{{ $package->name }}</h3>
                    <div class="text-4xl font-bold">
                        Rp{{ number_format($package->price, 0, ',', '.') }}
                    </div>
                    <p class="text-teal-100 text-sm mt-1">per tiket</p>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 text-sm">{{ $package->description }}</p>

                    <!-- Benefits -->
                    <div class="mb-8 flex-1">
                        <h4 class="font-semibold text-gray-900 mb-3">Benefit Paket:</h4>
                        <ul class="space-y-2">
                            @if($package->benefits && is_array($package->benefits))
                            @foreach($package->benefits as $benefit)
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <span class="text-teal-600 font-bold mt-0.5">✓</span>
                                <span>{{ $benefit }}</span>
                            </li>
                            @endforeach
                            @else
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Akses ke semua acara MCE 2026</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Merchandise eksklusif</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <span class="text-teal-600 font-bold">✓</span>
                                <span>Goodie bag premium</span>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Quota Info -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6 text-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700">Sisa Kuota:</span>
                            <span class="font-bold text-lg">{{ $package->quota - $package->sold }}/{{ $package->quota }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            @php
                            $percentage = number_format((($package->quota - $package->sold) / $package->quota) * 100, 0);
                            @endphp
                            <div class="bg-teal-600 h-2 rounded-full" @style("width: {$percentage}%")></div>
                        </div>
                    </div>

                    <!-- Valid Dates -->
                    <div class="text-xs text-gray-500 mb-6 space-y-1">
                        <p>
                            <strong>Berlaku dari:</strong>
                            {{ \Carbon\Carbon::parse($package->valid_from)->format('d M Y') }}
                            hingga
                            {{ \Carbon\Carbon::parse($package->valid_until)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- Buy Button -->
                    @if($package->quota > $package->sold)
                    <form action="{{ route('user.tickets.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ticket_package_id" value="{{ $package->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                            Beli Sekarang
                        </button>
                    </form>
                    @else
                    <button disabled class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-lg cursor-not-allowed">
                        Kuota Habis
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Info Section -->
        <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-teal-600">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📌 Informasi Pembelian</h3>
            <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-700">
                <div>
                    <h4 class="font-semibold text-gray-900 mb-2">Proses Pembelian:</h4>
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Pilih paket tiket yang sesuai</li>
                        <li>Sistem akan membuat registrasi Anda</li>
                        <li>Lakukan pembayaran sesuai instruksi</li>
                        <li>Admin akan verifikasi pembayaran Anda</li>
                        <li>Tiket dan QR code akan langsung tersedia</li>
                    </ol>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-2">Metode Pembayaran:</h4>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Transfer Bank (BCA, Mandiri, BRI)</li>
                        <li>E-wallet (GCash, Dana)</li>
                        <li>QRIS untuk semua bank</li>
                        <li>Pembayaran manual di tempat (TBA)</li>
                    </ul>
                </div>
            </div>
        </div>
        @else
        <!-- No Packages Available -->
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="text-5xl mb-4">📭</div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Paket Tiket Belum Tersedia</h3>
            <p class="text-gray-600 mb-6">Paket tiket MCE 2026 akan segera dibuka. Silakan cek kembali lagi.</p>
            <a href="{{ route('user.tickets.index') }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-8 rounded-lg transition">
                Kembali ke Tiket Saya
            </a>
        </div>
        @endif
    </div>
</section>
@endsection