# MCE 2026 - STEP-BY-STEP TESTING GUIDE

## 1. LOGIN SEBAGAI PESERTA

-   URL: http://127.0.0.1:8000/login
-   Email: peserta@example.com (atau buat user baru)
-   Password: password

## 2. KE DASHBOARD

-   URL: http://127.0.0.1:8000/dashboard
-   Lihat "Beli Tiket Baru" button

## 3. PILIH PAKET TIKET

-   URL: http://127.0.0.1:8000/tiket/pilih-paket
-   Lihat paket-paket yang tersedia
-   **PENTING:** Sekarang sudah ada dropdown "Jumlah Tiket" ✓
-   Pilih paket dan jumlah, lalu klik "Beli Sekarang"

## 4. PAYMENT PAGE

-   Setelah klik "Beli Sekarang", akan redirect ke halaman pembayaran
-   URL: http://127.0.0.1:8000/tiket/pembayaran/{registration_id}
-   Lihat detail registrasi dan instruksi pembayaran

## CHECKLIST:

-   [ ] Bisa login
-   [ ] Bisa masuk ke dashboard
-   [ ] Bisa akses halaman pilih paket
-   [ ] Ada dropdown jumlah tiket
-   [ ] Bisa klik "Beli Sekarang"
-   [ ] Redirect ke payment page
-   [ ] Lihat kode registrasi
-   [ ] Lihat total pembayaran

## JIKA ADA ERROR:

1. Cek browser console (F12)
2. Cek Laravel logs: `storage/logs/laravel.log`
3. Check PHP error: `php artisan config:cache` then restart server
