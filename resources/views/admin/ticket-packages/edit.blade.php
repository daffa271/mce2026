@extends('layouts.app')

@section('title', 'Edit Paket Tiket')

@section('content')
<section class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-block bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white px-6 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">EDIT PAKET</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">✏️ Edit Paket Tiket</h1>
            <p class="text-gray-600">Perbarui informasi paket tiket: {{ $package->name }}</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <form action="{{ route('admin.ticket-packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Paket *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('name') border-red-500 @enderror">
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $package->price) }}" required min="0" step="0.01"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('price') border-red-500 @enderror">
                    @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quota -->
                <div class="mb-6">
                    <label for="quota" class="block text-sm font-semibold text-gray-700 mb-2">Kuota *</label>
                    <input type="number" name="quota" id="quota" value="{{ old('quota', $package->quota) }}" required min="{{ $package->sold }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('quota') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Minimal {{ $package->sold }} (sudah terjual)</p>
                    @error('quota')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('description') border-red-500 @enderror">{{ old('description', $package->description) }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Benefits (Dynamic) -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Benefit</label>
                    <div id="benefits-container">
                        @if($package->benefits && count($package->benefits) > 0)
                        @foreach($package->benefits as $benefit)
                        <div class="benefit-item flex gap-2 mb-2">
                            <input type="text" name="benefits[]" value="{{ $benefit }}" placeholder="Contoh: Akses semua sesi"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
                            <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
                                Hapus
                            </button>
                        </div>
                        @endforeach
                        @else
                        <div class="benefit-item flex gap-2 mb-2">
                            <input type="text" name="benefits[]" placeholder="Contoh: Akses semua sesi"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors">
                            <button type="button" onclick="removeThis(this)" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">
                                Hapus
                            </button>
                        </div>
                        @endif
                    </div>
                    <button type="button" onclick="addBenefit()" class="mt-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl font-semibold">
                        + Tambah Benefit
                    </button>
                </div>

                <!-- Valid Period -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="valid_from" class="block text-sm font-semibold text-gray-700 mb-2">Berlaku Dari</label>
                        <input type="date" name="valid_from" id="valid_from" value="{{ old('valid_from', $package->valid_from?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('valid_from') border-red-500 @enderror">
                        @error('valid_from')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="valid_until" class="block text-sm font-semibold text-gray-700 mb-2">Berlaku Hingga</label>
                        <input type="date" name="valid_until" id="valid_until" value="{{ old('valid_until', $package->valid_until?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#F2BB16] focus:ring focus:ring-[#F2BB16]/20 transition-colors @error('valid_until') border-red-500 @enderror">
                        @error('valid_until')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bundle Options -->
                <div class="mb-6 p-4 bg-purple-50 rounded-xl">
                    <div class="flex items-center mb-3">
                        <input type="checkbox" name="is_bundle" id="is_bundle" value="1" {{ old('is_bundle', $package->is_bundle) ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" onchange="toggleBundleSize()">
                        <label for="is_bundle" class="ml-2 text-sm font-semibold text-gray-700">Paket Bundle (lebih dari 1 tiket)</label>
                    </div>
                    <div id="bundle-size-container" class="{{ $package->is_bundle ? '' : 'hidden' }}">
                        <label for="bundle_size" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Tiket dalam Bundle</label>
                        <input type="number" name="bundle_size" id="bundle_size" value="{{ old('bundle_size', $package->bundle_size ?? 1) }}" min="1"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring focus:ring-purple-500/20 transition-colors">
                    </div>
                </div>

                <!-- Active Status -->
                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700">Aktifkan Paket Ini</label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] hover:from-[#BF820F] hover:to-[#F2BB16] text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                        Perbarui Paket Tiket
                    </button>
                    <a href="{{ route('admin.ticket-packages.show', $package->id) }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition-colors">
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
        if (checkbox.checked) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection