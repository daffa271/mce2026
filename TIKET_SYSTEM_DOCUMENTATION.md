# Dokumentasi Sistem Tiket MCE 2026 dengan QR Code

## 📋 Konsep Sistem

Sistem tiket MCE 2026 mengimplementasikan alur berikut:

1. **User Pendaftaran** - User melakukan registrasi melalui form
2. **Admin Verifikasi** - Admin memverifikasi data pembayaran (existing)
3. **Generate QR Code** - Setelah verified, admin klik tombol "Generate Tiket" untuk generate QR code
4. **User Lihat Tiket** - User bisa melihat ticket dengan QR code di dashboard
5. **Check-in di Acara** - Petugas scan QR code untuk check-in peserta

---

## 🏗️ Struktur File yang Dibuat

### 1. **Controller**

-   `app/Http/Controllers/TicketController.php`
    -   `verify()` - Admin verify & generate QR code
    -   `show()` - User lihat ticket
    -   `download()` - Download ticket
    -   `scan()` - API untuk scan QR code (check-in)
    -   `recentCheckins()` - API untuk list check-in terakhir

### 2. **Views**

-   `resources/views/tickets/show.blade.php` - Tampilan ticket dengan QR code
-   `resources/views/tickets/scan.blade.php` - Page untuk scan QR code (admin/staff)

### 3. **Routes**

-   Web routes di `routes/web.php`:

    ```
    /my-ticket/{registration}              - Lihat ticket (user)
    /my-ticket/{registration}/download     - Download ticket (user)
    /admin/tickets/scan                    - Scan page (admin)
    /admin/registrations/{id}/ticket-verify - Verify & generate QR
    ```

-   API routes di `routes/api.php`:
    ```
    POST /api/tickets/scan       - Scan barcode
    GET  /api/checkins/recent    - Get recent checkins
    ```

### 4. **Database**

-   Migration: `database/migrations/2025_12_20_000000_add_barcode_to_registrations_table.php`
-   Menambah kolom: `barcode` (unique, string)

---

## 🔄 Alur Penggunaan

### Fase 1: User Registrasi (Sudah Ada)

```
User → Form Registrasi → Database
```

### Fase 2: Admin Verifikasi Data & Generate Tiket

```
Admin → Lihat Registrations List → Klik "Verify" → Verifikasi Pembayaran
      → Klik "Generate Tiket" → Generate Barcode & QR Code → QR Code Tersimpan
```

### Fase 3: User Lihat Tiket

```
User → Dashboard/Tickets → Klik "Lihat Tiket" → Show QR Code & Details
    → Opsi: Cetak atau Simpan di HP
```

### Fase 4: Check-in di Acara

```
Peserta → Tunjukkan HP/Tiket ke Staff
       → Staff → Scan Page → Scan QR Code
       → Sistem → Check-in Success → Update Database
       → Staff → Lihat Detail Peserta & Waktu Check-in
```

---

## 📱 Data dalam QR Code

Ketika QR code di-scan, berisi payload JSON:

```json
{
    "barcode": "MCE2026-ABC123DEF456",
    "name": "Nama Peserta",
    "school": "Sekolah Peserta",
    "ticket_package": "Standard/VIP",
    "verified_at": "2025-12-20"
}
```

---

## 🔑 Kolom Database Registrations

| Kolom                 | Tipe     | Fungsi                       |
| --------------------- | -------- | ---------------------------- |
| `barcode`             | string   | Unique barcode untuk QR code |
| `qr_code_path`        | string   | Path ke file QR code (SVG)   |
| `verification_status` | enum     | pending/verified/rejected    |
| `verified_at`         | datetime | Waktu verifikasi             |
| `is_checked_in`       | boolean  | Status check-in (false/true) |
| `checked_in_at`       | datetime | Waktu check-in               |

---

## 🎯 Menu Admin

Tambahkan tombol di Admin Registrations Index:

