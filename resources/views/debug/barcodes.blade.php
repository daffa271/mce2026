@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-teal-600 mb-6">🔍 Debug: Daftar Barcode di Database</h1>

    @if($registrations->count() > 0)
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">ID</th>
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">Sekolah</th>
                    <th class="px-4 py-3 text-left font-semibold">Barcode (Copy-paste di sini)</th>
                    <th class="px-4 py-3 text-left font-semibold">Verifikasi Status</th>
                    <th class="px-4 py-3 text-left font-semibold">Check-in Status</th>
                    <th class="px-4 py-3 text-left font-semibold">Waktu Check-in</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($registrations as $reg)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $reg->id }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $reg->name }}</td>
                    <td class="px-4 py-3">{{ $reg->school ?? '-' }}</td>
                    <td class="px-4 py-3 bg-yellow-50 font-mono text-sm">
                        <code class="select-all">{{ $reg->barcode }}</code>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $reg->verification_status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $reg->verification_status }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $reg->is_checked_in ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $reg->is_checked_in ? 'Sudah' : 'Belum' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $reg->checked_in_at ? $reg->checked_in_at->format('d M Y H:i') : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h2 class="font-semibold text-blue-900 mb-2">📋 Informasi:</h2>
        <ul class="text-blue-800 text-sm space-y-1">
            <li>✓ Total registrations dengan barcode: <strong>{{ \App\Models\Registration::whereNotNull('barcode')->count() }}</strong></li>
            <li>✓ Total yang sudah check-in: <strong>{{ \App\Models\Registration::where('is_checked_in', true)->count() }}</strong></li>
            <li>✓ Total yang terverifikasi: <strong>{{ \App\Models\Registration::where('verification_status', 'verified')->count() }}</strong></li>
            <li>⚠️ Jika barcode kosong = belum di-generate, silakan verify registrasi terlebih dahulu</li>
            <li>⚠️ Jika status bukan "verified" = tidak bisa check-in</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.checkin.index') }}" class="px-6 py-2 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700">
            ← Kembali ke Check-in
        </a>
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-600 text-lg">Tidak ada registrasi dengan barcode</p>
        <p class="text-gray-500 text-sm mt-2">Silakan verify registrasi terlebih dahulu untuk generate barcode</p>
    </div>
    @endif
</div>
@endsection