<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\PoojaController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PanditController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Superadmin\SiteSettingsController;
use App\Http\Controllers\Superadmin\SuperadminAuthController;


Route::get('/ping', function () {
    try {
        DB::connection()->getPdo();
        return '✅ DB connected and Laravel reachable';
    } catch (\Exception $e) {
        return '❌ DB Error: ' . $e->getMessage();
    }
});
/*
|--------------------------------------------------------------------------
| Public Routes (Customer Side)
|--------------------------------------------------------------------------
*/

// Home page with pooja listing
Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/all-poojas', [FrontendController::class, 'allPoojas'])->name('poojas.all');

// View single pooja with booking form
Route::get('/pooja/{id}', [FrontendController::class, 'view'])->name('pooja.view');

// Store pooja booking
Route::post('/book-pooja', [BookingController::class, 'store'])->name('book.pooja');

Route::get('/book-pooja', [FrontendController::class, 'bookForm'])->name('book.pooja.form');

// Thank you page
Route::get('/thank-you', fn() => view('thankyou'));

// Services page
Route::get('/services', [FrontendController::class, 'services'])->name('services');

// Contact page
Route::get('/contact', fn() => view('frontend.contact'))->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');

// Feedback page
Route::get('/feedback/{booking}', [FeedbackController::class, 'showForm']);
Route::post('/feedback/{booking}', [FeedbackController::class, 'submit']);



/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'doLogin']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Forgot Password
Route::get('admin/password/request', [AdminAuthController::class, 'forgotForm'])->name('admin.password.request');
Route::post('admin/password/email', [AdminAuthController::class, 'sendResetLink'])->name('admin.password.email');

// Reset Password
Route::get('admin/password/reset/{token}', [AdminAuthController::class, 'showResetForm'])->name('password.reset');
Route::post('admin/password/update', [AdminAuthController::class, 'resetPassword'])->name('admin.password.update');

// Admin Register (Optional)
Route::get('admin/register', [AdminAuthController::class, 'registerForm'])->name('admin.register.form');
Route::post('admin/register', [AdminAuthController::class, 'register'])->name('admin.register');



/*
|--------------------------------------------------------------------------
| Admin Protected Routes (with middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Poojas CRUD
    Route::resource('/poojas', PoojaController::class);

    // Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::post('/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');

    // Pandits CRUD
    Route::resource('/pandits', PanditController::class);
});


/*
|--------------------------------------------------------------------------
| SuperAdmin Protected Routes (with middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('superadmin')->name('superadmin.')->group(function () {

    // 🔐 Auth Routes (No Middleware)
    Route::get('/login', [SuperadminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [SuperadminAuthController::class, 'login']);
    Route::post('/logout', [SuperadminAuthController::class, 'logout'])->name('logout');

    // 🔁 Password Reset
    Route::get('password/forgot', [SuperadminAuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [SuperadminAuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [SuperadminAuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [SuperadminAuthController::class, 'reset'])->name('password.update');

    // ✅ Protected Routes (with superadmin middleware)
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/dashboard', [SuperadminAuthController::class, 'dashboard'])->name('dashboard');

        Route::get('/site-settings', [SiteSettingsController::class, 'edit'])->name('site-settings.edit');
        Route::post('/site-settings', [SiteSettingsController::class, 'update'])->name('site-settings.update');
    });
});
