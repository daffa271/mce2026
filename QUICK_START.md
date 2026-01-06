# 🚀 QUICK START - SISTEM TIKET MCE 2026

## ✅ STATUS IMPLEMENTASI SAAT INI (18 Desember 2024)

```
[████████████░░░░░░░░░░░░] 60% - Core Implementation
[██████░░░░░░░░░░░░░░░░░░] 30% - Admin Panel
[██░░░░░░░░░░░░░░░░░░░░░░] 10% - QR Code & E-Ticket
```

### ✅ Sudah Selesai:

-   [x] Database schema dengan fields lengkap
-   [x] Registration & TicketPackage models updated
-   [x] TicketController dengan logic yang benar
-   [x] DashboardController
-   [x] Payment page dengan bundle participants form
-   [x] Migration & database setup

### 🟡 In Progress:

-   [ ] Admin panel views (registration list & detail)
-   [ ] Admin controller untuk verify/reject
-   [ ] QR code generation & display
-   [ ] E-ticket PDF generation
-   [ ] Email notifications

---

## 🔧 HOW TO SET UP & TEST

### 1. Start Laravel Development Server

```bash
cd c:\xampp2\htdocs\mce2026
php artisan serve
```

Server akan berjalan di: `http://127.0.0.1:8000`

### 2. Create Test Data

Buka terminal Laravel dan jalankan:

```bash
php artisan tinker
```

Copy-paste code ini untuk membuat data test:

```php
// Buat test user (peserta)
$user = User::factory()->create([
    'name' => 'Andi Wijaya',
    'email' => 'andi@test.com',
    'password' => bcrypt('password123'),
]);

// Buat paket tiket (regular)
$package1 = TicketPackage::create([
    'name' => 'Tiket Umum',
    'price' => 50000,
    'description' => 'Tiket masuk ke lokasi MCE 2026',
    'benefits' => ['Akses ke semua booth', 'Merchandise MCE', 'Goodiebag'],
    'quota' => 100,
    'sold' => 0,
    'is_active' => true,
    'is_bundle' => false,
    'bundle_size' => 1,
    'valid_from' => now(),
    'valid_until' => now()->addMonths(3),
]);

// Buat paket tiket (bundle)
$package2 = TicketPackage::create([
    'name' => 'Tiket Rombongan 3 Peserta',
    'price' => 120000,  // Rp 40.000 per peserta
    'description' => 'Paket hemat untuk rombongan 3 peserta dari sekolah yang sama',
    'benefits' => ['Akses ke semua booth', 'Merchandise MCE', 'Goodiebag', 'Diskon untuk rombongan'],
    'quota' => 50,
    'sold' => 0,
    'is_active' => true,
    'is_bundle' => true,
    'bundle_size' => 3,
    'valid_from' => now(),
    'valid_until' => now()->addMonths(3),
]);

// Buat admin user
$admin = User::factory()->create([
    'name' => 'Admin MCE',
    'email' => 'admin@mce2026.com',
    'password' => bcrypt('admin123'),
    'role' => 'admin',  // Pastikan User model punya field 'role'
]);

echo "✅ Test data created successfully!";
exit;
```

### 3. Test User Flow (Peserta)

#### Step 1: Login

-   Buka: `http://127.0.0.1:8000/login`
-   Email: `andi@test.com`
-   Password: `password123`

#### Step 2: Go to Dashboard

-   Should see: Dashboard dengan statistics
-   Should see: Recent registrations (empty)
-   Click: "Beli Tiket Baru"

#### Step 3: Select Package

-   Buka: `/tiket/pilih-paket`
-   See: Kedua paket (Tiket Umum dan Rombongan)
-   Click: "Beli Sekarang" pada "Tiket Umum"
-   Quantity: Pilih 2

#### Step 4: Check Database BEFORE Payment Upload

```php
$registration = Registration::latest()->first();
dd($registration);
// EXPECTED:
// - payment_status = 'pending'
// - verification_status = 'pending'
// - ticketPackage.sold = 0 (BELUM BERKURANG!)
```

#### Step 5: Payment Page

