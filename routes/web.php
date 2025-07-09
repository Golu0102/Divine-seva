<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PoojaController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PanditController;

/*
|--------------------------------------------------------------------------
| Public Routes (Customer Side)
|--------------------------------------------------------------------------
*/

// Home page with pooja listing
Route::get('/', [FrontendController::class, 'index'])->name('home');

// View single pooja with booking form
Route::get('/pooja/{id}', [FrontendController::class, 'view'])->name('pooja.view');

// Store pooja booking
Route::post('/book-pooja', [BookingController::class, 'store'])->name('book.pooja');

// Thank you page
Route::get('/thank-you', fn() => view('thankyou'));

// Services page
Route::get('/services', [FrontendController::class, 'services'])->name('services');

// Contact page
Route::get('/contact', fn() => view('frontend.contact'))->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'doLogin']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


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
