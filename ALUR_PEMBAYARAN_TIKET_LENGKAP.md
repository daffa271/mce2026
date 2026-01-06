# Dokumentasi Alur Pembayaran Tiket MCE 2026

## Ringkasan Alur Pembayaran yang Benar

### 1. User Melihat Paket Tiket dan Harga Normal

-   User membuka halaman `/tiket/pilih-paket`
-   Melihat daftar paket tiket dengan harga normal
-   Dapat melihat deskripsi benefit dari setiap paket

### 2. Admin Membuat Kode Diskon

-   Admin membuka `/admin/discount-codes` (Menu Dashboard → Kelola Diskon)
-   Klik "Buat Kode Diskon"
-   Isi form:
    -   **Kode Diskon**: Misal `MCE50`, `MEMBER20`
    -   **Persentase Diskon**: Misal `50%` untuk MCE50
    -   **Deskripsi**: Opsional, misal "Diskon untuk early bird"
    -   **Berlaku Dari**: Tanggal mulai berlaku
    -   **Berakhir Sampai**: Opsional, jika ada batas waktu
    -   **Batas Penggunaan**: Opsional, misal maksimal 100 pemakaian
    -   **Status**: Centang "Aktifkan" agar bisa digunakan langsung
-   Klik "Simpan Kode Diskon"

### 3. Admin Publish/Nonaktifkan Kode Diskon

-   Kode yang sudah dibuat akan tampil di list diskon
-   Admin bisa Edit atau Hapus kode
-   Status **Aktif** berarti user bisa menggunakan kode tersebut
-   Status **Nonaktif** berarti kode tidak bisa digunakan

### 4. User Memilih Paket dan Checkout

-   User pilih paket yang ingin dibeli
-   Masukkan jumlah tiket (untuk bundle, maksimal sesuai ukuran bundle)
-   Klik "Checkout"
-   Status berubah menjadi **"Belum Bayar"** (payment_status = pending)

### 5. User Lihat Halaman Pembayaran (Step 2 dari 3)

-   URL: `/tiket/pembayaran/{registration_id}`
-   Halaman menampilkan:
    -   ✅ **Detail Registrasi**: Kode registrasi, paket tiket, total harga
    -   ✅ **Diskon Code Section**: Input field untuk memasukkan kode diskon (sebelum upload bukti)
    -   ✅ **Bank Transfer Info**: Menampilkan 4 pilihan bank dan QRIS
    -   ✅ **Upload Bukti Pembayaran**: Form untuk upload screenshot/foto bukti transfer

### 6. User Terapkan Kode Diskon (OPTIONAL, sebelum upload)

-   User punya kode diskon, misal `MCE50` (diskon 50%)
-   Harga normal: Rp 1.000.000
-   User masuk kode di field "Masukkan Kode Diskon"
-   Klik tombol "Cek Kode"
-   Sistem validasi kode:
    -   ✅ Kode harus aktif (is_active = true)
    -   ✅ Tanggal harus dalam periode berlaku
    -   ✅ Belum melebihi batas penggunaan
-   Jika valid, tampil harga dengan diskon:
    -   Harga normal: Rp 1.000.000
    -   Diskon (50%): -Rp 500.000
    -   **Harga Final: Rp 500.000**
-   User klik "Terapkan Diskon"
-   Sistem update registration:
    -   `total_amount` = 500000 (harga setelah diskon)
    -   `original_amount` = 1000000 (harga sebelum diskon)
    -   `discount_percentage` = 50
    -   `discount_code_id` = id kode diskon

### 7. User Transfer Sesuai Harga Final

-   User melakukan transfer ke salah satu rekening/QRIS yang ditampilkan
-   **PENTING**: Nominal transfer HARUS SESUAI dengan harga final yang ditampilkan
-   Misal: Jika harga final Rp 500.000, maka transfer harus Rp 500.000 (tidak kurang, tidak lebih)
-   Tips: User disarankan menuliskan kode registrasi (misal MCE-20250101-ABC123) di deskripsi transfer

### 8. User WAJIB Upload Bukti Pembayaran

-   Setelah transfer, user **HARUS** upload bukti pembayaran
-   Form yang perlu diisi:
    -   ✅ **Metode Pembayaran**: Pilih dari 3 opsi (Bank Transfer, QRIS, Lainnya)
    -   ✅ **Screenshot/Foto Bukti**: Upload file bukti (JPG, PNG, PDF, max 5MB)
    -   ✅ **Catatan** (opsional): Tambahan informasi
-   **KHUSUS PAKET BUNDLE**: Harus isi data semua peserta:
    -   Nama Lengkap peserta (Wajib)
    -   Asal Sekolah (Opsional)
-   Klik "Upload Bukti Pembayaran"

### 9. Status Update: MENUNGGU VERIFIKASI

Setelah user upload bukti, sistem otomatis:

-   Update `payment_status` = "paid" (Sudah Bayar)
-   Update `verification_status` = "pending" (Menunggu Verifikasi)
-   Increment quota paket: `ticket_packages.sold += quantity`
-   Tampil pesan: **"Bukti pembayaran berhasil dikirim! Tunggu verifikasi admin."**

### 10. Admin Lihat dan Verifikasi Pembayaran

-   Admin membuka `/admin/registrations` (Menu Dashboard → Kelola Registrasi)
-   Filter Status: **"Perlu Verifikasi"** untuk melihat pembayaran yang menunggu verifikasi
-   Klik tombol "Lihat" (mata) atau klik nama untuk buka detail
-   Halaman detail menampilkan:
    -   Info peserta (nama, email, sekolah, kelas)
    -   Info tiket (paket, jumlah, total harga)
    -   **Bukti Pembayaran**: Preview gambar bukti transfer
    -   Tombol Aksi: ✓ Verifikasi | ✗ Tolak

### 11. Admin Memverifikasi Pembayaran

-   Admin lihat bukti pembayaran
-   Validasi:
    -   ✓ Nominal transfer sesuai dengan harga (respecting diskon)
    -   ✓ Nama rekening tujuan sesuai
    -   ✓ Kode registrasi terlihat di deskripsi (jika ada)
-   **Klik tombol "✓ Verifikasi"**
-   Sistem update:
    -   `verification_status` = "verified" (Terverifikasi)
    -   `verified_at` = now()
-   Halaman berubah, status berubah menjadi **"Terverifikasi"**

### 12. Admin Menolak Pembayaran

-   Jika bukti tidak valid, admin klik **"✗ Tolak"**
-   Sistem update:
    -   `verification_status` = "rejected" (Ditolak)
-   Opsional: Admin bisa masukkan alasan penolakan di field "payment_notes"
-   User akan melihat status pembayaran berubah menjadi "Ditolak"

### 13. Admin Generate QR Code Tiket

**Syarat**: Registrasi harus sudah terverifikasi (`verification_status = 'verified'`)

-   Admin lihat registrasi yang sudah terverifikasi
-   Pada halaman list `/admin/registrations`:
    -   Filter Status: **"Terverifikasi"** untuk melihat registrasi yang sudah diverifikasi
    -   Tombol aksi: 🎫 (Generate Tiket & QR Code)
-   Atau di halaman detail registrasi:
    -   Tombol "🎫" untuk Generate Tiket & QR Code
-   Sistem akan:
    -   Generate unique barcode (misal: MCE2026-XXXXX)
    -   Buat QR Code payload dengan data:
        -   Barcode
        -   Nama peserta
        -   Sekolah
        -   Paket tiket
        -   Tanggal verifikasi
    -   Simpan QR Code ke storage (SVG format)
    -   Update registration:
        -   `barcode` = barcode yang di-generate
        -   `qr_code_path` = path ke file QR code
-   **KHUSUS PAKET BUNDLE**: Generate QR code untuk SETIAP peserta dengan data masing-masing

### 14. User Lihat dan Download Tiket

-   User membuka `/tiket` atau `/tiket/pembayaran/{registration_id}`
-   Status sudah berubah menjadi **"Tiket Sudah Disiapkan"**
-   User bisa klik "Preview Tiket" atau "Download Tiket"
-   Halaman menampilkan:
    -   ✅ Nama peserta
    -   ✅ Sekolah
    -   ✅ Paket tiket
    -   ✅ **QR Code** yang bisa di-scan
    -   ✅ Barcode/kode referensi
-   User bisa download tiket sebagai PDF

### 15. User Gunakan QR Code untuk Registrasi Saat Acara

-   User datang ke lokasi acara
-   Buka QR Code di halaman tiket mereka (atau print tiket)
-   Panitia scan QR Code dengan perangkat scan
-   Sistem update: `is_checked_in` = true, `checked_in_at` = now()
-   User berhasil check-in dan bisa masuk acara

---

## Status Payment dan Verification

### Payment Status

-   **pending**: User belum upload bukti pembayaran
-   **paid**: User sudah upload bukti, menunggu verifikasi admin

### Verification Status

-   **pending**: Menunggu verifikasi pembayaran oleh admin
-   **verified**: Pembayaran sudah diverifikasi, menunggu admin generate QR code
-   **rejected**: Pembayaran ditolak oleh admin

### Alur Status:

```
pending (payment)
    ↓
Upload bukti pembayaran
    ↓
paid (payment) + pending (verification)
    ↓
Admin verifikasi
    ↓
verified (verification)
    ↓
Admin generate QR code
    ↓
User dapat tiket dengan QR code
```

---

## Fitur Diskon - Detail Teknis

### Model DiscountCode

-   `code`: Kode diskon (unique, case-insensitive)
-   `discount_percentage`: Persentase diskon (1-100)
-   `description`: Deskripsi opsional
-   `valid_from`: Tanggal mulai berlaku
-   `valid_until`: Tanggal berakhir (nullable)
-   `usage_limit`: Batas penggunaan (nullable)
-   `used_count`: Counter penggunaan
-   `is_active`: Status aktif/nonaktif

### Method Validasi Diskon

-   `isValid()`: Validasi apakah kode bisa digunakan
    -   Harus `is_active = true`
    -   Harus dalam periode berlaku (valid_from s/d valid_until)
    -   Belum melebihi usage_limit
-   `getDiscountAmount($price)`: Hitung nominal diskon
-   `getFinalPrice($price)`: Hitung harga setelah diskon

### Saat User Apply Diskon

1. User input kode di form "Masukkan Kode Diskon"
2. Klik "Cek Kode" → Sistem validasi
3. Jika valid, tampil:
    - Harga normal
    - Nominal diskon
    - Harga final
4. Klik "Terapkan Diskon" → Update registration

### Saat Upload Bukti Pembayaran

-   Diskon tidak bisa diubah lagi
-   User harus transfer sesuai harga final (sudah dipotong diskon)
-   Admin verifikasi berdasarkan harga final

---

## Checklist Implementasi

### Admin Features ✅

-   [x] Kelola Kode Diskon (CRUD)
    -   [x] List diskon dengan status
    -   [x] Create diskon baru
    -   [x] Edit diskon
    -   [x] Delete diskon
-   [x] Verifikasi Pembayaran
    -   [x] List registrasi filter "Perlu Verifikasi"
    -   [x] Lihat detail registrasi + bukti pembayaran
    -   [x] Verifikasi pembayaran ✓
    -   [x] Tolak pembayaran ✗
-   [x] Generate QR Code Tiket
    -   [x] Tombol Generate di list registrasi yang terverifikasi
    -   [x] Tombol Generate di halaman detail registrasi
    -   [x] Generate untuk single tiket
    -   [x] Generate untuk bundle tiket

### User Features ✅

-   [x] Lihat Paket Tiket
-   [x] Checkout & Checkout Tiket
-   [x] Input Kode Diskon (sebelum upload bukti)
-   [x] Upload Bukti Pembayaran (WAJIB)
-   [x] Lihat Status Pembayaran
-   [x] Lihat QR Code Tiket (setelah admin generate)
-   [x] Download Tiket

### Views Updated ✅

-   [x] Admin discount-codes index (list diskon)
-   [x] Admin discount-codes create (buat diskon)
-   [x] Admin discount-codes edit (edit diskon)
-   [x] Admin registrations index (list registrasi dengan filter)
-   [x] Admin registrations show (detail + aksi verifikasi/tolak + generate QR)
-   [x] User tickets payment (view pembayaran + diskon + bukti upload)
-   [x] User tickets index (list tiket user + status)

---

## Testing Checklist

### Test Case 1: Pembayaran Tanpa Diskon

1. User pilih paket normal (Rp 1.000.000)
2. Checkout
3. Lihat halaman pembayaran, harga normal
4. Upload bukti pembayaran
5. Status: paid + pending
6. Admin verifikasi
7. Admin generate QR
8. User lihat tiket dengan QR code ✅

### Test Case 2: Pembayaran Dengan Diskon

1. Admin buat kode diskon `MCE50` (50%)
2. User pilih paket normal (Rp 1.000.000)
3. Checkout
4. Di halaman pembayaran, input kode `MCE50`
5. Harga berubah menjadi Rp 500.000
6. Terapkan diskon
7. Cek kode diskon di registration sudah update (discount_percentage=50, total_amount=500000)
8. Upload bukti pembayaran (transfer Rp 500.000)
9. Admin verifikasi sesuai harga final (Rp 500.000)
10. Admin generate QR
11. User lihat tiket ✅

### Test Case 3: Bundle Tiket

1. User pilih paket bundle (untuk 3 peserta)
2. Checkout
3. Lihat halaman pembayaran
4. Upload bukti pembayaran
5. **WAJIB isi data 3 peserta** (nama + sekolah)
6. Admin verifikasi
7. Admin generate QR → **Generate untuk 3 peserta** (3 QR code berbeda)
8. User lihat 3 tiket dengan QR code masing-masing ✅

### Test Case 4: Pembayaran Ditolak

1. User upload bukti dengan nominal salah (kurang)
2. Admin lihat bukti, klik "Tolak"
3. Status berubah menjadi "Ditolak"
4. User lihat status pembayaran "Ditolak"
5. User harus upload bukti lagi (sistem belum support ini, perlu request ulang) ⚠️

---

## Known Issues & Future Improvements

1. Jika user pembayaran ditolak, belum ada fitur untuk re-upload bukti
2. Bonus: Harganya belum ada validasi untuk "nominal harus exact" (bisa kurang/lebih)
3. Bonus: Admin belum bisa buat perubahan harga langsung dari dashboard
4. Bonus: Notifikasi email belum diimplementasi
