@extends('layouts.app')

@section('title', 'Kirim Aspirasi & Saran - Magetan Campus Expo 2026')

@section('content')

<!-- Hero Section with Privacy Emphasis -->
<section class="relative py-16 md:py-24 lg:py-32 bg-gradient-to-br from-[#BAD9CE]/30 via-white to-[#BAD9CE]/20 overflow-hidden">
    <!-- Decorative Background -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-64 md:w-96 h-64 md:h-96 bg-[#118C8C] rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-72 md:w-[32rem] h-72 md:h-[32rem] bg-[#0E6973] rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Privacy Badge -->
        <div class="inline-flex items-center gap-2 md:gap-3 bg-white/90 backdrop-blur-md border border-[#BAD9CE] rounded-full px-4 md:px-8 py-2.5 md:py-3 mb-6 md:mb-8 shadow-lg hover:shadow-xl transition-shadow">
            <svg class="w-4 md:w-5 h-4 md:h-5 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span class="font-semibold text-[#0E6973] text-sm md:text-base">100% Anonim & Privasi Terjaga</span>
        </div>

        <!-- Main Title -->
        <h1 class="text-3xl md:text-4xl lg:text-6xl font-bold text-gray-900 mb-4 md:mb-6 leading-tight px-4">
            Suara Anda,
            <span class="bg-gradient-to-r from-[#118C8C] to-[#0E6973] bg-clip-text text-transparent">
                Masa Depan MCE
            </span>
        </h1>

        <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
            Bantu kami menciptakan Magetan Campus Expo 2026 yang lebih baik dengan kritik, saran, dan ide cemerlang Anda
        </p>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-12 md:py-16 lg:py-20 -mt-8 md:-mt-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Trust Indicator Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 mb-12 md:mb-16">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl md:rounded-3xl p-6 md:p-8 shadow-lg border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 md:w-16 h-14 md:h-16 bg-[#BAD9CE]/30 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-5">
                    <svg class="w-7 md:w-8 h-7 md:h-8 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2 text-base md:text-lg">Anonim Total</h3>
                <p class="text-sm md:text-base text-gray-600 leading-relaxed">Identitas Anda tidak akan tercatat atau tersimpan</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl md:rounded-3xl p-6 md:p-8 shadow-lg border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 md:w-16 h-14 md:h-16 bg-[#BAD9CE]/30 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-5">
                    <svg class="w-7 md:w-8 h-7 md:h-8 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2 text-base md:text-lg">Data Terlindungi</h3>
                <p class="text-sm md:text-base text-gray-600 leading-relaxed">Aspirasi Anda tersimpan dengan enkripsi tingkat tinggi</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl md:rounded-3xl p-6 md:p-8 shadow-lg border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 md:w-16 h-14 md:h-16 bg-[#F2BB16]/20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-5">
                    <svg class="w-7 md:w-8 h-7 md:h-8 text-[#F2BB16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2 text-base md:text-lg">Respon Cepat</h3>
                <p class="text-sm md:text-base text-gray-600 leading-relaxed">Tim panitia akan menindaklanjuti setiap masukan</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl md:shadow-2xl overflow-hidden border border-gray-100">

            <!-- Form Header -->
            <div class="bg-gradient-to-r from-[#118C8C] to-[#0E6973] px-6 md:px-10 py-8 md:py-12 text-white">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">
                    <div class="w-14 md:w-16 h-14 md:h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 md:w-8 h-7 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2 md:mb-3">Formulir Aspirasi & Masukan</h2>
                        <p class="text-sm md:text-base text-[#BAD9CE]">
                            Sampaikan pendapat jujur Anda untuk membantu kami mewujudkan MCE 2026 yang lebih berkualitas
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <div class="px-6 md:px-10 pt-6 md:pt-8">
                @if(session('success'))
                <div class="bg-[#BAD9CE]/20 border-l-4 border-[#118C8C] rounded-xl p-4 md:p-5 mb-6 md:mb-8 flex items-start gap-3 md:gap-4 animate-pulse">
                    <svg class="w-6 h-6 text-[#118C8C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-bold text-[#0E6973] text-base md:text-lg mb-1">Terima Kasih!</p>
                        <p class="text-[#0E6973] text-sm md:text-base">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-4 md:p-5 mb-6 md:mb-8">
                    <div class="flex items-start gap-3 md:gap-4">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex-1">
                            <p class="font-bold text-red-900 mb-2 text-base md:text-lg">Terdapat Kesalahan:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm md:text-base text-red-700">
                                @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Form Body -->
            <form action="{{ route('feedback.store-guest') }}" method="POST" class="px-6 md:px-10 pb-8 md:pb-12 space-y-6 md:space-y-8">
                @csrf

                <!-- Category Selection -->
                <div class="form-group">
                    <label for="category" class="block text-gray-900 font-bold mb-3 flex items-center gap-2 text-base md:text-lg">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Kategori Masukan
                        <span class="text-sm font-normal text-gray-500">(Opsional)</span>
                    </label>
                    <select name="category" id="category" class="w-full border-2 border-gray-300 rounded-xl md:rounded-2xl px-4 md:px-5 py-3 md:py-4 focus:border-[#118C8C] focus:ring-4 focus:ring-[#BAD9CE]/30 transition-all outline-none text-gray-900 bg-white text-base md:text-lg hover:border-[#118C8C] cursor-pointer">
                        <option value="">📋 Pilih Kategori (Opsional)</option>
                        <option value="Acara">🎪 Konsep & Pelaksanaan Acara</option>
                        <option value="Publikasi">📢 Publikasi & Promosi</option>
                        <option value="Konsumsi">🍱 Konsumsi & Fasilitas</option>
                        <option value="Dokumentasi">📸 Dokumentasi & Media</option>
                        <option value="Sponsorship">🤝 Sponsorship & Partnership</option>
                        <option value="Teknis">⚙️ Teknis & Operasional</option>
                        <option value="Lainnya">✨ Lainnya</option>
                    </select>
                </div>

                <!-- Message Input -->
                <div class="form-group">
                    <label for="message" class="block text-gray-900 font-bold mb-3 flex items-center gap-2 text-base md:text-lg">
                        <svg class="w-5 h-5 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Aspirasi, Kritik, atau Saran Anda
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="message"
                        id="message"
                        rows="6"
                        class="w-full border-2 border-gray-300 rounded-xl md:rounded-2xl px-4 md:px-5 py-3 md:py-4 focus:border-[#118C8C] focus:ring-4 focus:ring-[#BAD9CE]/30 transition-all outline-none resize-none text-base md:text-lg hover:border-[#118C8C]"
                        placeholder="Contoh:
• Saya menyarankan untuk menambah booth interaktif agar lebih menarik...
• Publikasi event perlu diperluas ke media sosial seperti TikTok dan Instagram...
• Fasilitas parkir perlu ditambah untuk mengantisipasi banyaknya pengunjung..."
                        required>{{ old('message') }}</textarea>
                    <div class="flex items-start gap-2 mt-3 text-sm md:text-base text-gray-500">
                        <svg class="w-4 h-4 md:w-5 md:h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Minimal 10 karakter. Tulis sejujur-jujurnya, identitas Anda tetap anonim.</span>
                    </div>
                </div>

                <!-- Privacy Reminder -->
                <div class="bg-gradient-to-r from-[#BAD9CE]/20 to-[#BAD9CE]/10 border border-[#BAD9CE] rounded-xl md:rounded-2xl p-5 md:p-8">
                    <div class="flex flex-col md:flex-row gap-4 md:gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 md:w-14 h-12 md:h-14 bg-[#118C8C]/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 md:w-7 h-6 md:h-7 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#0E6973] mb-3 text-base md:text-lg">Jaminan Privasi & Keamanan</h4>
                            <ul class="space-y-2 md:space-y-2.5 text-sm md:text-base text-gray-700">
                                <li class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mt-0.5 flex-shrink-0 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Tidak ada sistem login atau tracking IP</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mt-0.5 flex-shrink-0 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Data hanya ketua pelaksana yang akses</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mt-0.5 flex-shrink-0 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Enkripsi end-to-end untuk keamanan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4 md:pt-6">
                    <button
                        type="submit"
                        class="group flex-1 bg-gradient-to-r from-[#F2BB16] to-[#BF820F] text-white font-bold px-6 md:px-10 py-4 md:py-5 rounded-xl md:rounded-2xl hover:shadow-2xl hover:shadow-[#F2BB16]/30 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 text-base md:text-lg">
                        <svg class="w-5 md:w-6 h-5 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Kirim Aspirasi</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>

                    <button
                        type="reset"
                        class="px-6 md:px-10 py-4 md:py-5 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl md:rounded-2xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 text-base md:text-lg">
                        Reset Form
                    </button>
                </div>
            </form>
        </div>

        <!-- FAQ Section -->
        <div class="mt-12 md:mt-20 bg-white rounded-2xl md:rounded-3xl shadow-xl p-6 md:p-10 border border-gray-100">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 md:mb-8 flex items-center gap-3">
                <svg class="w-7 md:w-8 h-7 md:h-8 text-[#118C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pertanyaan yang Sering Diajukan
            </h3>

            <div class="space-y-4">
                <details class="group bg-gray-50 rounded-xl md:rounded-2xl p-5 md:p-6 hover:bg-[#BAD9CE]/10 transition-all cursor-pointer">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center text-base md:text-lg">
                        <span>Apakah aspirasi saya benar-benar anonim?</span>
                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="mt-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        Ya, 100% anonim! Sistem kami tidak menyimpan nama, email, IP address, atau informasi identitas apapun. Kami berkomitmen untuk menjaga privasi Anda sepenuhnya.
                    </p>
                </details>

                <details class="group bg-gray-50 rounded-xl md:rounded-2xl p-5 md:p-6 hover:bg-[#BAD9CE]/10 transition-all cursor-pointer">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center text-base md:text-lg">
                        <span>Siapa yang membaca aspirasi saya?</span>
                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="mt-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        Hanya ketua pelaksana MCE 2026 yang memiliki akses ke aspirasi Anda dan akan membahasnya dalam rapat evaluasi tim untuk perbaikan event.
                    </p>
                </details>

                <details class="group bg-gray-50 rounded-xl md:rounded-2xl p-5 md:p-6 hover:bg-[#BAD9CE]/10 transition-all cursor-pointer">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center text-base md:text-lg">
                        <span>Boleh memberikan kritik keras?</span>
                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="mt-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        Tentu saja! Kami sangat menghargai kritik konstruktif yang membangun untuk perbaikan event. Jangan ragu untuk menyampaikan pendapat jujur Anda.
                    </p>
                </details>

                <details class="group bg-gray-50 rounded-xl md:rounded-2xl p-5 md:p-6 hover:bg-[#BAD9CE]/10 transition-all cursor-pointer">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center text-base md:text-lg">
                        <span>Akan ditindaklanjuti?</span>
                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <p class="mt-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        Setiap aspirasi akan dibaca, dikategorikan, dan dibahas dalam rapat tim untuk perbaikan dan pengembangan MCE 2026 yang lebih baik.
                    </p>
                </details>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="mt-12 md:mt-16 grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6">
            <div class="bg-gradient-to-br from-[#118C8C] to-[#0E6973] rounded-2xl md:rounded-3xl p-6 md:p-10 text-white text-center shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div class="text-4xl md:text-6xl font-bold mb-2 md:mb-3">500+</div>
                <div class="text-sm md:text-lg text-[#BAD9CE] font-medium">Aspirasi Diterima</div>
            </div>
            <div class="bg-gradient-to-br from-[#0E6973] to-[#118C8C] rounded-2xl md:rounded-3xl p-6 md:p-10 text-white text-center shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div class="text-4xl md:text-6xl font-bold mb-2 md:mb-3">100%</div>
                <div class="text-sm md:text-lg text-[#BAD9CE] font-medium">Privasi Terjaga</div>
            </div>
            <div class="bg-gradient-to-br from-[#F2BB16] to-[#BF820F] rounded-2xl md:rounded-3xl p-6 md:p-10 text-white text-center shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <div class="text-4xl md:text-6xl font-bold mb-2 md:mb-3">24/7</div>
                <div class="text-sm md:text-lg text-white/90 font-medium">Selalu Terbuka</div>
            </div>
        </div>

        <!-- Call to Action Bottom -->
        <div class="mt-12 md:mt-16 bg-gradient-to-r from-[#118C8C] to-[#0E6973] rounded-2xl md:rounded-3xl p-8 md:p-12 text-center text-white shadow-2xl">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl md:text-4xl font-bold mb-3 md:mb-5 leading-tight">Bersama Wujudkan MCE 2026 Lebih Baik!</h3>
                <p class="text-base md:text-xl text-[#BAD9CE] leading-relaxed">
                    Setiap suara Anda berharga. Mari ciptakan event berkualitas yang menginspirasi generasi muda Magetan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Additional CSS for Smooth Animations -->
<style>
    /* Form Group Animation */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group {
        animation: slideUp 0.6s ease-out backwards;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(4) {
        animation-delay: 0.3s;
    }

    .form-group:nth-child(5) {
        animation-delay: 0.4s;
    }

    /* Smooth Textarea Resize */
    textarea {
        transition: border-color 0.3s, box-shadow 0.3s, transform 0.2s;
    }

    textarea:focus {
        transform: scale(1.01);
    }

    /* Select Dropdown Enhancement */
    select {
        transition: border-color 0.3s, box-shadow 0.3s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23118C8C'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.5em 1.5em;
        padding-right: 3rem;
    }

    /* Details Element Smooth Animation */
    details[open]>summary {
        margin-bottom: 1rem;
    }

    details summary::-webkit-details-marker {
        display: none;
    }

    /* Button Hover Effects */
    button {
        position: relative;
        overflow: hidden;
    }

    button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    button:hover::before {
        width: 300px;
        height: 300px;
    }

    /* Responsive padding adjustments */
    @media (max-width: 640px) {
        select {
            background-size: 1.25em 1.25em;
            padding-right: 2.5rem;
        }
    }

    /* Focus visible for accessibility */
    *:focus-visible {
        outline: 2px solid #118C8C;
        outline-offset: 2px;
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>

@endsection