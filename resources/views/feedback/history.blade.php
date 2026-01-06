@extends('layouts.app')

@section('title', 'Riwayat Feedback')

@section('content')
<section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">📋 Riwayat Feedback Saya</h1>
                <p class="text-gray-600">Lihat semua feedback yang telah Anda kirimkan</p>
            </div>
            <a href="{{ route('feedback.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                + Feedback Baru
            </a>
        </div>

        @php
        $feedbacks = Auth::user()->aspirations()->orderBy('created_at', 'desc')->get();
        @endphp

        @if($feedbacks->count() > 0)
        <div class="space-y-4">
            @foreach($feedbacks as $feedback)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden border-l-4 @if($feedback->status === 'approved') border-green-500 @elseif($feedback->status === 'pending') border-yellow-500 @else border-gray-300 @endif">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    @if($feedback->type === 'suggestion')
                                    💡
                                    @elseif($feedback->type === 'praise')
                                    👍
                                    @elseif($feedback->type === 'complaint')
                                    ⚠️
                                    @else
                                    💬
                                    @endif
                                    {{ ucfirst($feedback->category ?? 'Feedback') }}
                                </h3>
                                <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                            @if($feedback->status === 'approved') bg-green-100 text-green-800
                                            @elseif($feedback->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                    @if($feedback->status === 'approved')
                                    ✓ Disetujui
                                    @elseif($feedback->status === 'pending')
                                    ⏳ Tertunda
                                    @else
                                    Lainnya
                                    @endif
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $feedback->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($feedback->rating)
                        <div class="text-right">
                            <div class="text-2xl">
                                @for($i = 0; $i < $feedback->rating; $i++)⭐@endfor
                            </div>
                            <p class="text-xs text-gray-600">{{ $feedback->rating }}/5</p>
                        </div>
                        @endif
                    </div>

                    <!-- Message -->
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-gray-800">{{ $feedback->message }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between text-xs text-gray-600">
                        <div>
                            @if($feedback->allow_contact)
                            <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                📞 Boleh dihubungi
                            </span>
                            @endif
                        </div>
                        <p>Type: <span class="font-semibold">{{ ucfirst($feedback->type ?? '-') }}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="text-5xl mb-4">📭</div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Belum Ada Feedback</h3>
            <p class="text-gray-600 mb-6">Anda belum mengirim feedback apapun. Bagikan pendapat Anda untuk membantu kami!</p>
            <a href="{{ route('feedback.create') }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-8 rounded-lg transition">
                Kirim Feedback Pertama Anda
            </a>
        </div>
        @endif
    </div>
</section>
@endsection