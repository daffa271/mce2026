<x-guest-layout>
    <!-- Welcome Section -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-24 h-24 mb-4">
            <img src="{{ asset('images/logo/logomce26.png') }}" alt="MCE 2026 Logo" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-[#0E6973] mb-3">
            Selamat Datang Kembali!
        </h1>
        <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            Login ke akunmu dan lanjutkan perjalanan menuju kampus impian
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-[#118C8C] to-[#0E6973] px-6 md:px-8 py-6">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-1">Login ke Akun</h2>
            <p class="text-[#BAD9CE] text-sm">Masukkan email dan password untuk melanjutkan</p>
        </div>

        <!-- Form Content -->
        <div class="px-6 md:px-8 py-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Alamat Email')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <input id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200" 
                            placeholder="nama@gmail.com" 
                            required 
                            autofocus 
                            autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-[#0E6973] font-semibold mb-2" />
                    <div class="relative">
                        <input id="password" 
                            type="password" 
                            name="password"
                            class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C] transition-all duration-200"
                            placeholder="Masukkan password"
                            required 
                            autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-4 mt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <!-- Show Password Checkbox -->
                    <div class="flex items-center">
                        <input id="show-password-checkbox" 
                            type="checkbox" 
                            onclick="togglePasswordVisibility()"
                            class="shrink-0 border-gray-300 rounded text-[#118C8C] focus:ring-[#118C8C] focus:ring-2 transition-all duration-200">
                        <label for="show-password-checkbox" class="text-sm text-gray-600 ms-2 cursor-pointer select-none">Tampilkan password</label>
                    </div>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#118C8C] hover:text-[#0E6973] font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full justify-center px-8 py-3 bg-gradient-to-r from-[#118C8C] to-[#0E6973] hover:from-[#0E6973] hover:to-[#0E6973] focus:ring-4 focus:ring-[#BAD9CE] text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>{{ __('Masuk') }}</span>
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Belum punya akun?</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-[#118C8C] hover:text-[#0E6973] font-medium transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        {{ __('Daftar sebagai peserta baru') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Info -->
    <div class="mt-6 bg-[#BAD9CE] bg-opacity-20 border border-[#BAD9CE] rounded-lg p-4">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-[#118C8C]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-[#0E6973] font-medium mb-1">Keamanan Terjamin</p>
                <p class="text-xs text-gray-600">Koneksi aman dengan enkripsi SSL. Data login kamu dilindungi</p>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="text-center mt-6">
        <p class="text-sm text-gray-500">
            Butuh bantuan? Hubungi panitia di
            <span class="text-[#118C8C] font-medium">magetancampusexpo1@gmail.com</span>
        </p>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const checkbox = document.getElementById('show-password-checkbox');
            
            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</x-guest-layout>