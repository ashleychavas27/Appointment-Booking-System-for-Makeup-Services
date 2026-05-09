<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminAppointmentController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::patch('services/{service}/toggle', [ServiceController::class, 'toggleActive'])->name('services.toggle');
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::post('/appointments/{appointment}/reschedule', [AdminAppointmentController::class, 'reschedule'])->name('appointments.reschedule');
    Route::get('/calendar', [AdminAppointmentController::class, 'calendar'])->name('calendar');
    Route::get('/reports', [AdminAppointmentController::class, 'reports'])->name('reports');
});

// Client Routes (Reverted from Student)
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard');
    Route::get('/book', [DashboardController::class, 'bookingPage'])->name('book');
    Route::post('/book', [DashboardController::class, 'bookService'])->name('book.store');
    Route::post('/appointments/{appointment}/cancel', [DashboardController::class, 'cancelBooking'])->name('appointment.cancel');
});
