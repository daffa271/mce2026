# PERBAIKAN SISTEM PEMBAYARAN TIKET MCE 2026

## 📋 Ringkasan Perubahan yang Dilakukan

Sistem pembayaran tiket sudah diperbaiki sesuai alur yang Anda minta. Berikut adalah penjelasan lengkap apa yang sudah diubah:

### ✅ 1. USER WAJIB UPLOAD BUKTI PEMBAYARAN

**Status**: ✅ SUDAH DIPERBAIKI

-   Sebelumnya: User bisa langsung "tutup" tanpa upload bukti
-   **Sekarang**: User HARUS upload bukti pembayaran sebelum selesai
    -   Form upload bukti adalah MANDATORY (wajib diisi)
    -   Tanpa upload bukti, registrasi tetap status "Belum Bayar"
    -   Setelah upload, status berubah menjadi "Menunggu Verifikasi"

**Lokasi**: `/resources/views/user/tickets/payment.blade.php` (lines 480-550)
**Controller**: `UserTicketController@uploadProof` mengharuskan payment_proof file

---

### ✅ 2. FITUR DISKON LENGKAP

**Status**: ✅ SUDAH DIIMPLEMENTASI

Admin sekarang bisa membuat, mengelola, dan publish kode diskon.

#### Admin Interface:

-   **Menu**: Dashboard → Kelola Diskon
-   **Route**: `/admin/discount-codes`

#### Fitur:

-   ✅ **Buat Kode Diskon Baru** (`/admin/discount-codes/create`)

    -   Input: Kode, Persentase Diskon (1-100%), Deskripsi, Valid From, Valid Until (optional), Usage Limit (optional)
    -   Auto uppercase untuk kode
    -   Admin bisa langsung publish (status = aktif)

-   ✅ **List & Manage Kode** (`/admin/discount-codes`)

    -   Tampil semua kode dengan detail: kode, diskon%, periode, pemakaian, status
    -   Edit kode (ubah apapun kecuali counter penggunaan)
    -   Delete kode
    -   Filter aktif/nonaktif

-   ✅ **Enable/Disable Kode**
    -   Admin bisa menonaktifkan kode yang sudah dibuat
    -   Kode nonaktif tidak bisa digunakan user

**Teknologi**:

-   Model: `App\Models\DiscountCode` (sudah lengkap dengan validasi)
-   Migration: `2025_12_24_100000_create_discount_codes_table.php`
-   Controller: `Admin\DiscountCodeController` (CRUD lengkap)
-   Views:
    -   `admin/discount-codes/index.blade.php` (list)
    -   `admin/discount-codes/create.blade.php` (create)
    -   `admin/discount-codes/edit.blade.php` (edit)

---

### ✅ 3. USER APPLY DISKON SAAT PEMBAYARAN

**Status**: ✅ SUDAH DIIMPLEMENTASI

User bisa apply kode diskon sebelum upload bukti pembayaran.

#### Alur:

1. User sudah di halaman pembayaran
2. Ada section "🎟️ Kode Diskon" dengan form input
3. User input kode (misal: `MCE50`)
4. Klik "Cek Kode"
5. Sistem validasi:
    - Kode harus ada
    - Kode harus aktif (`is_active = true`)
    - Dalam periode berlaku (`valid_from` ≤ now ≤ `valid_until`)
    - Belum melebihi `usage_limit`
6. Jika valid:
    - Tampil harga dengan diskon breakdown:
        - Harga Normal: Rp X
        - Diskon (Y%): -Rp Z
        - **Harga Final: Rp (X-Z)**
    - Tombol "Terapkan Diskon" muncul
7. User klik "Terapkan Diskon"
8. Sistem update registration:
    - `discount_code_id` = id kode
    - `discount_percentage` = Y
    - `original_amount` = X (harga sebelum diskon)
    - `total_amount` = (X-Z) (harga setelah diskon)
