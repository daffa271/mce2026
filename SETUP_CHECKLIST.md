# ✅ CHECKLIST KONFIGURASI & SETUP

## 🔐 User Role Configuration

### Check User Model

File: `app/Models/User.php`

Pastikan ada field `role`:

```php
protected $fillable = [
    'name',
    'email',
    'password',
    'role',  // ← ADD THIS if missing
];

protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];

// Add relationships
public function registrations()
{
    return $this->hasMany(Registration::class);
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}
```

### Database Migration for Role

Jika `role` column belum ada, buat migration:

```bash
php artisan make:migration add_role_to_users_table
```

**Content**:

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['user', 'admin'])->default('user')->after('email');
        }
    });
}
```

Run: `php artisan migrate`

---

## 📁 Storage Configuration

### Enable Public Disk

File: `config/filesystems.php`

Pastikan:

```php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

### Create Symlink

```bash
php artisan storage:link
```

Creates: `public/storage` → `storage/app/public`

### Create Directories

```bash
mkdir -p storage/app/public/payment_proofs
mkdir -p storage/app/public/qrcodes
mkdir -p storage/app/public/e-tickets

chmod -R 755 storage/app/public
```

---

## 📦 Dependencies Check

### Installed Libraries

```bash
composer require simpleSoftwareIO/simple-qrcode

# Optional for PDF
composer require barryvdh/laravel-dompdf

# Optional for Excel export
composer require maatwebsite/excel
```

### Check Installation

```bash
php artisan tinker
# Then in tinker:
SimpleSoftwareIO\QrCode\Facades\QrCode::class;
```

---

## 🔐 Middleware Configuration

### Auth Middleware

File: `app/Http/Middleware/Authenticate.php`

Should redirect unauthenticated to login.

### Admin Middleware

File: `app/Http/Middleware/IsAdmin.php`

Should contain:

```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized access. Admin only.');
    }

    return $next($request);
}
```

### User Middleware

File: `app/Http/Middleware/IsUser.php`

Should contain:

```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || auth()->user()->role === 'admin') {
        abort(403, 'Unauthorized access. User only.');
    }

    return $next($request);
}
```

### Register in Kernel

File: `app/Http/Kernel.php`

```php
protected $routeMiddleware = [
    'admin' => \App\Http\Middleware\IsAdmin::class,
    'user' => \App\Http\Middleware\IsUser::class,
    // ... other middleware
];
```

---

## 🗄️ Database Verification

### Required Tables

-   [x] users
-   [x] registrations
-   [x] ticket_packages
-   [x] aspirations (untuk feedback)

### Required Columns in registrations

```sql
- id
- user_id (FK users)
- ticket_package_id (FK ticket_packages)
- registration_code (UNIQUE)
- name
- email
- school
- grade (NULLABLE)
- payment_status (ENUM: pending, paid, expired, cancelled)
- verification_status (ENUM: pending, verified, rejected) ← NEW
- payment_method
- payment_proof
- payment_notes ← NEW
- total_amount (DECIMAL)
- quantity ← NEW (DEFAULT 1)
- bundle_participants ← NEW (JSON NULLABLE)
- paid_at (TIMESTAMP NULLABLE)
- verified_at ← NEW (TIMESTAMP NULLABLE)
- qr_code_path (VARCHAR NULLABLE)
- is_checked_in (BOOLEAN DEFAULT FALSE)
- checked_in_at (TIMESTAMP NULLABLE)
- created_at
- updated_at
```

### Required Columns in ticket_packages

```sql
- id
- name
- price (DECIMAL)
- description
- benefits (JSON)
- quota (INT)
- sold (INT DEFAULT 0)
- is_active (BOOLEAN DEFAULT TRUE)
- is_bundle ← NEW (BOOLEAN DEFAULT FALSE)
- bundle_size ← NEW (INT DEFAULT 1)
- valid_from (DATE)
- valid_until (DATE)
- created_at
- updated_at
```

### Verify with Artisan

