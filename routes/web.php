<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    CampusController,
    ScheduleController,
    GalleryController,
    ContactController,
    FeedbackController
};
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| 🌐 ROUTE PUBLIK (Peserta / Umum)
|--------------------------------------------------------------------------
| Semua orang bisa akses tanpa login.
| Termasuk halaman utama, kampus, jadwal, galeri, kontak, dan form feedback.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/campuses', [CampusController::class, 'index'])->name('campuses.index');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// 💬 Feedback publik (peserta isi form anonim)
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


/*
|--------------------------------------------------------------------------
| 🔐 ROUTE ADMIN (Panitia)
|--------------------------------------------------------------------------
| Hanya panitia (yang login) bisa akses ini.
| Prefix "admin" dan middleware "auth" menjaga keamanan akses.
*/
Route::prefix('admin')->group(function () {

    // 🏠 Dashboard utama panitia
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | 💬 Feedback Aspirasi (Untuk Ketua / Panitia)
    |--------------------------------------------------------------------------
    | Menampilkan daftar semua aspirasi yang dikirim secara anonim.
    | Ketua bisa melihat & menandai feedback sebagai “sudah ditindaklanjuti”.
    */
    Route::get('/feedbacks', [FeedbackController::class, 'index'])
        ->name('admin.feedbacks');

    Route::patch('/feedbacks/{feedback}/addressed', [FeedbackController::class, 'markAddressed'])
        ->name('admin.feedbacks.addressed');


    /*
    |--------------------------------------------------------------------------
    | 📚 (Opsional) Kelola data lain via dashboard admin
    |--------------------------------------------------------------------------
    | Contoh: kampus, jadwal, galeri (bisa dikembangkan nanti)
    */
    Route::get('/campuses', [CampusController::class, 'adminIndex'])
        ->name('admin.campuses');
    Route::get('/schedules', [ScheduleController::class, 'adminIndex'])
        ->name('admin.schedules');
    Route::get('/galleries', [GalleryController::class, 'adminIndex'])
        ->name('admin.galleries');
});
