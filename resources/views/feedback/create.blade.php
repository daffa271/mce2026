@extends('layouts.app')

@section('title', 'Feedback Peserta')

@section('content')
<section class="min-h-screen bg-gray-50 pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-[#0E6973]">
                Feedback Peserta
            </h1>
            <p class="mt-2 text-gray-600">
                Sampaikan saran, kritik, dan apresiasi Anda untuk
                <span class="font-semibold text-[#118C8C]">
                    Magetan Campus Expo 2026
                </span>
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-6 shadow-lg animate-fade-in" x-data="{ show: true }" x-show="show" x-transition>
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-green-800 mb-1">
                        🎉 Feedback Berhasil Dikirim!
                    </h3>
                    <p class="text-green-700 leading-relaxed">
                        {{ session('success') }}
                    </p>
                </div>
                <button @click="show = false" class="flex-shrink-0 text-green-500 hover:text-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 animate-fade-in">

            <form method="POST" action="{{ route('feedback.store') }}">
                @csrf

                <!-- User Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Peserta
                        </label>
                        <input type="text" readonly
                            value="{{ auth()->user()->name }}"
                            class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-700 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="email" readonly
                            value="{{ auth()->user()->email }}"
                            class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-700 focus:ring-0">
                    </div>
                </div>

                <!-- Feedback Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Feedback <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <label class="flex items-center gap-2 p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all">
                            <input type="radio" name="type" value="suggestion" required {{ old('type') == 'suggestion' ? 'checked' : '' }} class="text-[#118C8C] focus:ring-[#118C8C]">
                            <span class="font-medium">Saran</span>
                        </label>
                        <label class="flex items-center gap-2 p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all">
                            <input type="radio" name="type" value="complaint" required {{ old('type') == 'complaint' ? 'checked' : '' }} class="text-[#118C8C] focus:ring-[#118C8C]">
                            <span class="font-medium">Kritik</span>
                        </label>
                        <label class="flex items-center gap-2 p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-[#118C8C] hover:bg-[#BAD9CE]/20 transition-all">
                            <input type="radio" name="type" value="praise" required {{ old('type') == 'praise' ? 'checked' : '' }} class="text-[#118C8C] focus:ring-[#118C8C]">
                            <span class="font-medium">Apresiasi</span>
                        </label>
                    </div>
                    @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div class="mb-6" x-data="{ rating: {{ old('rating', 0) }}, hover: 0 }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tingkat Kepuasan <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                            <input type="radio"
                                name="rating"
                                value="{{ $i }}"
                                required
                                x-model="rating"
                                class="hidden">
                            <svg class="w-12 h-12 transition-all duration-200"
                                :class="(hover >= {{ $i }} || rating >= {{ $i }}) ? 'text-[#F2BB16] scale-110' : 'text-gray-300'"
                                @mouseenter="hover = {{ $i }}"
                                @mouseleave="hover = 0"
                                @click="rating = {{ $i }}"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.381-2.454a1 1 0 00-1.175 0l-3.38 2.454c-.785.57-1.84-.196-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.098 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.235-3.967z" />
                            </svg>
                            </label>
                            @endfor
                    </div>
                    <p class="text-xs text-gray-500 mt-2" x-show="rating > 0" x-text="'Rating: ' + rating + ' dari 5 bintang'"></p>
                    @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pesan Feedback <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message"
                        rows="5"
                        required
                        maxlength="1000"
                        class="w-full rounded-xl border-gray-300 focus:border-[#118C8C] focus:ring-[#118C8C]"
                        placeholder="Tuliskan pengalaman, saran, atau masukan Anda...">{{ old('message') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        Maksimal 1000 karakter
                    </p>
                    @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Consent -->
                <div class="flex items-center gap-2 mb-8">
                    <input type="checkbox"
                        name="allow_contact"
                        value="1"
                        {{ old('allow_contact') ? 'checked' : '' }}
                        class="rounded text-[#118C8C] focus:ring-[#118C8C]">
                    <span class="text-sm text-gray-600">
                        Saya bersedia dihubungi untuk tindak lanjut feedback
                    </span>
                </div>

                <!-- Submit -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500 text-center sm:text-left">
                        Feedback Anda sangat berarti untuk peningkatan kualitas acara.
                    </p>
                    <button type="submit" style="background: linear-gradient(135deg, #118C8C 0%, #0E6973 100%);" class="px-10 py-4 rounded-xl text-white font-bold text-base shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 border-0 cursor-pointer">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kirim Feedback
                        </span>
                    </button>
                </div>
            </form>

            <!-- Footer Note -->
            <div class="mt-8 bg-[#BAD9CE]/30 rounded-xl p-4 text-center">
                <p class="text-sm text-gray-700">
                    Terima kasih telah berpartisipasi dalam
                    <span class="font-semibold text-[#0E6973]">
                        Magetan Campus Expo 2026
                    </span>.
                    Setiap masukan akan kami evaluasi secara profesional.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Animation -->
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.4s ease-out;
    }
</style>
@endsection