# Database & API Reference - MCE 2026 Tiket System

## 📊 Database Schema

### Table: `discount_codes`

Menyimpan konfigurasi kode diskon yang bisa digunakan user.

```sql
Column              | Type       | Description
--------------------|------------|---------------------------------------------
id                  | bigint     | Primary key, auto increment
code                | varchar    | Kode diskon (unique) - contoh: MCE50, MEMBER20
discount_percentage | integer    | Persentase diskon (1-100)
description         | text       | Deskripsi opsional
valid_from          | datetime   | Mulai berlaku
valid_until         | datetime   | Berakhir (nullable)
usage_limit         | integer    | Batas penggunaan (nullable = unlimited)
used_count          | integer    | Counter penggunaan saat ini
is_active           | boolean    | Status aktif/nonaktif
created_at          | datetime   | Waktu dibuat
updated_at          | datetime   | Waktu diupdate
```

### Table: `registrations` (Fields Penting untuk Diskon & Pembayaran)

```sql
Column                | Type      | Description
----------------------|-----------|---------------------------------------------
id                    | bigint    | Primary key
user_id               | bigint    | FK ke users
ticket_package_id     | bigint    | FK ke ticket_packages
discount_code_id      | bigint    | FK ke discount_codes (nullable)
registration_code     | varchar   | Unique kode registrasi
payment_status        | varchar   | pending / paid
verification_status   | varchar   | pending / verified / rejected
payment_method        | varchar   | bank_transfer / qris / other (nullable)
payment_proof         | varchar   | Path ke file bukti pembayaran (nullable)
payment_notes         | text      | Catatan pembayaran (nullable)
original_amount       | decimal   | Harga sebelum diskon
discount_percentage   | integer   | Persentase diskon yang diapply (0 jika tidak ada)
total_amount          | decimal   | Harga setelah diskon (= harga final)
paid_at               | datetime  | Waktu pembayaran (nullable)
verified_at           | datetime  | Waktu verifikasi (nullable)
barcode               | varchar   | Barcode untuk QR code (nullable)
qr_code_path          | varchar   | Path ke file QR code (nullable)
bundle_participants   | json      | Data peserta untuk bundle (nullable)
bundle_barcodes       | json      | Barcode untuk setiap peserta bundle (nullable)
is_checked_in         | boolean   | Status check-in di acara
checked_in_at         | datetime  | Waktu check-in (nullable)
created_at            | datetime  | Waktu dibuat
updated_at            | datetime  | Waktu diupdate
```

---

## 🔄 Status Flow Diagram

### Payment Status

```
┌──────────────────────────────────────────┐
│  payment_status Flow                     │
├──────────────────────────────────────────┤
│                                          │
│  pending ──────→ paid                   │
│   (awal)    (upload bukti)              │
│                                          │
│  Waktu update: UserTicketController@    │
│  uploadProof()                          │
│                                          │
└──────────────────────────────────────────┘
```

### Verification Status

```
┌──────────────────────────────────────────┐
│  verification_status Flow                │
├──────────────────────────────────────────┤
│                                          │
│  pending ──→ verified ──→ (QR generated)│
│   (upload)   (admin     (ada barcode)   │
│             verifikasi) (ready for user)│
│       ↓                                  │
│    rejected ──→ (perlu re-upload)      │
│    (admin tolak)                        │
│                                          │
└──────────────────────────────────────────┘
```

### Syarat Generate QR Code

```
verification_status === 'verified'
        AND
    (barcode === null OR barcode === '')
        ↓
   Generate QR Code
        ↓
Update: barcode & qr_code_path
```

---

## 🛣️ API Routes & Methods

### Admin Routes - Diskon

#### List Diskon

-   **Route**: `GET /admin/discount-codes`
-   **Controller**: `Admin\DiscountCodeController@index`
-   **Response**: View dengan list semua diskon
-   **Filter**: Bisa sort by created_at, is_active

#### Create Form

