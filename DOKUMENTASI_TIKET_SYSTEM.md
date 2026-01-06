# 📋 DOKUMENTASI SISTEM PEMBELIAN TIKET MCE 2026

## 🎯 ALUR SISTEM (Flow Chart)

```
┌─────────────────────────────────────────────────────────────────┐
│                     PESERTA (USER)                              │
└─────────────────────────────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────┐
       │  1. Dashboard Peserta (status overview)  │
       └──────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────┐
       │  2. Tiket Saya (view existing tickets)   │
       │     - Show: Kode, Paket, Status, QR Code │
       └──────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────────────────────┐
       │  3. Beli Tiket Baru (+ button)                           │
       │     - Select Package (single atau bundle)                │
       │     - Choose Quantity                                    │
       │     - Click: "Beli Sekarang"                             │
       │     → STATUS: PENDING (belum bayar)                      │
       │     → QUOTA: TIDAK BERKURANG YET !!!                    │
       └──────────────────────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────────────────────┐
       │  4. Payment Page (informasi pembayaran)                  │
       │     - Bank Transfer Details (BCA, Mandiri, BRI)          │
       │     - QRIS / E-Wallet Option                            │
       │     - Form Upload Bukti Pembayaran (WAJIB)               │
       │     - For Bundle: Input Peserta 1, 2, 3                  │
       │     - Click: "Kirim Bukti Pembayaran"                    │
       │     → STATUS: PAID (tapi belum verified)                 │
       │     → QUOTA: BERKURANG di sini !!!                       │
       │     → Message: "Bukti pembayaran terkirim, tunggu verif"│
       └──────────────────────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────────────────────┐
       │  5. Back to "Tiket Saya"                                │
       │     - Show: Menunggu Verifikasi                          │
       │     - Cannot re-upload                                   │
       │     - Wait for Admin verification                        │
       └──────────────────────────────────────────────────────────┘
                              ↓
                     ADMIN VERIFICATION
                              ↓
       ┌──────────────────────────────────────────────────────────┐
       │  Admin Panel:                                            │
       │  - View all registrations with payment proofs            │
       │  - Review uploaded payment proof                         │
       │  - Click: "Verifikasi" atau "Tolak"                     │
       │  - On Verify: Generate QR Code                           │
       │  → STATUS: VERIFIED                                     │
       │  → QR Code generated & stored                            │
       │  → Send notification to user                             │
       └──────────────────────────────────────────────────────────┘
                              ↓
       ┌──────────────────────────────────────────────────────────┐
       │  6. Download E-Ticket                                   │
       │     - Show: Tiket dengan QR Code                        │
       │     - QR contains: Nama, Paket, Sekolah                  │
       │     - For Check-in scanning                              │
       └──────────────────────────────────────────────────────────┘
```

## 📊 DATABASE SCHEMA UPDATES

### registrations table (NEW FIELDS)

```sql
ALTER TABLE registrations ADD COLUMN verification_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending';
ALTER TABLE registrations ADD COLUMN quantity INT DEFAULT 1;
ALTER TABLE registrations ADD COLUMN bundle_participants JSON NULL;
ALTER TABLE registrations ADD COLUMN payment_notes TEXT NULL;
ALTER TABLE registrations ADD COLUMN verified_at TIMESTAMP NULL;
ALTER TABLE registrations ADD COLUMN qr_code_path VARCHAR(255) NULL;
```

### ticket_packages table (NEW FIELDS)

```sql
ALTER TABLE ticket_packages ADD COLUMN is_bundle BOOLEAN DEFAULT FALSE;
ALTER TABLE ticket_packages ADD COLUMN bundle_size INT DEFAULT 1;
```

## 🔄 STATUS FLOW

```
User Journey:
PENDING → PAID → VERIFIED → E-TICKET READY

PENDING:
  - Registrasi baru dibuat
  - Belum upload bukti pembayaran
  - QUOTA: masih penuh

PAID:
  - User sudah upload bukti pembayaran
  - Admin belum verify
  - QUOTA: sudah berkurang
  - status: "Menunggu Verifikasi"

VERIFIED:
  - Admin verified pembayaran
  - QR Code generated
  - E-Ticket ready untuk download
  - status: "Terverifikasi"

REJECTED (optional):
  - Admin reject pembayaran (bukti salah, dll)
  - QUOTA: dikembalikan (decrement)
  - User bisa re-upload ulang
```