```bash
php artisan migrate:status
```

Should show all migrations as "Ran"

---

## 🔌 Routes Configuration

### Already Registered Routes

File: `routes/web.php`

✅ All routes already exist:

-   User: `/tiket`, `/tiket/pilih-paket`, `/tiket/checkout`, `/tiket/pembayaran/{id}`, `/tiket/upload-bukti/{id}`, `/tiket/download/{id}`
-   Admin: `/admin/registrations`, `/admin/registrations/{id}`, `/admin/registrations/{id}/verify`, `/admin/registrations/{id}/reject`

### Verify Routes

```bash
php artisan route:list | grep -i ticket
php artisan route:list | grep -i registration
```

---

## 🧪 Quick Verification Commands

Run di terminal:

```bash
# Check migrations
php artisan migrate:status

# Check configuration
php artisan config:show database
php artisan config:show filesystems

# Check routes
php artisan route:list | head -50

# Verify User model
php artisan tinker
User::first();  # Should work
User::first()->isAdmin();  # Should work

# Verify TicketPackage
TicketPackage::first();  # Should work

# Test QR generation
SimpleSoftwareIO\QrCode\Facades\QrCode::generate('test');
```

---

## 📧 Email Configuration (Optional)

File: `.env`

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@mce2026.com
MAIL_FROM_NAME="MCE 2026"
```

### Test Email

```bash
php artisan tinker
Mail::raw('Test', function($message) {
    $message->to('test@example.com');
});
```

---

## 🔍 Verify Everything Works

### 1. Database

```bash
php artisan migrate:status
# All should be "Ran"
```

### 2. Routes

```bash
php artisan route:list | grep ticket
# Should show 6 ticket routes
```

### 3. Models

```bash
php artisan tinker
User::count();  # Should work
TicketPackage::count();  # Should work
Registration::count();  # Should work
```

### 4. Storage

```bash
ls -la storage/app/public/
# Should show: payment_proofs, qrcodes, e-tickets directories
```

### 5. Middleware

```bash
php artisan route:list | grep admin
# Should show middleware: auth,admin
```

---

## ✅ Final Checklist Before Launch

-   [ ] User model has `role` field
-   [ ] All migrations ran successfully
-   [ ] Storage symlink created
-   [ ] Storage directories exist with proper permissions
-   [ ] Middleware configured in Kernel
-   [ ] Routes registered in web.php
-   [ ] Admin middleware works (test with admin user)
-   [ ] User middleware works (test with regular user)
-   [ ] TicketPackage has test data
-   [ ] Payment form displays correctly
-   [ ] Bundle participants form shows for bundle packages
-   [ ] Can upload payment proof
-   [ ] Quota decreases after upload (NOT at checkout)
-   [ ] Status changes to "Menunggu Verifikasi"
-   [ ] Admin can view registrations list
-   [ ] Admin can view registration details
-   [ ] Admin can verify registration
-   [ ] QR code generates after verify
-   [ ] User can see "Terverifikasi" status
-   [ ] Can download e-ticket (once implemented)

---

## 🚀 Final Steps to Make System Live

1. **Update Admin Panel Views** (2-3 hours)

    - Create `resources/views/admin/registrations/index.blade.php`
    - Create `resources/views/admin/registrations/show.blade.php`
    - Implement verification logic

2. **Generate QR Codes** (1 hour)

    - Update `RegistrationController@verify()`
    - Generate & store QR code files

3. **Create E-Tickets** (2 hours)

    - Create PDF generation
    - Embed QR code in PDF
    - Allow download

4. **Add Notifications** (1-2 hours)

    - Email verification notifications
    - SMS alerts (optional)

5. **Testing & Debugging** (2-3 hours)
    - Test full user flow
    - Test admin verification
    - Test bundle packages
    - Test quota system

**Estimated Total**: 8-12 hours for full implementation

---

**Status**: 60% Implementation Complete
**Next Phase**: Admin Panel & QR Code Integration
**Review Date**: Every 2 hours during development