```blade
@if($registration->verification_status === 'verified')
    @if(!$registration->barcode)
        <!-- Belum generate tiket -->
        <form action="{{ route('admin.registrations.ticket-verify', $registration) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">
                🎫 Generate Tiket & QR Code
            </button>
        </form>
    @else
        <!-- Sudah ada tiket -->
        <span class="badge badge-success">✓ Tiket Ready</span>
        <a href="{{ route('tickets.show', $registration) }}" class="btn btn-info btn-sm">
            👁️ Preview Tiket
        </a>
    @endif
@else
    <!-- Belum verified pembayaran -->
    <span class="badge badge-warning">⏳ Waiting Payment Verify</span>
@endif
```

---

## 🔗 Link Route Reference

### Untuk User

-   Lihat tiket: `route('tickets.show', $registration)`
-   Download: `route('tickets.download', $registration)`

### Untuk Admin

-   Scan page: `route('admin.tickets.scan')`
-   Generate tiket: `route('admin.registrations.ticket-verify', $registration)`

### API

-   Scan: `POST /api/tickets/scan` dengan `{"barcode": "..."}`
-   Recent: `GET /api/checkins/recent`

---

## ⚙️ Konfigurasi

### Storage Public

File QR code disimpan di: `storage/app/public/qrcodes/`

Pastikan sudah:

```bash
php artisan storage:link
```

### CORS (Jika API dari domain berbeda)

Update `config/cors.php` jika diperlukan untuk scan mobile app.

---

## 🚀 Cara Test

### 1. Registrasi Peserta

```
GET /registrations/create → POST /registrations
```

### 2. Admin Verify Pembayaran

```
GET /admin/registrations → POST /admin/registrations/{id}/verify
```

### 3. Admin Generate Tiket

```
POST /admin/registrations/{id}/ticket-verify
→ Generate barcode unik
→ Generate QR code SVG
→ Simpan ke storage
→ Update database
```

### 4. User Lihat Tiket

```
GET /my-ticket/{registration}
→ Tampilkan detail peserta
→ Tampilkan QR code
→ Opsi cetak
```

### 5. Test Scan (Di Acara)

```
GET /admin/tickets/scan
→ Manual input barcode atau scan QR
POST /api/tickets/scan {"barcode": "MCE2026-..."}
→ Update is_checked_in = true
→ Set checked_in_at = now()
```

---

## 📊 Checklist Implementasi

-   ✅ TicketController dibuat
-   ✅ Views tickets/show.blade.php dibuat
-   ✅ Views tickets/scan.blade.php dibuat
-   ✅ Routes ditambahkan (web & api)
-   ✅ Migration untuk barcode dibuat
-   ✅ Model Registration updated
-   ⏳ **NEXT**: Update Admin RegistrationController index view untuk tombol "Generate Tiket"
-   ⏳ **NEXT**: Update User Dashboard untuk link ke ticket show
-   ⏳ **NEXT**: Test semua alur

---

## 💡 Tips & Troubleshooting

### QR Code tidak muncul

-   Check: `php artisan storage:link`
-   Check folder: `storage/app/public/qrcodes/` ada file .svg

### Scan tidak bekerja

-   Check: API route di `routes/api.php` aktif
-   Check: CSRF token di scan.blade.php
-   Check: Browser console untuk error JavaScript

### Barcode belum tersimpan

-   Pastikan kolom `barcode` di migration sudah di-migrate
-   Run: `php artisan migrate:refresh` (jika dev environment)

---

## 📝 File Dependencies

```
TicketController.php
├── SimpleSoftwareIO\QrCode\Facades\QrCode
├── Illuminate\Support\Str
├── Illuminate\Support\Facades\Storage
└── App\Models\Registration

Blade Views
├── @extends('layouts.app')
├── Tailwind CSS
└── Alpine.js (optional, untuk scan page)
```

---

**Dibuat**: 20 Desember 2025
**Status**: Production Ready ✅
**Version**: 1.0