## 🎫 BUNDLE PACKAGE LOGIC

Untuk paket BUNDLE (eg. "Tiket Rombongan 3 Peserta"):

### Saat Checkout:

-   User beli 1x bundle package
-   quantity = 1 (tapi untuk 3 orang)
-   total_amount = harga_bundle (misal Rp 300.000 untuk 3 orang)

### Saat Upload Proof:

-   WAJIB input: Peserta 1, Peserta 2, Peserta 3
-   Data disimpan di: bundle_participants (JSON)

```json
[
    {
        "number": 1,
        "name": "Andi Wijaya",
        "school": "SMA Negeri 1 Magetan"
    },
    {
        "number": 2,
        "name": "Budi Santoso",
        "school": "SMA Negeri 2 Magetan"
    },
    {
        "number": 3,
        "name": "Citra Dewi",
        "school": "SMA Swasta Magetan"
    }
]
```

### Saat Generate E-Ticket:

-   Generate 3 QR Codes (satu untuk setiap peserta)
-   Setiap QR berisi data peserta individual
-   Untuk check-in, scan QR peserta yang datang

## 📱 QR CODE CONTENT

```json
{
    "code": "MCE-20241218-ABC123",
    "name": "Andi Wijaya",
    "package": "Tiket Rombongan",
    "school": "SMA Negeri 1 Magetan",
    "verified_at": "2024-12-18 14:30:00"
}
```

## 🔐 ADMIN PANEL SECURITY

### Authentication:

-   Must have role 'admin' (check in User model)
-   Middleware: `['auth', 'admin']`
-   All actions logged to database/file

### Permissions:

-   View all registrations
-   View payment proofs (images/PDFs)
-   Approve/Reject payments
-   Generate QR codes
-   Download reports

### Audit Trail:

-   Log who verified what, when
-   Log rejection reasons
-   Track all admin actions

## 📁 FILE STRUCTURE

```
app/
├── Http/Controllers/
│   ├── User/
│   │   ├── DashboardController.php ✅ (UPDATED)
│   │   └── TicketController.php ✅ (UPDATED - CORE LOGIC)
│   └── Admin/
│       └── RegistrationController.php ⚠️ (NEEDS FULL IMPLEMENTATION)
│
└── Models/
    ├── User.php (add: public function registrations())
    ├── Registration.php ✅ (UPDATED)
    └── TicketPackage.php ✅ (UPDATED)

resources/views/
├── user/
│   ├── dashboard.blade.php ✅ (CREATED)
│   └── tickets/
│       ├── index.blade.php ⚠️ (NEEDS UPDATE)
│       ├── select.blade.php ⚠️ (NEEDS CREATE)
│       └── payment.blade.php ⚠️ (NEEDS UPDATE FOR BUNDLE)
│
└── admin/
    └── registrations/
        ├── index.blade.php ⚠️ (NEEDS CREATE)
        └── show.blade.php ⚠️ (NEEDS CREATE)

database/migrations/
├── 2025_12_18_120000_add_fields_to_registrations_table.php ✅
└── 2025_12_18_add_bundle_fields_to_ticket_packages.php ✅
```

## ✅ CHECKLIST IMPLEMENTASI

### Phase 1: Core Models & Controllers ✅

-   [x] Update Registration model
-   [x] Update TicketPackage model
-   [x] Update User model (add relationships)
-   [x] Update TicketController with correct logic
-   [x] Update DashboardController
-   [x] Database migrations

### Phase 2: User Views (PRIORITY)

-   [ ] Create/Update `user/dashboard.blade.php` - statistics, recent tickets
-   [ ] Create/Update `user/tickets/index.blade.php` - list all tickets with status
-   [ ] Create `user/tickets/select.blade.php` - package selection
-   [ ] Update `user/tickets/payment.blade.php` - payment with bundle support

### Phase 3: Admin Views & Controllers (PRIORITY)