-   Should see: "Registrasi berhasil! Silakan lakukan pembayaran sekarang."
-   Fill payment form:
    -   Payment method: "Bank Transfer"
    -   Upload dummy image (pakai screenshot apapun)
    -   Notes: "Test payment"
-   Click: "Kirim Bukti Pembayaran"

#### Step 6: Check Database AFTER Payment Upload

```php
$registration = Registration::latest()->first();
$package = $registration->ticketPackage;

dd([
    'payment_status' => $registration->payment_status,  // 'paid'
    'verification_status' => $registration->verification_status,  // 'pending'
    'package_sold' => $package->sold,  // 2 (SUDAH BERKURANG!)
    'payment_notes' => $registration->payment_notes,  // "Test payment"
]);
```

#### Step 7: Back to "Tiket Saya"

-   Should see: Status "Menunggu Verifikasi"
-   Should see: Timeline dengan step Pembayaran = ✓
-   Should NOT see: Download button (belum verified)

---

### 4. Test Admin Flow (Admin)

#### Admin Login

-   Email: `admin@mce2026.com`
-   Password: `admin123`

#### View Registrations (TODO: Implement)

-   Buka: `/admin/registrations`
-   Should see: List semua registrations
    -   Kode registrasi
    -   Nama peserta
    -   Status pembayaran
    -   Status verifikasi
    -   Action buttons

#### View Detail & Verify

-   Click "View" pada registration
-   Should see:
    -   Full registration details
    -   Payment proof image (viewing)
    -   Verify/Reject buttons
-   Click "Verify"
-   Should see:
    -   QR code generated
    -   Status changed to "Verified"
    -   Timestamp recorded

#### Back to User View

-   User kembali ke `/tiket`
-   Should see:
    -   Status: "Terverifikasi"
    -   Timeline lengkap dengan ✓
    -   Download button available

---

## 🧪 TESTING CHECKLIST

### User Purchase Flow:

-   [ ] Can see packages di `/tiket/pilih-paket`
-   [ ] Can click "Beli Sekarang"
-   [ ] Redirected to payment page dengan message
-   [ ] Payment form visible
-   [ ] Can upload payment proof
-   [ ] Quota decreased after upload (NOT at checkout)
-   [ ] Status changed to "Menunggu Verifikasi"

### Bundle Flow:

-   [ ] Bundle package visible
-   [ ] Can select bundle
-   [ ] Payment page shows participant form
-   [ ] Can input 3 participant names & schools
-   [ ] Form validation works
-   [ ] Data saved to `bundle_participants` JSON

### Admin Verification:

-   [ ] Admin can see list
-   [ ] Admin can view detail
-   [ ] Admin can see payment proof
-   [ ] Can click Verify
-   [ ] QR code generated
-   [ ] User status updated
-   [ ] User gets notification

### Quota System:

-   [ ] Quota NOT decreased at checkout
-   [ ] Quota decreased after payment upload ✓
-   [ ] Quota restored if rejected
-   [ ] Quota display updated in real-time

---

## 📁 FILES YANG SUDAH DIUPDATE

```
✅ MODELS
  └── app/Models/Registration.php
  └── app/Models/TicketPackage.php

✅ CONTROLLERS
  ├── app/Http/Controllers/User/DashboardController.php
  └── app/Http/Controllers/User/TicketController.php

✅ VIEWS
  ├── resources/views/user/dashboard.blade.php (PERLU MINOR UPDATE)
  ├── resources/views/user/tickets/select.blade.php (PERLU UPDATE)
  ├── resources/views/user/tickets/index.blade.php (PERLU UPDATE)
  └── resources/views/user/tickets/payment.blade.php ✅ (UPDATED - Bundle form added)

✅ MIGRATIONS
  ├── database/migrations/2025_12_18_120000_add_fields_to_registrations_table.php
  └── database/migrations/2025_12_18_add_bundle_fields_to_ticket_packages.php

📋 DOCUMENTATION
  ├── DOKUMENTASI_TIKET_SYSTEM.md
  ├── IMPLEMENTASI_PROGRESS.md
  └── QUICK_START.md (THIS FILE)
```

---

## 🔴 CRITICAL TODO (Prioritas Tinggi)

### 1. ADMIN REGISTRATION INDEX (1-2 jam)

