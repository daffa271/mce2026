@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-12">
    <div class="bg-white shadow-lg rounded-2xl p-4 sm:p-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-teal-600 mb-2">📱 Scan Tiket Peserta</h1>
        <p class="text-gray-600 mb-6 sm:mb-8">Scan QR Code untuk melakukan check-in peserta</p>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Camera Scanner -->
        <div class="mb-6">
            <div class="flex gap-3 flex-wrap mb-4">
                <button id="start-scan" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm sm:text-base">
                    📱 Mulai Kamera
                </button>
                <button id="stop-scan" class="px-4 py-2.5 bg-gray-400 text-white rounded-lg font-semibold hover:bg-gray-500 transition-colors text-sm sm:text-base hidden">
                    ⏹ Hentikan Kamera
                </button>
            </div>
            <div id="qr-reader" class="w-full max-w-md mx-auto rounded-lg overflow-hidden border-2 border-teal-300"></div>
            <p class="text-xs text-gray-500 mt-2 text-center">💡 Tips: Arahkan QR Code ke kamera, pastikan pencahayaan cukup</p>
        </div>

        <!-- Manual Input (fallback) -->
        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Atau Masukkan Barcode Secara Manual
            </label>
            <input
                type="text"
                id="barcode-input"
                placeholder="Ketik barcode atau scan dengan scanner barcode..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-100 text-base">
        </div>

        <!-- Result Area -->
        <div id="result-container" class="mb-8"></div>

        <!-- Recent Check-ins -->
        <div class="mt-10 sm:mt-12">
            <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">📋 Check-in Terakhir</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-xs sm:text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 sm:px-4 py-2 text-left font-semibold text-gray-700">Nama</th>
                            <th class="px-3 sm:px-4 py-2 text-left font-semibold text-gray-700">Sekolah</th>
                            <th class="px-3 sm:px-4 py-2 text-left font-semibold text-gray-700">Waktu</th>
                            <th class="px-3 sm:px-4 py-2 text-left font-semibold text-gray-700">Paket</th>
                            <th class="px-3 sm:px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody id="checkin-list" class="divide-y">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- QR scanning library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8"></script>

<script>
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

    // Manual input handler
    document.getElementById('barcode-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const barcode = this.value.trim();
            submitScan(barcode);
            this.value = '';
        }
    });

    // Submit scan
    async function submitScan(barcode) {
        if (!barcode) return;

        try {
            const response = await fetch('/api/tickets/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    barcode
                })
            });

            const data = await response.json();
            displayResult(data, response.ok);
            loadCheckInList();
        } catch (error) {
            displayResult({
                message: '❌ Terjadi kesalahan: ' + error.message
            }, false);
        }
    }

    function displayResult(data, success) {
        const container = document.getElementById('result-container');

        if (success) {
            container.innerHTML = `
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 sm:p-6 animate-bounce">
                <h3 class="font-bold text-green-900 text-lg mb-3">✓ Check-in Berhasil!</h3>
                <div class="space-y-2 text-green-800 text-sm sm:text-base">
                    <p><strong>Nama:</strong> ${data.data.name}</p>
                    <p><strong>Sekolah:</strong> ${data.data.school || '-'}</p>
                    <p><strong>Paket:</strong> ${data.data.ticket_package}</p>
                    <p><strong>Waktu:</strong> ${data.data.checked_in_at}</p>
                </div>
            </div>
        `;
        } else {
            container.innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 sm:p-6">
                <h3 class="font-bold text-red-900 text-lg mb-2">✗ Check-in Gagal</h3>
                <p class="text-red-800 mb-2 text-sm sm:text-base">${data.message}</p>
                ${data.data ? `
                    <div class="space-y-1 text-red-700 text-xs sm:text-sm">
                        <p><strong>Nama:</strong> ${data.data.name}</p>
                        <p><strong>Status:</strong> ${data.data.status}</p>
                    </div>
                ` : ''}
            </div>
        `;
        }

        // Auto hide after 5 seconds
        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }

    async function loadCheckInList() {
        try {
            const response = await fetch('/api/checkins/recent');
            const data = await response.json();

            const tbody = document.getElementById('checkin-list');
            tbody.innerHTML = data.map(item => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-3 sm:px-4 py-3">${item.name}</td>
                <td class="px-3 sm:px-4 py-3">${item.school || '-'}</td>
                <td class="px-3 sm:px-4 py-3 text-xs sm:text-sm">${item.checked_in_at}</td>
                <td class="px-3 sm:px-4 py-3">${item.ticket_package}</td>
                <td class="px-3 sm:px-4 py-3">
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded text-xs sm:text-sm font-semibold">
                        ✓ Checked-in
                    </span>
                </td>
            </tr>
        `).join('');
        } catch (error) {
            console.error('Error loading check-in list:', error);
        }
    }

    // Load on page load
    loadCheckInList();

    // Auto refresh every 30 seconds
    setInterval(loadCheckInList, 30000);
</script>

<style>
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