-   **Route**: `GET /admin/discount-codes/create`
-   **Controller**: `Admin\DiscountCodeController@create`
-   **Response**: Form view untuk create diskon

#### Store Diskon

-   **Route**: `POST /admin/discount-codes`
-   **Controller**: `Admin\DiscountCodeController@store`
-   **Parameters**:
    ```php
    'code' => 'required|string|min:3|max:20|unique:discount_codes,code'
    'discount_percentage' => 'required|integer|min:1|max:100'
    'description' => 'nullable|string'
    'valid_from' => 'required|date'
    'valid_until' => 'nullable|date|after:valid_from'
    'usage_limit' => 'nullable|integer|min:1'
    'is_active' => 'boolean' (default: false)
    ```
-   **Response**: Redirect ke index dengan pesan sukses

#### Edit Form

-   **Route**: `GET /admin/discount-codes/{discountCode}/edit`
-   **Controller**: `Admin\DiscountCodeController@edit`
-   **Response**: Form view untuk edit diskon

#### Update Diskon

-   **Route**: `PUT /admin/discount-codes/{discountCode}`
-   **Controller**: `Admin\DiscountCodeController@update`
-   **Parameters**: Sama seperti store (boleh partial)
-   **Response**: Redirect ke index dengan pesan sukses

#### Delete Diskon

-   **Route**: `DELETE /admin/discount-codes/{discountCode}`
-   **Controller**: `Admin\DiscountCodeController@destroy`
-   **Response**: Redirect ke index dengan pesan sukses

---

### Admin Routes - Registrasi

#### List Registrasi

-   **Route**: `GET /admin/registrations`
-   **Controller**: `Admin\RegistrationController@index`
-   **Query Parameters**:
    ```php
    'status' => 'pending|paid|verified|rejected' (filter)
    'search' => string (cari nama/email/kode/sekolah)
    ```
-   **Response**: View dengan list registrasi + filter

#### Detail Registrasi

-   **Route**: `GET /admin/registrations/{registration}`
-   **Controller**: `Admin\RegistrationController@show`
-   **Response**: View detail lengkap registrasi + aksi tombol

#### Verifikasi Pembayaran

-   **Route**: `POST /admin/registrations/{registration}/verify`
-   **Controller**: `Admin\RegistrationController@verify`
-   **Method**: Form submission (POST)
-   **Action**:
    1. Set `verification_status` = 'verified'
    2. Set `verified_at` = now()
    3. Redirect dengan pesan sukses
-   **Response**: Redirect ke referer dengan pesan sukses

#### Tolak Pembayaran

-   **Route**: `POST /admin/registrations/{registration}/reject`
-   **Controller**: `Admin\RegistrationController@reject`
-   **Parameters** (optional):
    ```php
    'reason' => 'string' (alasan penolakan)
    ```
-   **Action**:
    1. Set `verification_status` = 'rejected'
    2. Set `payment_notes` = reason (jika ada)
    3. Redirect dengan pesan sukses
-   **Response**: Redirect ke referer dengan pesan sukses

#### Generate QR Code Tiket

-   **Route**: `POST /admin/registrations/{registration}/ticket-verify`
-   **Controller**: `TicketController@verify`
-   **Syarat**: `verification_status` harus 'verified'
-   **Action**:
    1. Generate unique barcode
    2. Generate QR code (SVG format)
    3. Simpan ke storage/public/qrcodes/
    4. Update registration: barcode, qr_code_path
    5. Jika bundle: generate per peserta
-   **Response**: Redirect dengan pesan sukses/error

---

### User Routes - Pembayaran & Diskon

#### Pilih Paket

-   **Route**: `GET /tiket/pilih-paket`
-   **Controller**: `User\TicketController@selectPackage`
-   **Response**: View list paket tiket dengan harga normal

#### Checkout

-   **Route**: `POST /tiket/checkout`
-   **Controller**: `User\TicketController@checkout`
-   **Parameters**:
    ```php
    'ticket_package_id' => 'required|exists:ticket_packages,id'
    'quantity' => 'required|integer|min:1|max:10'
    ```
