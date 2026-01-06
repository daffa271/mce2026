@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-teal-600 mb-2">📋 Check-in Peserta</h1>
        <p class="text-gray-600">Daftar peserta yang sudah check-in dan informasi scan QR Code</p>
    </div>

    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-6 flex-wrap" id="tab-navigation">
        <button onclick="showTab('list')" class="px-4 py-2 rounded-lg font-semibold text-sm sm:text-base transition-all tab-btn active" id="btn-list">
            📊 Daftar Check-in
        </button>
        <button onclick="showTab('scan')" class="px-4 py-2 rounded-lg font-semibold text-sm sm:text-base transition-all tab-btn" id="btn-scan">
            📱 Scan QR Code
        </button>
    </div>

    <!-- Tab: Daftar Check-in -->
    <div id="tab-list" class="tab-content bg-white shadow-lg rounded-2xl p-4 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Peserta yang Sudah Check-in</h2>

        @if($checkins->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm sm:text-base">
                <thead class="bg-gradient-to-r from-teal-50 to-teal-100">
                    <tr>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">No</th>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">Nama</th>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">Sekolah</th>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">Paket</th>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">Waktu Check-in</th>
                        <th class="px-3 sm:px-4 py-3 text-left font-semibold text-teal-900">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($checkins as $key => $checkin)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-3 sm:px-4 py-3 text-gray-700">{{ $checkins->firstItem() + $key }}</td>
                        <td class="px-3 sm:px-4 py-3 font-semibold text-gray-900">{{ $checkin->name }}</td>
                        <td class="px-3 sm:px-4 py-3 text-gray-700">{{ $checkin->school ?? '-' }}</td>
                        <td class="px-3 sm:px-4 py-3">
                            <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs sm:text-sm font-semibold">
                                {{ $checkin->ticketPackage?->name ?? 'Standard' }}
                            </span>
                        </td>
                        <td class="px-3 sm:px-4 py-3 text-gray-700 text-xs sm:text-sm">
                            {{ $checkin->checked_in_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-3 sm:px-4 py-3">
                            <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs sm:text-sm font-semibold">
                                ✓ Checked-in
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $checkins->links() }}
        </div>

        <!-- Summary Stats -->
        <div class="mt-8 p-4 sm:p-6 bg-teal-50 border border-teal-200 rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Total Check-in</p>
                    <p class="text-2xl sm:text-3xl font-bold text-teal-600">
                        {{ \App\Models\Registration::where('is_checked_in', true)->count() }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Check-in Hari Ini</p>
                    <p class="text-2xl sm:text-3xl font-bold text-teal-600">
                        {{ \App\Models\Registration::where('is_checked_in', true)->whereDate('checked_in_at', today())->count() }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Refresh Data</p>
                    <button onclick="location.reload()" class="mt-2 px-3 py-1 bg-teal-600 text-white rounded-lg text-sm font-semibold hover:bg-teal-700">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>
        @else
        <div class="py-12 text-center">
            <p class="text-gray-500 text-lg mb-4">Belum ada peserta yang check-in</p>
            <button onclick="showTab('scan')" class="px-6 py-2 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700">
                📱 Mulai Scan QR Code
            </button>
        </div>
        @endif
    </div>

    <!-- Tab: Scan QR Code -->
    <div id="tab-scan" class="tab-content bg-white shadow-lg rounded-2xl p-4 sm:p-8 hidden">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Scan QR Code Peserta</h2>

        <!-- Camera Controls -->
        <div class="mb-6 flex gap-3 flex-wrap">
            <button id="start-scan" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                📱 Mulai Kamera
            </button>
            <button id="stop-scan" class="px-4 py-2.5 bg-gray-400 text-white rounded-lg font-semibold hover:bg-gray-500 transition-colors hidden">
                ⏹ Hentikan Kamera
            </button>
        </div>

        <!-- QR Reader -->
        <div id="qr-reader" class="mb-6 w-full max-w-md mx-auto rounded-lg overflow-hidden border-2 border-teal-300"></div>
        <p class="text-xs sm:text-sm text-gray-500 text-center mb-6">💡 Tips: Arahkan QR Code ke kamera, pastikan pencahayaan cukup</p>

        <!-- Manual Input Fallback -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Atau Masukkan Barcode Secara Manual
            </label>
            <div class="flex gap-2 flex-wrap">
                <input
                    type="text"
                    id="barcode-input"
                    placeholder="Ketik barcode atau scan dengan scanner barcode..."
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-100 text-base">
                <button id="verify-btn" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors text-sm sm:text-base whitespace-nowrap">
                    ✓ Cek Kode Tiket
                </button>
            </div>
        </div>

        <!-- Result Alert -->
        <div id="result-container" class="mb-8"></div>

        <!-- Recent Check-ins -->
        <div class="mt-8 p-4 sm:p-6 bg-teal-50 border border-teal-200 rounded-lg">
            <h3 class="text-lg font-bold text-teal-900 mb-4">📊 Check-in Terakhir (Live)</h3>
            <div id="recent-checkins" class="space-y-2">
                <p class="text-gray-600 text-sm">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8"></script>

<script>
    // Tab switching
    function showTab(tab) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active', 'bg-teal-600', 'text-white'));

        // Show selected tab
        const tabEl = document.getElementById('tab-' + tab);
        const btnEl = document.getElementById('btn-' + tab);
        if (tabEl) tabEl.classList.remove('hidden');
        if (btnEl) {
            btnEl.classList.add('active', 'bg-teal-600', 'text-white');
        }
    }

    // Initialize tab buttons
    document.getElementById('btn-list').classList.add('bg-teal-600', 'text-white');

    // QR Scanner
    let html5QrCode = null;
    let scanning = false;

    const startBtn = document.getElementById('start-scan');
    const stopBtn = document.getElementById('stop-scan');

    startBtn.addEventListener('click', async () => {
        if (scanning) return;

        try {
            html5QrCode = html5QrCode || new Html5Qrcode('qr-reader');

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                aspectRatio: 1.0
            };
            await html5QrCode.start({
                    facingMode: 'environment'
                },
                config,
                (decodedText) => {
                    if (!decodedText || !scanning) return;
                    scanning = false;
                    submitScan(decodedText);
                    stopScanner();
                },
                () => {}
            );

            scanning = true;
            startBtn.classList.add('hidden');
            stopBtn.classList.remove('hidden');
        } catch (err) {
            displayResult({
                message: '❌ Tidak bisa mengakses kamera: ' + err.message
            }, false);
        }
    });

    async function stopScanner() {
        try {
            if (html5QrCode && scanning) {
                await html5QrCode.stop();
                await html5QrCode.clear();
            }
        } catch (_) {}
        scanning = false;
        startBtn.classList.remove('hidden');
        stopBtn.classList.add('hidden');
    }

    stopBtn.addEventListener('click', stopScanner);

    // Verify barcode button
    document.getElementById('verify-btn').addEventListener('click', function() {
        const barcode = document.getElementById('barcode-input').value.trim();
        if (barcode) {
            submitScan(barcode);
        } else {
            displayResult({
                message: '⚠️ Silakan masukkan barcode terlebih dahulu'
            }, false);
        }
    });

    // Manual input - submit on Enter key
    document.getElementById('barcode-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const barcode = this.value.trim();
            submitScan(barcode);
        }
    });

    // Submit scan / Verify barcode
    async function submitScan(barcode) {
        if (!barcode) return;

        try {
            // Show loading state
            const verifyBtn = document.getElementById('verify-btn');
            const originalText = verifyBtn.innerHTML;
            verifyBtn.innerHTML = '⏳ Memverifikasi...';
            verifyBtn.disabled = true;

            const response = await fetch('/admin/api/tickets/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    barcode
                })
            });

            let data;
            const contentType = response.headers.get('content-type') || '';
            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                throw new Error(`Respons bukan JSON (status ${response.status}): ${text.slice(0, 200)}`);
            }
            displayResult(data, response.ok);
            loadRecentCheckins();

            // Reset button
            verifyBtn.innerHTML = originalText;
            verifyBtn.disabled = false;

            // Clear input if success
            if (response.ok) {
                document.getElementById('barcode-input').value = '';
            }
        } catch (error) {
            displayResult({
                message: '❌ Terjadi kesalahan: ' + error.message
            }, false);
            const verifyBtn = document.getElementById('verify-btn');
            verifyBtn.innerHTML = '✓ Cek Kode Tiket';
            verifyBtn.disabled = false;
        }
    }

    // Display result
    function displayResult(data, success) {
        const container = document.getElementById('result-container');

        if (success) {
            container.innerHTML = `
            <div class="bg-green-50 border-l-4 border-green-600 rounded-lg p-4 sm:p-6 animate-bounce">
                <h3 class="font-bold text-green-900 text-lg mb-4">✓ CHECK-IN BERHASIL!</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-green-800 text-sm sm:text-base">
                    <div>
                        <p class="text-gray-600 text-xs">Nama Peserta</p>
                        <p class="font-semibold text-lg">${data.data.name}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs">Sekolah/Instansi</p>
                        <p class="font-semibold">${data.data.school || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs">Paket Tiket</p>
                        <p class="font-semibold">${data.data.ticket_package}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs">Waktu Check-in</p>
                        <p class="font-semibold">${data.data.checked_in_at}</p>
                    </div>
                </div>
            </div>
        `;
        } else {
            container.innerHTML = `
            <div class="bg-red-50 border-l-4 border-red-600 rounded-lg p-4 sm:p-6">
                <h3 class="font-bold text-red-900 text-lg mb-3">✗ CEK KODE TIKET GAGAL</h3>
                <p class="text-red-800 mb-3 text-sm sm:text-base font-semibold">${data.message}</p>
                ${data.data ? `
                    <div class="bg-red-100 rounded p-3 text-red-700 text-xs sm:text-sm">
                        <p><strong>Nama:</strong> ${data.data.name}</p>
                        <p><strong>Status:</strong> ${data.data.status}</p>
                        ${data.data.checked_in_at ? `<p><strong>Sudah Check-in:</strong> ${data.data.checked_in_at}</p>` : ''}
                    </div>
                ` : ''}
            </div>
        `;
        }

        // Auto hide after 6 seconds
        setTimeout(() => {
            container.innerHTML = '';
        }, 6000);
    }

    // Load recent check-ins
    async function loadRecentCheckins() {
        try {
            const response = await fetch('/admin/api/checkins/recent');
            const data = await response.json();

            const container = document.getElementById('recent-checkins');
            if (data.length === 0) {
                container.innerHTML = '<p class="text-gray-600 text-sm">Belum ada data check-in</p>';
                return;
            }

            container.innerHTML = data.slice(0, 5).map(item => `
                <div class="flex justify-between items-center bg-white p-3 rounded-lg border-l-4 border-teal-600">
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 truncate">${item.name}</p>
                        <p class="text-xs sm:text-sm text-gray-500">${item.school}</p>
                    </div>
                    <div class="text-right ml-2">
                        <p class="text-xs sm:text-sm font-semibold text-teal-600">${item.checked_in_at}</p>
                        <p class="text-xs text-gray-500">${item.ticket_package}</p>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            console.error('Error loading check-ins:', error);
        }
    }

    // Load on page load
    loadRecentCheckins();

    // Auto refresh recent check-ins every 30 seconds
    setInterval(loadRecentCheckins, 30000);
</script>

<style>
    .tab-btn.active {
        background-color: #118C8C;
        color: white;
    }

    .animate-bounce {
        animation: bounce 0.6s ease-out;
    }

    @keyframes bounce {
        0% {
            transform: scale(0.95) translateY(10px);
            opacity: 0;
        }

        100% {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }
</style>
@endsection