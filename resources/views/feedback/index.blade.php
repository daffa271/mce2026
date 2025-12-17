@extends('layouts.app')

@section('title', 'Data Aspirasi Peserta')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10">
    <h2 class="text-2xl font-semibold mb-3">Data Aspirasi & Saran Peserta</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($feedbacks->isEmpty())
        <p class="text-gray-500 text-center mt-4">Belum ada aspirasi yang masuk.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 mt-4">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Pesan</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $i => $fb)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $i + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $fb->category ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $fb->message }}</td>
                        <td class="px-4 py-2 border">{{ $fb->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-2 border text-center">
                            @if($fb->addressed)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Selesai</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">Belum</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            @if(!$fb->addressed)
                                <form action="{{ route('admin.feedbacks.addressed', $fb->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-600 hover:underline">Tandai Selesai</button>
                                </form>
                            @else
                                <span class="text-gray-400">✓</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $feedbacks->links() }}
        </div>
    @endif
</div>
@endsection