-   **Action**:
    1. Create registration dengan status:
        - `payment_status` = 'pending'
        - `verification_status` = 'pending'
    2. Set `total_amount` = harga normal (belum ada diskon)
    3. Redirect ke halaman pembayaran
-   **Response**: Redirect ke `/tiket/pembayaran/{registration_id}`

#### Halaman Pembayaran

-   **Route**: `GET /tiket/pembayaran/{registration}`
-   **Controller**: `User\TicketController@payment`
-   **Response**: View halaman pembayaran dengan:
    -   Detail registrasi & harga
    -   Form input diskon
    -   Bank transfer info
    -   Form upload bukti pembayaran

#### Apply Diskon

-   **Route**: `POST /tiket/{registration}/apply-discount`
-   **Controller**: `User\TicketController@applyDiscount`
-   **Parameters**:
    ```php
    'code' => 'required|string' (misal: MCE50)
    ```
-   **Validasi Diskon**:
    1. Kode harus ada di database
    2. `is_active` harus true
    3. Harus dalam periode: `valid_from` ≤ now ≤ `valid_until`
    4. Belum melebihi `usage_limit`
-   **Action** (jika valid):
    1. Hitung final price: `original_price * (1 - discount_percentage/100)`
    2. Update registration:
        - `discount_code_id` = code.id
        - `discount_percentage` = code.discount_percentage
        - `original_amount` = harga normal
        - `total_amount` = final price (yang dipotong)
    3. Increment `used_count` di discount_codes
-   **Response**: Redirect ke payment dengan pesan sukses/error

#### Upload Bukti Pembayaran

-   **Route**: `POST /tiket/upload-bukti/{registration}`
-   **Controller**: `User\TicketController@uploadProof`
-   **Parameters**:
    ```php
    'payment_method' => 'required|in:bank_transfer,qris,other'
    'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120'
    'payment_notes' => 'nullable|string|max:500'
    // Untuk bundle:
    'participant_1_name' => 'required|string'
    'participant_1_school' => 'nullable|string'
    'participant_2_name' => 'required|string'
    // ... dst sesuai bundle_size
    ```
-   **Validasi**:
    1. File harus valid image/pdf, max 5MB
    2. User harus milik registration ini
    3. Belum di-upload sebelumnya
    4. Untuk bundle: semua peserta harus diisi
-   **Action**:
    1. Upload file ke storage/public/payment_proofs/{user_id}/
    2. Update registration:
        - `payment_status` = 'paid'
        - `payment_method` = method pilihan
        - `payment_proof` = path ke file
        - `payment_notes` = catatan (jika ada)
        - `bundle_participants` = array peserta (jika bundle)
        - `paid_at` = now()
    3. Increment `sold` di ticket_packages: `+= quantity`
-   **Response**: Redirect ke payment dengan pesan sukses/error

#### Download Tiket

-   **Route**: `GET /tiket/download/{registration}`
-   **Controller**: `User\TicketController@download`
-   **Syarat**: Registration harus `verification_status` = 'verified'
-   **Response**: PDF file tiket dengan QR code (belum fully implemented)

---

## 🔐 Authorization & Permissions

### Admin-Only Routes

-   Semua `/admin/*` routes protected dengan middleware `['auth', 'admin']`
-   User harus login dan punya role 'admin'

### User Routes

-   Semua `/tiket/*` dan `/my-ticket/*` protected dengan middleware `['auth', 'user']`
-   User hanya bisa akses registrasi milik mereka sendiri (di-check di controller)

### Guest Routes

-   Halaman paket preview tidak perlu login
-   Feedback umum bisa dari guest (tidak perlu login)

---

## 💾 Model Methods & Relations

### DiscountCode Model