9. User harus transfer sesuai harga final (yang sudah dipotong diskon)

**PENTING**: Setelah user upload bukti, diskon tidak bisa diubah lagi!

**Lokasi**:

-   View: `/resources/views/user/tickets/payment.blade.php` (lines 220-250)
-   Controller: `UserTicketController@applyDiscount`
-   Route: `POST /tiket/{registration}/apply-discount`

---

### ✅ 4. ADMIN VERIFIKASI PEMBAYARAN

**Status**: ✅ SUDAH DIIMPLEMENTASI (RESTORED)

Admin punya aksi lengkap untuk verifikasi pembayaran user.

#### Aksi Admin:

1. **Lihat Detail Pembayaran**

    - Admin buka `/admin/registrations` (Kelola Registrasi)
    - Filter Status: "Perlu Verifikasi"
    - Klik nama peserta atau tombol "👁" (mata)
    - Buka halaman detail registrasi
    - Lihat:
        - Info peserta (nama, email, sekolah, kelas)
        - Info tiket (paket, jumlah, total harga, diskon yang diapply)
        - **Preview Bukti Pembayaran** (gambar/foto transfer)
        - Catatan pembayaran

2. **Verifikasi ✓ (Setujui)**

    - Admin lihat bukti, cek:
        - Nominal transfer sesuai harga final (respect diskon)
        - Nama rekening tujuan benar
        - Kode registrasi tertera di deskripsi (optional tapi recommended)
    - Admin klik tombol "✓ Verifikasi"
    - Sistem update:
        - `verification_status` = "verified"
        - `verified_at` = timestamp sekarang
    - Status user berubah menjadi "Terverifikasi ✓"
    - User sudah bisa menerima tiket (menunggu admin generate QR)

3. **Tolak ✗ (Reject)**
    - Admin lihat bukti, ada masalah:
        - Nominal kurang/lebih
        - Rekening tujuan salah
        - Transfer ganda (sudah bayar sebelumnya)
        - Bukti tidak jelas
    - Admin klik tombol "✗ Tolak"
    - Opsional: Masukkan alasan di field "payment_notes"
    - Sistem update:
        - `verification_status` = "rejected"
        - `payment_notes` = alasan penolakan
    - Status user berubah menjadi "Ditolak ✗"
    - User perlu re-upload bukti (belum ada fitur otomatis, perlu minta user upload ulang)

**Lokasi**:

-   View List: `/resources/views/admin/registrations/index.blade.php`
-   View Detail: `/resources/views/admin/registrations/show.blade.php`
-   Controller: `Admin\RegistrationController@verify`, `@reject`
-   Routes:
    -   `POST /admin/registrations/{registration}/verify`
    -   `POST /admin/registrations/{registration}/reject`

---

### ✅ 5. ADMIN GENERATE QR CODE TIKET

**Status**: ✅ SUDAH DIIMPLEMENTASI

Setelah pembayaran terverifikasi, admin generate QR Code tiket untuk user.

#### Proses:

1. **Syarat**: Registrasi harus `verification_status = 'verified'`

2. **Aksi**: Di halaman list registrasi `/admin/registrations`

    - Filter Status: "Terverifikasi"
    - Tombol aksi: 🎫 (Generate Tiket & QR Code)
    - Atau di halaman detail, tombol "🎫"

3. **Sistem Generate**:

    - Generate unique barcode: `MCE2026-XXXXX`
    - Buat QR Code payload (JSON):
        ```json
        {
            "barcode": "MCE2026-XXXXX",
            "name": "Nama Peserta",
            "school": "SMA Negeri 1",
            "ticket_package": "Paket Tiket",
            "verified_at": "2025-01-10"
        }
        ```
    - Generate SVG QR Code (bukan PNG, tidak perlu Imagick)
    - Simpan ke storage: `storage/app/public/qrcodes/MCE2026-XXXXX.svg`
    - Update registration:
        - `barcode` = `MCE2026-XXXXX`
        - `qr_code_path` = `qrcodes/MCE2026-XXXXX.svg`

