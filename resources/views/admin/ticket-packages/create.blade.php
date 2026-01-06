@extends('layouts.app')

@section('title', 'Tambah Paket Tiket Baru')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-block bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">TAMBAH PAKET BARU</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">🎫 Buat Paket Tiket</h1>
            <p class="text-gray-600">Isi form di bawah untuk menambahkan paket tiket baru.</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <form action="{{ route('admin.ticket-packages.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Paket *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('name') border-red-500 @enderror">
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('price') border-red-500 @enderror">
                    @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quota -->
                <div class="mb-6">
                    <label for="quota" class="block text-sm font-semibold text-gray-700 mb-2">Kuota *</label>
                    <input type="number" name="quota" id="quota" value="{{ old('quota') }}" required min="1"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('quota') border-red-500 @enderror">
                    @error('quota')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Benefits (Dynamic) -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Benefit Paket</label>
                    <p class="text-sm text-gray-500 mb-3">Tambahkan benefit yang didapat dari paket ini. Klik "Tambah Benefit" untuk menambah lebih banyak.</p>
                    <div id="benefits-container">
                        <div class="benefit-item flex gap-2 mb-2">
                            <input type="text" name="benefits[]" placeholder="Contoh: Akses semua sesi"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
                            <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
                                Hapus
                            </button>
                        </div>
                        <div class="benefit-item flex gap-2 mb-2">
                            <input type="text" name="benefits[]" placeholder="Contoh: Sertifikat gratis"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
                            <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
                                Hapus
                            </button>
                        </div>
                        <div class="benefit-item flex gap-2 mb-2">
                            <input type="text" name="benefits[]" placeholder="Contoh: Merchandise eksklusif"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
                            <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
                                Hapus
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="addBenefit()" style="background-color: #16a34a;" class="mt-3 px-6 py-2 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Benefit Lainnya
                    </button>
                </div>

                <!-- Valid Period -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="valid_from" class="block text-sm font-semibold text-gray-700 mb-2">Berlaku Dari</label>
                        <input type="date" name="valid_from" id="valid_from" value="{{ old('valid_from') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('valid_from') border-red-500 @enderror">
                        @error('valid_from')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="valid_until" class="block text-sm font-semibold text-gray-700 mb-2">Berlaku Hingga</label>
                        <input type="date" name="valid_until" id="valid_until" value="{{ old('valid_until') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('valid_until') border-red-500 @enderror">
                        @error('valid_until')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bundle Options -->
                <div class="mb-6 p-4 bg-purple-50 rounded-xl">
                    <div class="flex items-center mb-3">
                        <input type="checkbox" name="is_bundle" id="is_bundle" value="1" {{ old('is_bundle') ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" onchange="toggleBundleSize()">
                        <label for="is_bundle" class="ml-2 text-sm font-semibold text-gray-700">Paket Bundle (lebih dari 1 tiket)</label>
                    </div>
                    <div id="bundle-size-container" style="display: none;">
                        <label for="bundle_size" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Tiket dalam Bundle</label>
                        <input type="number" name="bundle_size" id="bundle_size" value="{{ old('bundle_size', 1) }}" min="1"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring focus:ring-purple-500/20 transition-colors">
                    </div>
                </div>

                <!-- Active Status -->
                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700">Aktifkan Paket Ini</label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] hover:from-[#BF820F] hover:to-[#F2BB16] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                        Simpan Paket Tiket
                    </button>
                    <a href="{{ route('admin.ticket-packages.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function addBenefit() {
        const container = document.getElementById('benefits-container');
        const newItem = document.createElement('div');
        newItem.className = 'benefit-item flex gap-2 mb-2';
        newItem.innerHTML = `
        <input type="text" name="benefits[]" placeholder="Contoh: Akses semua sesi"
            class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
        <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
            Hapus
        </button>
    `;
        container.appendChild(newItem);
    }

    function removeThis(btn) {
        btn.closest('.benefit-item').remove();
    }

    function toggleBundleSize() {
        const checkbox = document.getElementById('is_bundle');
        const container = document.getElementById('bundle-size-container');
        container.style.display = checkbox.checked ? 'block' : 'none';
    }

    // Initialize bundle size visibility
    document.addEventListener('DOMContentLoaded', function() {
        toggleBundleSize();
    });
</script>
@endsection