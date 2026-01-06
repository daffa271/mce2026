@extends('layouts.app')

@section('title', 'Buat Kode Diskon')

@section('content')
<section class="bg-gray-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('admin.discount-codes.index') }}" class="text-gray-500 hover:text-[#118C8C] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('admin.discount-codes.index') }}" class="text-gray-500 hover:text-[#118C8C]">Kode Diskon</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-600">Buat Baru</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">🏷️ Buat Kode Diskon Baru</h1>
            <p class="text-gray-600">Isi form di bawah untuk membuat kode diskon</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="{{ route('admin.discount-codes.store') }}" method="POST">
                @csrf

                <!-- Code -->
                <div class="mb-6">
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Diskon <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="code"
                        name="code"
                        value="{{ old('code') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] font-mono uppercase @error('code') border-red-500 @enderror"
                        placeholder="Contoh: EARLYBIRD2025"
                        required
                        oninput="this.value = this.value.toUpperCase()">
                    @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount Percentage -->
                <div class="mb-6">
                    <label for="discount_percentage" class="block text-sm font-semibold text-gray-700 mb-2">
                        Persentase Diskon (%) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number"
                            id="discount_percentage"
                            name="discount_percentage"
                            value="{{ old('discount_percentage') }}"
                            min="1"
                            max="100"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] @error('discount_percentage') border-red-500 @enderror"
                            placeholder="Contoh: 20"
                            required>
                    </div>
                    @error('discount_percentage')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] @error('description') border-red-500 @enderror"
                        placeholder="Contoh: Diskon khusus untuk early bird">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Valid From -->
                <div class="mb-6">
                    <label for="valid_from" class="block text-sm font-semibold text-gray-700 mb-2">
                        Berlaku Dari (Tanggal & Waktu) <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
                        id="valid_from"
                        name="valid_from"
                        value="{{ old('valid_from', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] @error('valid_from') border-red-500 @enderror"
                        required>
                    <p class="mt-1 text-xs text-gray-500">Pilih tanggal dan jam mulai diskon</p>
                    @error('valid_from')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Valid Until -->
                <div class="mb-6">
                    <label for="valid_until" class="block text-sm font-semibold text-gray-700 mb-2">
                        Berlaku Sampai (Tanggal & Waktu)
                    </label>
                    <input type="datetime-local"
                        id="valid_until"
                        name="valid_until"
                        value="{{ old('valid_until') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] @error('valid_until') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas akhir. Atau pilih tanggal dan jam berakhir diskon (bisa dalam hitungan jam/menit)</p>
                    @error('valid_until')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Usage Limit -->
                <div class="mb-6">
                    <label for="usage_limit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Batas Penggunaan
                    </label>
                    <input type="number"
                        id="usage_limit"
                        name="usage_limit"
                        value="{{ old('usage_limit') }}"
                        min="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] @error('usage_limit') border-red-500 @enderror"
                        placeholder="Contoh: 100">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas</p>
                    @error('usage_limit')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="mb-8">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-[#118C8C] border-gray-300 rounded focus:ring-[#118C8C]">
                        <span class="text-sm font-semibold text-gray-700">Aktifkan kode diskon ini</span>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-white text-black border-2 border-black font-semibold rounded-lg">
                        Buat Kode Diskon
                    </button>
                    <a href="{{ route('admin.discount-codes.index') }}"
                        class="px-6 py-3 bg-white text-black border-2 border-black font-semibold rounded-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection