@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-teal-600 mb-8">Daftar MCE 2026</h1>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <p class="font-semibold text-red-800 mb-2">Terjadi Kesalahan:</p>
            <ul class="text-red-800 list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('registrations.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-teal-600 @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}"
                    required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-teal-600 @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}"
                    required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="school" class="block text-sm font-medium text-gray-700 mb-2">Asal Sekolah</label>
                <input
                    type="text"
                    name="school"
                    id="school"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:border-teal-600 @error('school') border-red-500 @enderror"
                    value="{{ old('school') }}"
                    required>
                @error('school')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-semibold">Login di sini</a>
        </p>
    </div>
</section>
@endsection