-   [ ] Create `admin/registrations/index.blade.php` - list all registrations
-   [ ] Create `admin/registrations/show.blade.php` - detail view with payment proof
-   [ ] Implement `RegistrationController@verify()` - verify & generate QR
-   [ ] Implement `RegistrationController@reject()` - reject payment

### Phase 4: Advanced Features

-   [ ] QR Code generation & storage
-   [ ] E-Ticket PDF generation
-   [ ] Email notifications
-   [ ] SMS notifications (optional)
-   [ ] Check-in scanning system
-   [ ] Reports & Analytics

## 🚀 TESTING CHECKLIST

### User Flow:

-   [ ] Register → Select Package → Proceed to Payment
-   [ ] Upload Payment Proof → Show "Menunggu Verifikasi"
-   [ ] Admin Verify → QR Code Generated
-   [ ] Download E-Ticket → Show QR Code

### Bundle Flow:

-   [ ] Select Bundle Package
-   [ ] On Payment: Can input 3 participants
-   [ ] On Verify: Generate 3 QR codes
-   [ ] Each QR has individual participant data

### Quota System:

-   [ ] Quota not decreased at checkout
-   [ ] Quota decreased after payment proof upload
-   [ ] Quota restored if payment rejected

### Admin:

-   [ ] Can see all pending verifications
-   [ ] Can view payment proof images
-   [ ] Can approve/reject
-   [ ] Audit trail logged

## 📝 NOTES UNTUK DEVELOPER

### Key Points:

1. **QUOTA TIMING**: Sangat penting! Kuota hanya berkurang SETELAH user upload bukti pembayaran, bukan saat klik "Beli".

2. **VERIFICATION FLOW**:

    - User upload bukti → `payment_status = 'paid'`, `verification_status = 'pending'`
    - Admin verify → `verification_status = 'verified'`, generate QR code
    - Admin reject → `verification_status = 'rejected'`, kuota dikembalikan

3. **BUNDLE LOGIC**:

    - Jika `is_bundle = true`, force input peserta di payment form
    - Store sebagai JSON di `bundle_participants`
    - Generate multiple QR codes (satu per peserta)

4. **SECURITY**:

    - Verify user ownership sebelum edit/download
    - Log semua admin actions
    - Validate file uploads (size, type)
    - CSRF protection on forms

5. **UX MESSAGES**:
    - After "Beli Sekarang": "Registrasi berhasil. Lakukan pembayaran sekarang."
    - After "Kirim Bukti": "Bukti pembayaran berhasil dikirim, tunggu verifikasi admin."
    - After Admin Verify: "Tiket Anda terverifikasi! Download e-ticket sekarang."

## 📚 DEPENDENCIES

-   `simpleSoftwareIO/simple-qrcode` - QR code generation
-   `laravel/tinker` - CLI debugging
-   `barryvdh/laravel-dompdf` (optional) - PDF generation for e-tickets

## 🔗 ROUTES (Already in web.php)

```php
// User
Route::get('/tiket', [TicketController::class, 'index'])->name('user.tickets.index');
Route::get('/tiket/pilih-paket', [TicketController::class, 'selectPackage'])->name('user.tickets.select');
Route::post('/tiket/checkout', [TicketController::class, 'checkout'])->name('user.tickets.checkout');
Route::get('/tiket/pembayaran/{registration}', [TicketController::class, 'payment'])->name('user.tickets.payment');
Route::post('/tiket/upload-bukti/{registration}', [TicketController::class, 'uploadProof'])->name('user.tickets.upload');
Route::get('/tiket/download/{registration}', [TicketController::class, 'download'])->name('user.tickets.download');

// Admin
Route::get('/admin/registrations', [RegistrationController::class, 'index'])->name('admin.registrations.index');
Route::get('/admin/registrations/{registration}', [RegistrationController::class, 'show'])->name('admin.registrations.show');
Route::post('/admin/registrations/{registration}/verify', [RegistrationController::class, 'verify'])->name('admin.registrations.verify');
Route::post('/admin/registrations/{registration}/reject', [RegistrationController::class, 'reject'])->name('admin.registrations.reject');
```

---

**Last Updated**: 18 Desember 2024
**Status**: Phase 1-2 In Progress
**Next Steps**: Implement Phase 2 & 3 views