**File**: Create `resources/views/admin/registrations/index.blade.php`
**Fungsi**:

-   List semua registrations
-   Filter by status
-   View details button
-   Stats cards

### 2. ADMIN REGISTRATION SHOW (1-2 jam)

**File**: Create `resources/views/admin/registrations/show.blade.php`
**Fungsi**:

-   Show registration details
-   Display payment proof image
-   Verify/Reject buttons
-   Admin notes

### 3. ADMIN CONTROLLER (1 jam)

**File**: Update `app/Http/Controllers/Admin/RegistrationController.php`
**Fungsi**:

-   Implement `index()` - list registrations
-   Implement `show()` - detail view
-   Implement `verify()` - generate QR & update status
-   Implement `reject()` - reject & restore quota

### 4. QR CODE GENERATION (1 jam)

**In**: `TicketController@uploadProof()` or `RegistrationController@verify()`
**Lib**: `SimpleSoftwareIO\QrCode\Facades\QrCode`
**Generate**: SVG file dengan JSON content

```php
$qrContent = json_encode([
    'code' => $registration->registration_code,
    'name' => $registration->name,
    'package' => $registration->ticketPackage->name,
    'school' => $registration->school,
]);

$qrCode = QrCode::format('svg')->size(300)->generate($qrContent);
Storage::disk('public')->put("qrcodes/{$registration->id}.svg", $qrCode);
```

### 5. E-TICKET PDF (2-3 jam)

**Lib**: Use `barryvdh/laravel-dompdf`
**Fungsi**: Generate PDF ticket dengan:

-   Registration code
-   Participant name
-   Package name
-   School/Grade
-   QR code embedded
-   Valid from/until dates

---

## 📊 DATABASE STRUCTURE VERIFICATION

Run di tinker:

```php
// Check registrations table columns
Schema::getColumnListing('registrations');

// Check ticket_packages table columns
Schema::getColumnListing('ticket_packages');

// Test create registration
Registration::create([
    'user_id' => 1,
    'ticket_package_id' => 1,
    'registration_code' => 'MCE-TEST-001',
    'name' => 'Test User',
    'email' => 'test@test.com',
    'total_amount' => 50000,
    'quantity' => 1,
]);

// Verify data saved
Registration::latest()->first();
```

---

## 🔗 USEFUL LINKS

-   Dashboard: `http://127.0.0.1:8000/dashboard`
-   Buy Ticket: `http://127.0.0.1:8000/tiket/pilih-paket`
-   My Tickets: `http://127.0.0.1:8000/tiket`
-   Admin: `http://127.0.0.1:8000/admin/dashboard`
-   Tinker: `php artisan tinker`

---

## 💾 DATABASE BACKUP (Optional)

```bash
# Export
php artisan db:export

# Import
php artisan db:import

# Fresh
php artisan migrate:fresh --seed
```

---

## 🐛 TROUBLESHOOTING

### "Class not found" error

```bash
php artisan config:cache
php artisan optimize
```

### Payment form not showing

-   Check: `$registration->ticketPackage` relationship
-   Check: Payment method select dropdown

### Quota not decreasing

-   Verify: `TicketController::uploadProof()` calls `increment('sold')`
-   Check: `ticketPackage` relationship loaded

### QR Code not generating

-   Install: `SimpleSoftwareIO\QrCode`
-   Check: Storage disk 'public' configured
-   Create: `storage/app/public/qrcodes` folder

### Admin can't verify

-   Check: `IsAdmin` middleware working
-   Check: Route `admin.registrations.verify` registered
-   Check: `RegistrationController@verify()` method exists

---

## 📞 SUPPORT & NEXT STEPS

**Current Status**: Core system working, admin panel pending

**Next Meeting**: Implement admin panel & QR code

**Questions?**

-   Check DOKUMENTASI_TIKET_SYSTEM.md untuk detail lengkap
-   Check IMPLEMENTASI_PROGRESS.md untuk code snippets
-   Run tests sesuai checklist di atas

---

**Last Updated**: 18 Desember 2024, 23:00 WIB
**Implementer**: GitHub Copilot
**Laravel Version**: 12.x
**PHP Version**: 8.4.x