```php
// Relations
// Tidak ada (diskon berdiri sendiri)

// Scopes
// Belum ada scope khusus

// Methods
public function isValid(): bool
// Validasi apakah kode bisa digunakan
// Returns: true jika kode aktif, dalam periode, dan belum habis

public function getDiscountAmount(float $originalPrice): float
// Hitung nominal diskon
// Param: Harga original
// Returns: Nominal diskon

public function getFinalPrice(float $originalPrice): float
// Hitung harga setelah diskon
// Param: Harga original
// Returns: Harga final (original - discount)
```

### Registration Model

```php
// Relations
public function user(): BelongsTo
public function ticketPackage(): BelongsTo
public function discountCode(): BelongsTo

// Methods
public function isPaid(): bool
// Returns: payment_status === 'paid'

public function isPending(): bool
// Returns: payment_status === 'pending'

public function isVerified(): bool
// Returns: verification_status === 'verified'

// Casting
'total_amount' => 'decimal:2'
'original_amount' => 'decimal:2'
'bundle_participants' => 'array'
'bundle_barcodes' => 'array'
'paid_at' => 'datetime'
'verified_at' => 'datetime'
```

---

## 📋 Data Flow Examples

### Example 1: Pembayaran Normal (Tanpa Diskon)

```php
// 1. User checkout
POST /tiket/checkout
{
  "ticket_package_id": 1,
  "quantity": 1
}

// Registration dibuat:
{
  "id": 1,
  "user_id": 5,
  "ticket_package_id": 1,
  "payment_status": "pending",
  "verification_status": "pending",
  "total_amount": 1000000,
  "original_amount": 1000000,
  "discount_percentage": 0,
  "discount_code_id": null
}

// 2. User upload bukti
POST /tiket/upload-bukti/1
{
  "payment_method": "bank_transfer",
  "payment_proof": <file>,
  "payment_notes": "Sudah transfer ke BCA"
}

// Registration updated:
{
  "payment_status": "paid",
  "payment_method": "bank_transfer",
  "payment_proof": "payment_proofs/5/abc123.jpg",
  "paid_at": "2025-01-10 14:30:00"
}

// 3. Admin verifikasi
POST /admin/registrations/1/verify

// Registration updated:
{
  "verification_status": "verified",
  "verified_at": "2025-01-10 14:35:00"
}

// 4. Admin generate QR
POST /admin/registrations/1/ticket-verify

// Registration updated:
{
  "barcode": "MCE2026-ABCDEFGHIJKL",
  "qr_code_path": "qrcodes/MCE2026-ABCDEFGHIJKL.svg"
}
```

### Example 2: Pembayaran dengan Diskon

```php
// 1. Admin buat diskon
POST /admin/discount-codes
{
  "code": "MCE50",
  "discount_percentage": 50,
  "valid_from": "2025-01-01",
  "is_active": true
}

// DiscountCode dibuat:
{
  "id": 1,
  "code": "MCE50",
  "discount_percentage": 50,
  "is_active": true,
  "used_count": 0,
  "usage_limit": null
}

// 2. User checkout
POST /tiket/checkout
{
  "ticket_package_id": 1,
  "quantity": 1
}

// Registration dibuat:
{
  "total_amount": 1000000 (masih harga normal)
}

// 3. User apply diskon
POST /tiket/1/apply-discount
{
  "code": "MCE50"
}

// System validasi:
// - Code MCE50 ada
// - is_active = true ✓
// - valid_from (2025-01-01) <= now ✓
// - no usage_limit ✓
// => VALID!

// Calculate:
// original_amount = 1000000
// discount = 1000000 * (50/100) = 500000
// final = 1000000 - 500000 = 500000

// Registration updated:
{
  "discount_code_id": 1,
  "discount_percentage": 50,
  "original_amount": 1000000,
  "total_amount": 500000  // <- Harga final (terpotong)
}

// DiscountCode updated:
{
  "used_count": 1  // <- Increment counter
}

// 4. User upload bukti transfer
// HARUS transfer: Rp 500.000 (sesuai total_amount yang sudah terpotong)

POST /tiket/upload-bukti/1
{
  "payment_method": "bank_transfer",
  "payment_proof": <file bukti Rp 500.000>
}

// Registration updated:
{
  "payment_status": "paid",
  "payment_method": "bank_transfer",
  "payment_proof": "payment_proofs/5/def456.jpg",
  "paid_at": "2025-01-10 14:30:00"
}

// 5. Admin verifikasi & generate QR
// (sama seperti example 1)
```

