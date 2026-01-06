@extends('layouts.app')

@section('content')
<section class="relative py-24 bg-gradient-to-b from-emerald-50 to-white">
    <div class="max-w-5xl mx-auto px-6">

        <!-- Judul -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-emerald-700 mb-4">
                Hubungi Kami
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Punya pertanyaan atau ingin berkolaborasi dalam acara Magetan Campus Expo 2026?
                Kami dengan senang hati mendengarnya! Silakan hubungi kami melalui form di bawah ini.
            </p>
        </div>

        <!-- Grid Kontak -->
        <div class="grid md:grid-cols-2 gap-12">

            <!-- Form Kontak -->
            <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
                <h2 class="text-2xl font-semibold text-emerald-700 mb-6">Kirim Pesan</h2>
                <form action="#" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama kamu"
                            class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" placeholder="Alamat email aktif"
                            class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea name="message" rows="5" placeholder="Tulis pesan kamu di sini..."
                            class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Informasi Kontak -->
            <div class="flex flex-col justify-center">
                <div class="bg-gradient-to-br from-emerald-600 to-teal-600 text-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold mb-4">Informasi Kontak</h2>
                    <p class="text-emerald-100 mb-6 leading-relaxed">
                        Tim kami siap membantu Anda dengan segala pertanyaan terkait Magetan Campus Expo 2026.
                        Jangan ragu untuk menghubungi kami melalui kontak berikut.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100">Alamat</p>
                                <p class="font-medium">Gedung Serbaguna, Kab. Magetan</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100">Gmail</p>
                                <p class="font-medium">magetancampusexpo1@gmail.com</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.213l-2.12 1.06a11.042 11.042 0 005.516 5.516l1.06-2.12a1 1 0 011.213-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100">Telepon</p>
                                <p class="font-medium">+62 859 0430 0285</p>
                            </div>
                        </li>
                    </ul>

                    <!-- Sosial Media -->
                    <div class="mt-8">
                        <p class="text-sm text-emerald-100 mb-3">Ikuti kami di media sosial</p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/magetancampusexpo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#F2BB16]/30 rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 462.799" aria-hidden="true">
                                    <path fill-rule="nonzero" d="M403.229 0h78.506L310.219 196.04 512 462.799H354.002L230.261 301.007 88.669 462.799h-78.56l183.455-209.683L0 0h161.999l111.856 147.88L403.229 0zm-27.556 415.805h43.505L138.363 44.527h-46.68l283.99 371.278z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection