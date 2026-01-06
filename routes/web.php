<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\TicketPackageController;
use App\Http\Controllers\Admin\AspirationController as AdminAspirationController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\DiscountCodeValidationController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES (Tanpa Login) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/kampus-preview', [CampusController::class, 'preview'])->name('campus.preview');
Route::get('/jadwal-preview', [ScheduleController::class, 'preview'])->name('schedule.preview');
Route::get('/galeri-preview', [GalleryController::class, 'preview'])->name('gallery.preview');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

// Public Feedback Routes (Tanpa Login) - Harus sebelum user routes
Route::get('/feedback-umum', [AspirationController::class, 'guestForm'])->name('feedback.guest-form');
Route::post('/feedback-umum', [AspirationController::class, 'storeGuest'])->name('feedback.store-guest');

// ===== AUTH ROUTES (Laravel Breeze) =====
require __DIR__ . '/auth.php';

// ===== USER ROUTES (Setelah Login) =====
Route::middleware(['auth', 'user'])->group(function () {
    // Dashboard User
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Full Access - Kampus
    Route::get('/kampus', [CampusController::class, 'index'])->name('campus.index');
    Route::get('/kampus/{id}', [CampusController::class, 'show'])->name('campus.show');

    // Full Access - Jadwal
    Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule.index');

    // Full Access - Galeri
    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

    // Pembelian Tiket
    Route::get('/tiket', [UserTicketController::class, 'index'])->name('user.tickets.index');
    Route::get('/tiket/pilih-paket', [UserTicketController::class, 'selectPackage'])->name('user.tickets.select');
    Route::post('/tiket/checkout', [UserTicketController::class, 'checkout'])->name('user.tickets.checkout');
    Route::get('/tiket/pembayaran/{registration}', [UserTicketController::class, 'payment'])->name('user.tickets.payment');
    Route::post('/tiket/upload-bukti/{registration}', [UserTicketController::class, 'uploadProof'])->name('user.tickets.upload');
    Route::post('/tiket/{registration}/apply-discount', [UserTicketController::class, 'applyDiscount'])->name('user.tickets.apply-discount');
    Route::get('/tiket/download/{registration}', [UserTicketController::class, 'download'])->name('user.tickets.download');

    // Ticket Show untuk User
    Route::get('/my-ticket/{registration}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/my-ticket/{registration}/download', [TicketController::class, 'download'])->name('tickets.download');

    // Feedback/Aspirasi
    Route::get('/feedback', [AspirationController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [AspirationController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/riwayat', [AspirationController::class, 'history'])->name('feedback.history');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kelola Registrasi & Pembayaran
    Route::get('/registrations', [AdminRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/{registration}', [AdminRegistrationController::class, 'show'])->name('registrations.show');
    Route::post('/registrations/{registration}/verify', [AdminRegistrationController::class, 'verify'])->name('registrations.verify');
    Route::post('/registrations/{registration}/ticket-verify', [TicketController::class, 'verify'])->name('registrations.ticket-verify');
    Route::post('/registrations/{registration}/reject', [AdminRegistrationController::class, 'reject'])->name('registrations.reject');
    Route::get('/registrations/export/excel', [AdminRegistrationController::class, 'export'])->name('registrations.export');

    // Check-in Peserta (Scan Tiket)
    Route::get('/checkin', [TicketController::class, 'checkInIndex'])->name('checkin.index');
    Route::get('/checkin/scan', [TicketController::class, 'scanPage'])->name('checkin.scan');
    Route::post('/api/tickets/scan', [TicketController::class, 'scan'])->name('api.tickets.scan');
    Route::get('/api/checkins/recent', [TicketController::class, 'recentCheckins'])->name('api.checkins.recent');

    // Kelola Paket Tiket
    Route::resource('ticket-packages', TicketPackageController::class);

    // Kelola Aspirasi
    Route::get('/aspirations', [AdminAspirationController::class, 'index'])->name('aspirations.index');
    Route::get('/aspirations/{aspiration}', [AdminAspirationController::class, 'show'])->name('aspirations.show');
    Route::delete('/aspirations/{aspiration}', [AdminAspirationController::class, 'destroy'])->name('aspirations.destroy');
    Route::get('/aspirations/export/excel', [AdminAspirationController::class, 'export'])->name('aspirations.export');

    // Kelola Kode Diskon
    Route::resource('discount-codes', DiscountCodeController::class);
});

// Validasi kode diskon (hanya untuk pengguna yang login)
Route::post('/discount/validate', DiscountCodeValidationController::class)
    ->middleware('auth')
    ->name('api.validate-discount');

// Debug route - lihat semua barcode di database
Route::get('/debug/barcodes', function () {
    if (!\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::user()->role !== 'admin') {
        return abort(403);
    }

    $registrations = \App\Models\Registration::where('barcode', '!=', null)
        ->select('id', 'name', 'school', 'barcode', 'verification_status', 'is_checked_in', 'checked_in_at', 'created_at')
        ->orderByDesc('created_at')
        ->limit(50)
        ->get();

    return view('debug.barcodes', compact('registrations'));
})->name('debug.barcodes');