### Example 3: Bundle Tiket dengan Diskon

```php
// 1. User checkout bundle (3 peserta)
POST /tiket/checkout
{
  "ticket_package_id": 2,  // bundle package
  "quantity": 1
}

// Registration dibuat (quantity = 1, tapi untuk 3 peserta):
{
  "ticket_package_id": 2,
  "quantity": 1,  // Quantity = 1 (bundle)
  "total_amount": 3000000,  // 3 peserta
  "bundle_participants": null
}

// 2. User apply diskon (misal 20%)
POST /tiket/1/apply-discount
{
  "code": "MEMBER20"
}

// Registration updated:
{
  "discount_percentage": 20,
  "original_amount": 3000000,
  "total_amount": 2400000  // 3000000 - 20%
}

// 3. User upload bukti + data peserta
POST /tiket/upload-bukti/1
{
  "payment_method": "bank_transfer",
  "payment_proof": <file>,
  "participant_1_name": "Peserta 1",
  "participant_1_school": "SMA 1",
  "participant_2_name": "Peserta 2",
  "participant_2_school": "SMA 2",
  "participant_3_name": "Peserta 3",
  "participant_3_school": "SMA 3"
}

// Registration updated:
{
  "payment_status": "paid",
  "bundle_participants": [
    {"number": 1, "name": "Peserta 1", "school": "SMA 1"},
    {"number": 2, "name": "Peserta 2", "school": "SMA 2"},
    {"number": 3, "name": "Peserta 3", "school": "SMA 3"}
  ]
}

// 4. Admin generate QR
POST /admin/registrations/1/ticket-verify

// System generate 3 QR codes (satu per peserta):
{
  "bundle_barcodes": [
    {
      "number": 1,
      "name": "Peserta 1",
      "school": "SMA 1",
      "barcode": "MCE2026-B1-XXXXXX",
      "qr_code_path": "qrcodes/MCE2026-B1-XXXXXX.svg"
    },
    {
      "number": 2,
      "name": "Peserta 2",
      "school": "SMA 2",
      "barcode": "MCE2026-B2-XXXXXX",
      "qr_code_path": "qrcodes/MCE2026-B2-XXXXXX.svg"
    },
    {
      "number": 3,
      "name": "Peserta 3",
      "school": "SMA 3",
      "barcode": "MCE2026-B3-XXXXXX",
      "qr_code_path": "qrcodes/MCE2026-B3-XXXXXX.svg"
    }
  ]
}
```

---

## 🧪 Test Queries (SQL)

### Lihat semua diskon aktif

```sql
SELECT * FROM discount_codes
WHERE is_active = 1
ORDER BY created_at DESC;
```

### Lihat registrasi yang perlu verifikasi

```sql
SELECT r.*, u.name, tp.name as package_name
FROM registrations r
JOIN users u ON u.id = r.user_id
JOIN ticket_packages tp ON tp.id = r.ticket_package_id
WHERE r.payment_status = 'paid'
  AND r.verification_status = 'pending'
ORDER BY r.created_at;
```

### Lihat pembayaran yang sudah diverifikasi

```sql
SELECT * FROM registrations
WHERE verification_status = 'verified'
  AND barcode IS NULL
ORDER BY verified_at;
```

### Hitung total diskon yang digunakan

```sql
SELECT
  dc.code,
  COUNT(r.id) as used_count,
  SUM(r.original_amount - r.total_amount) as total_discount_amount
FROM discount_codes dc
LEFT JOIN registrations r ON r.discount_code_id = dc.id
GROUP BY dc.id
ORDER BY used_count DESC;
```

---

Semua query dan routes sudah siap untuk production testing! 🚀