4. **Untuk Bundle Tiket**:

    - Generate QR code TERPISAH untuk setiap peserta
    - Setiap peserta dapat barcode unik dan QR code unik
    - Simpan di `bundle_barcodes` array:
        ```php
        [
          ["number" => 1, "name" => "Peserta 1", "barcode" => "MCE2026-B1-XXX", "qr_code_path" => "..."],
          ["number" => 2, "name" => "Peserta 2", "barcode" => "MCE2026-B2-XXX", "qr_code_path" => "..."],
        ]
        ```

5. **User Lihat Tiket**:
    - User buka `/my-ticket/{registration}` atau `/tiket/pembayaran/{registration}`
    - Lihat QR Code mereka
    - Bisa download tiket sebagai PDF
    - Untuk bundle, tampil 1 tiket per peserta

**Lokasi**:

-   Controller: `TicketController@verify`
-   Helper methods: `generateSingleTicket()`, `generateBundleTickets()`
-   Route: `POST /admin/registrations/{registration}/ticket-verify`
-   View: Tombol 🎫 ada di list dan detail registrasi

---

## 📊 Alur Pembayaran Lengkap

```
USER SIDE:
┌─────────────────────────────────────────────────────────────┐
│ 1. User pilih paket tiket (lihat harga normal)              │
│    ↓                                                         │
│ 2. Checkout → status: "Belum Bayar"                         │
│    ↓                                                         │
│ 3. Lihat halaman pembayaran (LANGKAH 2 dari 3)              │
│    - Lihat bank tujuan transfer                             │
│    - [OPTIONAL] Input kode diskon → harga terpotong        │
│    ↓                                                         │
│ 4. Transfer sesuai harga final (yang sudah dipotong diskon) │
│    ↓                                                         │
│ 5. WAJIB Upload bukti pembayaran                            │
│    - Pilih metode pembayaran                                │
│    - Upload screenshot/foto bukti                           │
│    - [Jika bundle] Isi data semua peserta                   │
│    ↓                                                         │
│    Status: "Menunggu Verifikasi" (payment_status=paid)      │
│                                                             │
├─────────────────────────────────────────────────────────────┤
ADMIN SIDE:
│ 6. Admin lihat registrasi "Perlu Verifikasi"                │
│    ↓                                                         │
│ 7. Admin lihat detail + preview bukti pembayaran            │
│    ↓                                                         │
│ 8a. [APPROVE] Klik "✓ Verifikasi"                           │
│    Status: "Terverifikasi" (verification_status=verified)   │
│    ↓                                                         │
│ 8b. [REJECT] Klik "✗ Tolak"                                 │
│    Status: "Ditolak" (verification_status=rejected)         │
│    User harus upload bukti lagi                             │
│    STOP (go back to step 3 or 5)                            │
│                                                             │
│ 9. Admin klik "🎫 Generate Tiket"                            │
│    Sistem generate barcode + QR code                        │
│    Simpan ke storage                                        │
│    Status: Tiket sudah siap                                 │
│                                                             │
├─────────────────────────────────────────────────────────────┤
USER SIDE (lanjutan):
│ 10. User lihat "/tiket/pembayaran/{id}"                      │
│     Status: "Tiket Sudah Disiapkan"                          │
│     Tombol: Preview Tiket / Download Tiket                   │
│     ↓                                                        │
│ 11. User preview/download tiket dengan QR Code              │
│     ↓                                                        │
│ 12. Saat acara, user scan QR Code                           │
│     Panitia scan → user check-in                            │
│     Status: "Sudah Check-in"                                │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## 🧪 Testing Instructions

### Test Case 1: Pembayaran Tanpa Diskon

**User Side:**

1. Login sebagai user biasa
2. Buka `/tiket/pilih-paket`
3. Pilih paket (misal "Paket Standar" Rp 1.000.000)
4. Klik "Checkout"
5. Ke halaman `/tiket/pembayaran/{id}`
6. Lihat detail:
    - Kode Registrasi
    - Paket Tiket
    - Total: Rp 1.000.000 (tanpa diskon)
7. Scroll ke bawah → "Upload Bukti Pembayaran"
8. Pilih metode pembayaran: "🏦 Transfer Bank"
9. Upload foto/screenshot bukti transfer (JPG/PNG/PDF)
10. Klik "Upload Bukti Pembayaran"
11. ✅ Pesan sukses: "Bukti pembayaran berhasil dikirim!"
12. Status berubah menjadi "⏳ Menunggu Verifikasi"

**Admin Side:**

1. Login sebagai admin
2. Buka Admin Dashboard → Kelola Registrasi
3. Filter Status: "Perlu Verifikasi"
4. Klik nama peserta / tombol mata "👁"
5. Lihat detail:
    - Info peserta
    - Preview bukti pembayaran
    - Tombol "✓ Verifikasi" dan "✗ Tolak"
6. Klik "✓ Verifikasi"
7. ✅ Status berubah: "✓ Terverifikasi"
8. Klik tombol "🎫" untuk generate QR code
9. ✅ Pesan: "QR Code berhasil di-generate!"
10. Tombol berubah dari "🎫" menjadi "Preview Tiket"

**User Side (lanjutan):**

1. Refresh halaman `/tiket/pembayaran/{id}`
2. Status berubah: "Tiket Sudah Disiapkan"
3. Tombol baru: "Preview Tiket" / "Download Tiket"
4. Klik "Preview Tiket"
5. ✅ Lihat tiket lengkap dengan QR code

---

### Test Case 2: Pembayaran Dengan Diskon

**Admin Side (Setup):**

1. Buka Admin Dashboard → Kelola Diskon
2. Klik "Buat Kode Diskon"
3. Isi form:
    - Kode: `TEST50`
    - Diskon: 50
    - Berlaku Dari: Hari ini
    - Status: ✓ Aktifkan
4. Klik "Simpan Kode Diskon"
5. ✅ Kode `TEST50` muncul di list dengan status "✓ Aktif"

**User Side:**

1. Login sebagai user
2. Buka `/tiket/pilih-paket`
3. Pilih paket standar (Rp 1.000.000)
4. Checkout
5. Di halaman pembayaran, lihat section "🎟️ Kode Diskon"
6. Input: `TEST50`
7. Klik "Cek Kode"
8. ✅ Pesan valid, tampil:
    - Harga Normal: Rp 1.000.000
    - Diskon (50%): -Rp 500.000
    - **Harga Final: Rp 500.000**
9. Klik "Terapkan Diskon"
10. ✅ Halaman refresh, harga total berubah menjadi Rp 500.000
11. User lihat di detail registration:
    - `original_amount`: 1000000
    - `discount_percentage`: 50
    - `total_amount`: 500000
12. Upload bukti pembayaran dengan nominal **Rp 500.000** (HARUS SESUAI!)
13. ✅ Status: "Menunggu Verifikasi"

**Admin Side:**

1. Buka registrasi yang baru dibuat
2. Lihat detail pembayaran:
    - Harga Normal: Rp 1.000.000
    - Diskon (TEST50): 50%
    - Total Bayar: Rp 500.000
3. Lihat bukti pembayaran (nominal Rp 500.000)
4. Verifikasi
5. Generate QR code
6. ✅ User dapat tiket

---

### Test Case 3: Pembayaran Ditolak

**User Side:**

1. Login, pilih paket, upload bukti pembayaran dengan nominal SALAH
    - Misal harga Rp 1.000.000, tapi user transfer Rp 800.000
2. Status: "⏳ Menunggu Verifikasi"

**Admin Side:**

1. Lihat registrasi
2. Preview bukti pembayaran
3. Lihat nominalnya kurang (Rp 800.000, seharusnya Rp 1.000.000)
4. Klik tombol "✗ Tolak"
5. ✅ Status berubah: "✗ Ditolak"

**User Side (lanjutan):**

1. Refresh halaman
2. Status berubah: "✗ Ditolak"
3. ⚠️ Catatan: User harus diminta untuk upload ulang bukti yang benar
    - Ini belum ada fitur otomatis, perlu admin request user untuk submit ulang

---

## 📝 Catatan Penting

### Diskon & Harga

1. **Kode diskon hanya berlaku SEBELUM upload bukti**

    - Setelah user upload bukti, diskon sudah final dan tidak bisa diubah
    - Admin verifikasi berdasarkan harga final (yang sudah dipotong diskon)

2. **Nominal transfer HARUS EXACT**

    - Jika harga final Rp 500.000, transfer harus persis Rp 500.000
    - Transfer lebih atau kurang akan sulit untuk diverifikasi

3. **Increment Quota**
    - Quota paket hanya dikurangi SETELAH user upload bukti (bukan saat checkout)
    - Ini untuk mencegah "fake checkout" menghabiskan quota

### Bundle Tiket

1. **Data Peserta WAJIB diisi saat upload bukti**

    - Untuk paket bundle, user harus isi nama + sekolah setiap peserta
    - Data ini akan ditampilkan di QR code masing-masing peserta

2. **Generate QR Terpisah**
    - Admin generate → sistem otomatis buat QR code untuk setiap peserta
    - Setiap peserta dapat barcode unik dan QR unik

---

## 🔍 File-File Yang Diubah/Dibuat

### Models

-   ✅ `app/Models/DiscountCode.php` - Sudah lengkap dengan validasi
-   ✅ `app/Models/Registration.php` - Sudah ada field diskon

### Controllers

-   ✅ `app/Http/Controllers/Admin/DiscountCodeController.php` - CRUD diskon
-   ✅ `app/Http/Controllers/Admin/RegistrationController.php` - Verify & reject
-   ✅ `app/Http/Controllers/User/TicketController.php` - Apply diskon
-   ✅ `app/Http/Controllers/TicketController.php` - Generate QR code

### Views

-   ✅ `resources/views/admin/discount-codes/index.blade.php` - List diskon (UPDATED)
-   ✅ `resources/views/admin/discount-codes/create.blade.php` - Buat diskon
-   ✅ `resources/views/admin/discount-codes/edit.blade.php` - Edit diskon
-   ✅ `resources/views/admin/registrations/index.blade.php` - List registrasi + aksi
-   ✅ `resources/views/admin/registrations/show.blade.php` - Detail registrasi + aksi
-   ✅ `resources/views/user/tickets/payment.blade.php` - Payment page (sudah lengkap)

### Routes

-   ✅ Sudah ada di `routes/web.php`
    -   `admin.discount-codes.*` (CRUD diskon)
    -   `admin.registrations.verify`, `reject`, `ticket-verify`
    -   `user.tickets.apply-discount`

### Database

-   ✅ Migration: `2025_12_24_100000_create_discount_codes_table.php`
-   ✅ Migration: `2025_12_24_100100_add_discount_fields_to_registrations_table.php`
-   ✅ Semua fields sudah ada

### Dokumentasi

-   ✅ `ALUR_PEMBAYARAN_TIKET_LENGKAP.md` - Dokumentasi lengkap alur

---

## ✨ Kesimpulan

Semua requirement sudah diimplementasi:

1. ✅ User WAJIB upload bukti pembayaran
2. ✅ Admin bisa buat & manage kode diskon
3. ✅ User bisa apply diskon saat pembayaran
4. ✅ Admin bisa verifikasi/tolak pembayaran
5. ✅ Admin generate QR code setelah verifikasi
6. ✅ Alur pembayaran sudah sesuai dengan spesifikasi

**Status**: READY FOR TESTING! 🚀
