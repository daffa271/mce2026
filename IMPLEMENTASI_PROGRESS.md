# ✅ IMPLEMENTASI SISTEM TIKET MCE 2026

## 🎯 YANG SUDAH DIKERJAKAN (✅ COMPLETED)

### 1. Database & Models ✅

-   [x] Updated `Registration` model dengan field baru:

    -   `verification_status` (pending/verified/rejected)
    -   `quantity` (jumlah tiket)
    -   `bundle_participants` (JSON untuk bundle)
    -   `payment_notes` (catatan dari user)
    -   `verified_at` (waktu verifikasi)
    -   `qr_code_path` (path QR code)

-   [x] Updated `TicketPackage` model:

    -   `is_bundle` (tanda paket bundle)
    -   `bundle_size` (jumlah peserta dalam bundle)

-   [x] Created migrations untuk semua field baru
    -   Database migration sudah berjalan dengan sukses

### 2. Controllers - Core Logic ✅

#### UserDashboardController.php ✅

```
✓ Get user statistics (tiket terbeli, terverifikasi, menunggu)
✓ Get recent registrations
✓ Calculate total amount
```

#### TicketController.php ✅

**Metode index()**: List user's tickets
**Metode selectPackage()**: Show available packages
**Metode checkout()** - FLOW PENTING:

-   Create registration dengan status PENDING
-   TIDAK decrement quota (penting!)
-   Redirect ke payment page dengan pesan:
    "Registrasi berhasil! Silakan lakukan pembayaran sekarang."

**Metode payment()**: Show payment page
**Metode uploadProof()** - FLOW PENTING:

-   User upload bukti pembayaran
-   Validate bundle participants jika is_bundle
-   Store file & update registration:
    -   payment_status = 'paid'
    -   verification_status = 'pending'
    -   paid_at = now()
-   DECREMENT quota di sini (penting!)
-   Redirect dengan pesan:
    "Bukti pembayaran berhasil dikirim! Tunggu verifikasi admin."

**Metode download()**: Download e-ticket untuk verified registrations

### 3. Views (Partial) ✅

#### resources/views/user/dashboard.blade.php ✅

-   Selamat datang dengan nama user
-   Quick stats (tiket terbeli, terverifikasi, menunggu, total biaya)
-   Recent registrations preview
-   Buttons untuk fitur lain (kampus, jadwal, galeri, feedback)
-   Profile card
-   Tips & support info

#### resources/views/user/tickets/ (Existing)

-   index.blade.php ✅ (perlu update minor untuk status badges)
-   select.blade.php ✅ (perlu update minor untuk bundle display)
-   payment.blade.php ✅ (sudah cukup, perlu tambah bundle participants form)

---

## 🚧 YANG PERLU DIKERJAKAN (TO-DO)

### PRIORITY 1: PAYMENT FORM UPDATE (Critical)

**File**: `resources/views/user/tickets/payment.blade.php`

**Perubahan yang perlu dilakukan**:

1. Add bundle participants form (jika `is_bundle`)
2. Update pesan success/info

**CODE SNIPPET**:

```blade
<!-- Tambahkan ini di form pembayaran, sebelum "Kirim Bukti Pembayaran" button -->

@if($registration->ticketPackage->is_bundle)
<div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200 mb-6">
    <h3 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
        📋 Data Peserta Bundle
    </h3>

    <p class="text-sm text-purple-700 mb-4">
        Paket bundle ini untuk {{ $registration->ticketPackage->bundle_size }} peserta.
        Silakan isi data setiap peserta di bawah ini.
    </p>

    @for($i = 1; $i <= $registration->ticketPackage->bundle_size; $i++)
    <div class="bg-white rounded-lg p-4 border border-purple-200 mb-4">
        <h4 class="font-bold text-purple-900 mb-3">Peserta {{ $i }}</h4>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="participant_{{ $i }}_name"
                    required
                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C]"
                    placeholder="Masukkan nama peserta {{ $i }}">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Asal Sekolah
                </label>
                <input type="text"
                    name="participant_{{ $i }}_school"
                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#118C8C] focus:border-[#118C8C]"
                    placeholder="SMA Negeri ...">
            </div>
        </div>
    </div>
    @endfor
</div>
@endif
```

### PRIORITY 2: ADMIN PANEL VIEWS

#### resources/views/admin/registrations/index.blade.php

**Fungsi**: List semua registrations dengan payment proofs
**Konten**:

-   Stats cards (total, pending, verified, rejected, unpaid)
-   Filter by status, payment status, search
-   Table dengan columns:
    -   Kode Registrasi
    -   Nama Peserta
    -   Paket Tiket
    -   Total
    -   Status Pembayaran
    -   Status Verifikasi
    -   Action (View, Verify, Reject)
-   Pagination

**CODE SNIPPET**:

