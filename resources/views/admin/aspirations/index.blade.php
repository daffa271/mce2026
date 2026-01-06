@extends('layouts.app')

@section('title', 'Kelola Feedback & Aspirasi')

@section('content')
<section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">📋 Kelola Feedback & Aspirasi</h1>
            <p class="text-gray-600">Lihat feedback dari peserta terdaftar dan pengunjung umum</p>
        </div>

        <!-- Tabs -->
        <div class="flex gap-4 mb-8 border-b border-gray-200">
            <button onclick="switchTab('user')" id="user-tab" class="px-6 py-3 font-semibold border-b-2 border-teal-600 text-teal-600">
                👤 Feedback Peserta ({{ $userFeedback->total() }})
            </button>
            <button onclick="switchTab('guest')" id="guest-tab" class="px-6 py-3 font-semibold text-gray-600 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300">
                👥 Feedback Umum ({{ $guestFeedback->total() }})
            </button>
        </div>

        <!-- User Feedback Tab -->
        <div id="user-content">
            @if($userFeedback->count() > 0)
            <div class="space-y-4">
                @foreach($userFeedback as $feedback)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-teal-500">
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-700 font-bold">
                                    {{ substr($feedback->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $feedback->user->name ?? 'Peserta' }}</h3>
                                    <p class="text-xs text-gray-600">{{ $feedback->user->email ?? '-' }} | {{ $feedback->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                    @if($feedback->status === 'approved') bg-green-100 text-green-800
                                    @elseif($feedback->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                            @if($feedback->status === 'approved') ✓ Disetujui
                            @elseif($feedback->status === 'pending') ⏳ Tertunda
                            @else Lainnya @endif
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <p class="text-gray-800 mb-3">{{ $feedback->message }}</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($feedback->category)
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded text-sm">📌 {{ ucfirst($feedback->category) }}</span>
                            @endif
                            @if($feedback->type)
                            <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded text-sm">
                                @if($feedback->type === 'suggestion') 💡 Saran
                                @elseif($feedback->type === 'praise') 👍 Pujian
                                @else ⚠️ Keluhan @endif
                            </span>
                            @endif
                            @if($feedback->rating)
                            <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded text-sm">⭐ {{ $feedback->rating }}/5</span>
                            @endif
                        </div>
                        @if($feedback->allow_contact)
                        <div class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded text-sm">
                            📞 Boleh dihubungi
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-4 border-t border-gray-200">
                        @if($feedback->status === 'pending')
                        <button class="text-sm px-4 py-2 bg-green-50 text-green-700 hover:bg-green-100 rounded transition">✓ Setujui</button>
                        <button class="text-sm px-4 py-2 bg-red-50 text-red-700 hover:bg-red-100 rounded transition">✗ Tolak</button>
                        @endif
                        <button class="ml-auto text-sm px-4 py-2 bg-gray-50 text-gray-700 hover:bg-gray-100 rounded transition">🗑️ Hapus</button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $userFeedback->links() }}
            </div>
            @else
            <div class="bg-white rounded-lg p-12 text-center">
                <div class="text-5xl mb-4">📭</div>
                <p class="text-gray-600">Belum ada feedback dari peserta</p>
            </div>
            @endif
        </div>

        <!-- Guest Feedback Tab -->
        <div id="guest-content" class="hidden">
            @if($guestFeedback->count() > 0)
            <div class="space-y-4">
                @foreach($guestFeedback as $feedback)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold">
                                    {{ substr($feedback->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $feedback->name }}</h3>
                                    <p class="text-xs text-gray-600">
                                        <a href="mailto:{{ $feedback->email }}" class="hover:underline">{{ $feedback->email }}</a>
                                        @if($feedback->phone) | {{ $feedback->phone }} @endif
                                        | {{ $feedback->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            @if($feedback->school)
                            <p class="text-xs text-gray-600 ml-12">🏫 {{ $feedback->school }}</p>
                            @endif
                        </div>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                    @if($feedback->status === 'approved') bg-green-100 text-green-800
                                    @elseif($feedback->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                            @if($feedback->status === 'approved') ✓ Disetujui
                            @elseif($feedback->status === 'pending') ⏳ Tertunda
                            @else Lainnya @endif
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <p class="text-gray-800 mb-3">{{ $feedback->message }}</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($feedback->category)
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded text-sm">📌 {{ ucfirst($feedback->category) }}</span>
                            @endif
                            @if($feedback->type)
                            <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded text-sm">
                                @if($feedback->type === 'suggestion') 💡 Saran
                                @elseif($feedback->type === 'praise') 👍 Pujian
                                @else ⚠️ Keluhan @endif
                            </span>
                            @endif
                            @if($feedback->rating)
                            <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded text-sm">⭐ {{ $feedback->rating }}/5</span>
                            @endif
                        </div>
                        @if($feedback->allow_contact)
                        <div class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded text-sm">
                            📞 Boleh dihubungi
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-4 border-t border-gray-200">
                        @if($feedback->status === 'pending')
                        <button class="text-sm px-4 py-2 bg-green-50 text-green-700 hover:bg-green-100 rounded transition">✓ Setujui</button>
                        <button class="text-sm px-4 py-2 bg-red-50 text-red-700 hover:bg-red-100 rounded transition">✗ Tolak</button>
                        @endif
                        <button class="ml-auto text-sm px-4 py-2 bg-gray-50 text-gray-700 hover:bg-gray-100 rounded transition">🗑️ Hapus</button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $guestFeedback->links() }}
            </div>
            @else
            <div class="bg-white rounded-lg p-12 text-center">
                <div class="text-5xl mb-4">📭</div>
                <p class="text-gray-600">Belum ada feedback dari pengunjung umum</p>
            </div>
            @endif
        </div>
    </div>
</section>

<script>
    function switchTab(tab) {
        // Hide all content
        document.getElementById('user-content').classList.add('hidden');
        document.getElementById('guest-content').classList.add('hidden');

        // Remove active tab styling
        document.getElementById('user-tab').classList.remove('border-teal-600', 'text-teal-600');
        document.getElementById('user-tab').classList.add('text-gray-600', 'border-transparent', 'hover:border-gray-300');

        document.getElementById('guest-tab').classList.remove('border-teal-600', 'text-teal-600');
        document.getElementById('guest-tab').classList.add('text-gray-600', 'border-transparent', 'hover:border-gray-300');

        // Show selected content
        document.getElementById(tab + '-content').classList.remove('hidden');
        document.getElementById(tab + '-tab').classList.remove('text-gray-600', 'border-transparent', 'hover:border-gray-300');
        document.getElementById(tab + '-tab').classList.add('border-teal-600', 'text-teal-600');
    }
</script>
@endsection