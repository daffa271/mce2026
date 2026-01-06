<x-guest-layout>
    <!-- Welcome Section -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-24 h-24 mb-4">
            <img src="{{ asset('images/logo/logomce26.png') }}" alt="MCE 2026 Logo" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-[#0E6973] mb-3">
            Selamat Datang di<br>Magetan Campus Expo 2026
        </h1>
        <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            Jelajahi dunia kampus impianmu! Daftar sekarang dan temukan peluang masa depan yang menanti.
        </p>
        <div class="flex items-center justify-center gap-2 mt-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#BAD9CE] text-[#0E6973] text-sm font-medium rounded-full">
                <svg class="w-4 h-4 text-[#F2BB16]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Terpercaya
            </span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-[#118C8C] to-[#0E6973] px-6 md:px-8 py-6">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-1">Daftar Akun Peserta</h2>
            <p class="text-[#BAD9CE] text-sm">Isi data diri dengan lengkap dan benar</p>
        </div>

        <!-- Form Content -->
        <div class="px-6 md:px-8 py-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="name" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200" type="text" name="name" :value="old('name')" placeholder="Contoh: Muhammad Daffa" required autofocus autocomplete="name" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Alamat Email')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="email" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200" type="email" name="email" :value="old('email')" placeholder="nama@gmail.com" required autocomplete="username" />
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">Email akan digunakan untuk login dan komunikasi event</p>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-6">
                    <x-input-label for="phone" :value="__('Nomor Telepon')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="phone" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200" type="tel" name="phone" :value="old('phone')" placeholder="Contoh: 08123456789" required autocomplete="tel" />
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">Nomor yang mudah dihubungi untuk keperluan event</p>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Asal Sekolah -->
                <div class="mb-6">
                    <x-input-label for="school" :value="__('Asal Sekolah')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="school" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200" type="text" name="school" :value="old('school')" placeholder="Contoh: SMA Negeri 1 Magetan" required autocomplete="organization" />
                    </div>
                    <x-input-error :messages="$errors->get('school')" class="mt-2" />
                </div>

                <!-- Kelas (Grade) -->
                <div class="mb-6">
                    <x-input-label for="grade" :value="__('Kelas')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <select id="grade" name="grade" class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200 appearance-none bg-white">
                            <option value="">Pilih Kelas Saat Ini</option>
                            <option value="10" {{ old('grade') === '10' ? 'selected' : '' }}>Kelas 10</option>
                            <option value="11" {{ old('grade') === '11' ? 'selected' : '' }}>Kelas 11</option>
                            <option value="12" {{ old('grade') === '12' ? 'selected' : '' }}>Kelas 12</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-medium">Keamanan Akun</span>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="password" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200"
                            type="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required autocomplete="new-password" />
                    </div>

                    <!-- Show Password Checkbox -->
                    <div class="flex items-center mt-2">
                        <input id="show-password-checkbox"
                            type="checkbox"
                            onclick="togglePassword('password')"
                            class="shrink-0 border-gray-300 rounded text-[#118C8C] focus:ring-[#118C8C] focus:ring-2 transition-all duration-200">
                        <label for="show-password-checkbox" class="text-sm text-gray-600 ms-2 cursor-pointer select-none">Tampilkan password</label>
                    </div>

                    <p class="mt-1.5 text-xs text-gray-500">Gunakan kombinasi huruf, angka, dan simbol</p>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ketik ulang password"
                            required autocomplete="new-password" />
                    </div>

                    <!-- Show Confirm Password Checkbox -->
                    <div class="flex items-center mt-2">
                        <input id="show-password_confirmation-checkbox"
                            type="checkbox"
                            onclick="togglePassword('password_confirmation')"
                            class="shrink-0 border-gray-300 rounded text-[#118C8C] focus:ring-[#118C8C] focus:ring-2 transition-all duration-200">
                        <label for="show-password_confirmation-checkbox" class="text-sm text-gray-600 ms-2 cursor-pointer select-none">Tampilkan password</label>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Privacy Info -->
                <div class="bg-[#BAD9CE] bg-opacity-30 border border-[#BAD9CE] rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#0E6973] font-medium mb-1">Data kamu aman bersama kami</p>
                            <p class="text-xs text-gray-600">Informasi pribadi dijaga kerahasiaannya dan hanya digunakan untuk keperluan event</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a class="text-sm text-[#118C8C] hover:text-[#0E6973] font-medium transition-colors duration-200 flex items-center gap-1.5" href="{{ route('login') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Sudah punya akun? Login') }}
                    </a>

                    <x-primary-button class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-[#118C8C] to-[#0E6973] hover:from-[#0E6973] hover:to-[#0E6973] focus:ring-4 focus:ring-[#BAD9CE] text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="flex items-center justify-center gap-2">
                            {{ __('Daftar Sekarang') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="text-center mt-8">
        <p class="text-sm text-gray-500">
            Butuh bantuan? Hubungi panitia di
            <span class="text-[#118C8C] font-medium">magetancampusexpo1@gmail.com</span>
        </p>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const checkbox = document.getElementById('show-' + fieldId + '-checkbox');

            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</x-guest-layout>