@extends('layouts.app')

@section('content')
@php
$isBundle = $registration->ticketPackage?->is_bundle && !empty($registration->bundle_barcodes);
$bundleBarcodes = $registration->bundle_barcodes ?? [];
@endphp

<section class="max-w-4xl mx-auto px-6 py-12">
    @if($registration->verification_status === 'verified' && $registration->barcode)

    @if($isBundle)
    {{-- BUNDLE TICKETS VIEW --}}
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-teal-600 mb-2">🎫 Tiket Bundle MCE 2026</h1>
        <p class="text-gray-600">Paket {{ $registration->ticketPackage?->name }} - {{ count($bundleBarcodes) }} Peserta</p>
        <p class="text-sm text-gray-500 mt-2">Kode Registrasi: <span class="font-mono font-bold">{{ $registration->registration_code }}</span></p>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h3 class="font-semibold text-blue-900 mb-2">📋 Petunjuk Penggunaan Tiket Bundle:</h3>
        <ul class="text-blue-800 text-sm space-y-1 list-disc list-inside">
            <li>Setiap peserta memiliki tiket dengan QR code masing-masing</li>
            <li>Tunjukkan QR code yang sesuai dengan nama peserta saat check-in</li>
            <li>Setiap QR code hanya bisa digunakan sekali untuk masuk acara</li>
            <li>Simpan atau screenshot masing-masing tiket untuk kemudahan akses</li>
        </ul>
    </div>

    {{-- Individual Tickets --}}
    <div class="space-y-6">
        @foreach($bundleBarcodes as $index => $participant)
        <div class="bg-white shadow-xl rounded-2xl p-6 border-3 border-teal-600" id="ticket-{{ $index + 1 }}">
            {{-- Ticket Header --}}
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                <div>
                    <span class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-bold mb-2">
                        Peserta {{ $participant['number'] ?? ($index + 1) }} dari {{ count($bundleBarcodes) }}
                    </span>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $participant['name'] ?? 'Peserta ' . ($index + 1) }}</h2>
                    <p class="text-gray-600">{{ $participant['school'] ?? '-' }}</p>
                </div>
                <div class="text-right">
                    @if(!empty($participant['is_checked_in']))
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold text-sm">✓ Sudah Check-in</span>
                    <p class="text-xs text-gray-500 mt-1">{{ $participant['checked_in_at'] ?? '' }}</p>
                    @else
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold text-sm">✓ Aktif</span>
                    @endif
                </div>
            </div>

            {{-- Ticket Details --}}
            <div class="bg-gradient-to-r from-teal-50 to-blue-50 p-4 rounded-xl mb-4">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase">Paket Tiket</p>
                        <p class="font-bold text-gray-900">{{ $registration->ticketPackage?->name ?? 'Bundle' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase">Tanggal Verifikasi</p>
                        <p class="font-bold text-gray-900">{{ $registration->verified_at?->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- QR Code --}}
            <div class="bg-gray-100 p-6 rounded-xl text-center">
                <p class="text-sm font-semibold text-gray-600 mb-3">SCAN UNTUK MASUK ACARA</p>
                <div class="flex justify-center">
                    @if(!empty($participant['qr_code_path']) && Storage::disk('public')->exists($participant['qr_code_path']))
                    <img src="{{ Storage::url($participant['qr_code_path']) }}" alt="QR Code {{ $participant['name'] }}" class="w-48 h-48">
                    @else
                    <div class="w-48 h-48 bg-white flex items-center justify-center rounded-lg">
                        <p class="text-gray-500 text-sm">QR Code tidak tersedia</p>
                    </div>
                    @endif
                </div>
                <p class="mt-3 text-xs font-mono text-gray-700 font-bold bg-white inline-block px-4 py-2 rounded-lg">{{ $participant['barcode'] ?? '-' }}</p>
            </div>

            {{-- Download Button for each ticket --}}
            <div class="mt-4 text-center">
                <button data-index="{{ $index }}" onclick="downloadTicket(parseInt(this.dataset.index))" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition text-sm">
                    ⬇️ Unduh Tiket Ini
                </button>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row gap-3 mt-8">
        <button onclick="window.print()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
            🖨️ Cetak Semua Tiket
        </button>
        <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
            Kembali Dashboard
        </a>
    </div>

    @else
    {{-- SINGLE TICKET VIEW --}}
    <div class="bg-white shadow-xl rounded-2xl p-8 border-3 border-teal-600">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-teal-600 mb-2">🎫 Tiket MCE 2026</h1>
            <p class="text-gray-600">Magetan Campus Expo 2026</p>
        </div>

        <!-- Ticket Details -->
        <div class="bg-gradient-to-r from-teal-50 to-blue-50 p-6 rounded-xl mb-8">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Nama Peserta</p>
                    <p class="text-lg font-bold text-gray-900">{{ $registration->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Asal Sekolah</p>
                    <p class="text-lg font-bold text-gray-900">{{ $registration->school }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Paket Tiket</p>
                    <p class="text-lg font-bold text-gray-900">{{ $registration->ticketPackage?->name ?? 'Standard' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Kode Registrasi</p>
                    <p class="text-lg font-bold text-gray-900 font-mono">{{ $registration->registration_code }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Tanggal Verifikasi</p>
                    <p class="text-lg font-bold text-gray-900">{{ $registration->verified_at->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Status</p>
                    @if($registration->is_checked_in)
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold text-sm">✓ Check-in</span>
                    @else
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold text-sm">✓ Verified</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="bg-gray-100 p-8 rounded-xl text-center mb-8">
            <p class="text-sm font-semibold text-gray-600 mb-4">SCAN UNTUK MASUK ACARA</p>
            <div class="flex justify-center">
                @if($registration->qr_code_path && Storage::disk('public')->exists($registration->qr_code_path))
                <img src="{{ Storage::url($registration->qr_code_path) }}" alt="QR Code" class="w-64 h-64">
                @else
                <div class="w-64 h-64 bg-white flex items-center justify-center rounded-lg">
                    <p class="text-gray-500">QR Code tidak tersedia</p>
                </div>
                @endif
            </div>
            <p class="mt-4 text-sm font-mono text-gray-700 font-bold">{{ $registration->barcode }}</p>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
            <h3 class="font-semibold text-blue-900 mb-2">📋 Petunjuk Penggunaan:</h3>
            <ul class="text-blue-800 text-sm space-y-1 list-disc list-inside">
                <li>Tunjukkan layar HP ini atau cetak tiket saat memasuki acara</li>
                <li>Petugas akan melakukan scan QR Code untuk check-in</li>
                <li>Simpan tiket ini dengan baik hingga acara selesai</li>
                <li>Jika belum memiliki akses, hubungi panitia MCE 2026</li>
            </ul>
        </div>

        <!-- Check-in Info -->
        @if($registration->is_checked_in)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8">
            <h3 class="font-semibold text-green-900 mb-2">✓ Sudah Check-in</h3>
            <p class="text-green-800 text-sm">
                Waktu check-in: {{ $registration->checked_in_at->format('d M Y H:i') }}
            </p>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button onclick="window.print()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                🖨️ Cetak / Download PDF
            </button>
            <button id="downloadJpgBtn" type="button" class="flex-1 bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                ⬇️ Unduh QR (JPG)
            </button>
            <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-6 px-4 rounded-lg transition text-center">
                Kembali Dashboard
            </a>
        </div>
    </div>
    @endif

    @else
    <div class="bg-white shadow-lg rounded-2xl p-8">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
            <p class="text-2xl mb-2">⏳</p>
            <h2 class="font-bold text-yellow-900 text-lg mb-2">Tiket Belum Siap</h2>
            <p class="text-yellow-800 mb-4">
                Tiket Anda masih menunggu verifikasi dari admin.
            </p>
            <p class="text-yellow-700 text-sm mb-6">
                Status saat ini: <span class="font-semibold">{{ ucfirst($registration->verification_status ?? 'pending') }}</span>
            </p>
            <a href="{{ route('dashboard') }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
    @endif
</section>

<style>
    /* Mobile tweaks */
    @media (max-width: 640px) {
        section.max-w-4xl {
            padding: 1rem 1.25rem;
        }

        .bg-white.shadow-xl {
            padding: 1.25rem;
        }

        .grid.grid-cols-2 {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        img.w-64.h-64,
        img.w-48.h-48 {
            width: 12rem;
            height: 12rem;
        }
    }

    /* Print to PDF friendly */
    @media print {
        @page {
            size: A4 portrait;
            margin: 0.5in;
        }

        body {
            background: white;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Only print the ticket block */
        body * {
            visibility: hidden;
        }

        section.max-w-4xl,
        section.max-w-4xl * {
            visibility: visible;
        }

        /* Keep tickets together */
        .bg-white.shadow-xl.rounded-2xl {
            page-break-inside: avoid;
            box-shadow: none !important;
            border: 1px solid #e5e7eb;
            margin-bottom: 1rem;
        }

        /* Hide navigation/action buttons when printing */
        a[href*="dashboard"],
        button,
        .flex.gap-3,
        .flex.flex-col.sm\\:flex-row {
            display: none !important;
        }

        section.max-w-4xl {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
    }
</style>

<script>
    // Download single ticket QR (for non-bundle)
    document.getElementById('downloadJpgBtn')?.addEventListener('click', async () => {
        try {
            const imgEl = document.querySelector('img[alt="QR Code"]');
            if (!imgEl) return alert('QR Code tidak tersedia.');

            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.src = imgEl.src;
            await img.decode();

            const size = 512;
            const canvas = document.createElement('canvas');
            canvas.width = size;
            canvas.height = size;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, size, size);
            const scale = Math.min(size / img.width, size / img.height);
            const w = img.width * scale;
            const h = img.height * scale;
            const x = (size - w) / 2;
            const y = (size - h) / 2;
            ctx.drawImage(img, x, y, w, h);

            const data = canvas.toDataURL('image/jpeg', 0.95);
            const a = document.createElement('a');
            a.href = data;
            a.download = 'qr-{{ $registration->barcode }}.jpg';
            document.body.appendChild(a);
            a.click();
            a.remove();
        } catch (err) {
            console.error(err);
            alert('Gagal mengunduh QR sebagai JPG.');
        }
    });

    // Download bundle ticket QR
    async function downloadTicket(index) {
        try {
            const ticketDiv = document.getElementById('ticket-' + (index + 1));
            const imgEl = ticketDiv.querySelector('img[alt^="QR Code"]');
            if (!imgEl) return alert('QR Code tidak tersedia.');

            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.src = imgEl.src;
            await img.decode();

            const size = 512;
            const canvas = document.createElement('canvas');
            canvas.width = size;
            canvas.height = size;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, size, size);
            const scale = Math.min(size / img.width, size / img.height);
            const w = img.width * scale;
            const h = img.height * scale;
            const x = (size - w) / 2;
            const y = (size - h) / 2;
            ctx.drawImage(img, x, y, w, h);

            const barcodeEl = ticketDiv.querySelector('.font-mono.font-bold');
            const barcode = barcodeEl ? barcodeEl.textContent.trim() : 'ticket-' + (index + 1);

            const data = canvas.toDataURL('image/jpeg', 0.95);
            const a = document.createElement('a');
            a.href = data;
            a.download = 'qr-' + barcode + '.jpg';
            document.body.appendChild(a);
            a.click();
            a.remove();
        } catch (err) {
            console.error(err);
            alert('Gagal mengunduh QR sebagai JPG.');
        }
    }
</script>
@endsection