```blade
@extends('layouts.app')

@section('title', 'Admin - Kelola Registrasi')

@section('content')
<section class="bg-gray-50 min-h-screen pt-24 pb-12 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <h1 class="text-4xl font-bold text-gray-900 mb-8">⚙️ Kelola Registrasi</h1>

        <!-- Stats -->
        <div class="grid grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
                <p class="text-gray-600 text-sm font-semibold">Total</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
                <p class="text-gray-600 text-sm font-semibold">Menunggu</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
                <p class="text-gray-600 text-sm font-semibold">Verified</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['verified'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-red-500">
                <p class="text-gray-600 text-sm font-semibold">Rejected</p>
                <p class="text-3xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-purple-500">
                <p class="text-gray-600 text-sm font-semibold">Belum Bayar</p>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['unpaid'] }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form method="GET" action="{{ route('admin.registrations.index') }}" class="grid grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="Cari kode/email..." value="{{ request('search') }}" class="px-4 py-2 border rounded-lg">

                <select name="status" class="px-4 py-2 border rounded-lg">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <select name="payment_status" class="px-4 py-2 border rounded-lg">
                    <option value="">Semua Pembayaran</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">Cari</button>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Kode</th>
                        <th class="px-6 py-3 text-left font-semibold">Peserta</th>
                        <th class="px-6 py-3 text-left font-semibold">Paket</th>
                        <th class="px-6 py-3 text-left font-semibold">Total</th>
                        <th class="px-6 py-3 text-left font-semibold">Pembayaran</th>
                        <th class="px-6 py-3 text-left font-semibold">Verifikasi</th>
                        <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-mono text-sm">{{ $registration->registration_code }}</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold">{{ $registration->name }}</p>
                                <p class="text-sm text-gray-600">{{ $registration->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $registration->ticketPackage->name }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                {{ $registration->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($registration->payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if($registration->verification_status == 'verified')
                                    bg-green-100 text-green-700
                                @elseif($registration->verification_status == 'pending')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst($registration->verification_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.registrations.show', $registration) }}" class="text-blue-600 hover:underline text-sm font-semibold">
                                View →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-600">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $registrations->links() }}
        </div>
    </div>
</section>
@endsection
```

#### resources/views/admin/registrations/show.blade.php

**Fungsi**: Detail registrasi dengan payment proof verification
**Konten**:

-   Registration details
-   Payment proof image/PDF viewer
-   Bundle participants (jika ada)
-   Verify/Reject buttons
-   Audit trail

---

## 📋 NEXT IMMEDIATE STEPS

### 1. Update Payment Form (Urgency: HIGH)

Add bundle participants form ke `payment.blade.php`

### 2. Create Admin Registration Index (Urgency: HIGH)

Admin harus bisa lihat dan verify payments

### 3. Create Admin Registration Show (Urgency: HIGH)

View payment proof dan verify/reject

### 4. Update Admin RegistrationController (Urgency: HIGH)

Implement full verify() dan reject() methods

### 5. Add QR Code Display (Urgency: MEDIUM)

Show QR code di tiket after verified

### 6. Create E-Ticket PDF (Urgency: MEDIUM)

Generate PDF e-ticket with QR code

### 7. Add Email Notifications (Urgency: LOW)

Send email after verify/reject

---

## 🧪 QUICK TESTING GUIDE

### Test Checkout Flow:

1. Login sebagai user
2. Go to `/tiket/pilih-paket`
3. Click "Beli Sekarang" pada paket apapun
4. Should see: "Registrasi berhasil! Silakan lakukan pembayaran sekarang."
5. Check database: `registration.payment_status` = 'pending', `verification_status` = 'pending'
6. Check database: `ticketPackage.sold` = NOT incremented yet

### Test Payment Upload Flow:

1. Fill payment form
2. Upload payment proof
3. If bundle: fill participant names
4. Click "Kirim Bukti Pembayaran"
5. Should see: "Bukti pembayaran berhasil dikirim, tunggu verifikasi admin."
6. Check database: `registration.payment_status` = 'paid', `verification_status` = 'pending'
7. Check database: `ticketPackage.sold` = INCREMENTED ✅

### Test Admin Verification:

1. Login sebagai admin
2. Go to `/admin/registrations`
3. Click View pada registration
4. Review payment proof
5. Click Verify
6. Should see QR code generated
7. User should see "Terverifikasi" status
8. User can download e-ticket

---

## 🔧 TECHNICAL NOTES

-   File uploads stored di `storage/app/public/payment_proofs/`
-   QR codes stored di `storage/app/public/qrcodes/`
-   Use `Storage::url()` untuk generate URLs
-   Validate file type/size di controller

---

**Status**: Core architecture complete, 70% implementation done
**Next Phase**: Admin UI & QR code integration
**Estimated Time**: 3-4 hours untuk complete implementation
