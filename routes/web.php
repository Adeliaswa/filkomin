<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; 
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\EInvitationController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\Auth\LoginController;  // Menambahkan controller Login

// Halaman Landing Page
Route::get('/', function () {
    return view('landing');  // Halaman landing yang baru dibuat
});

// Halaman Dashboard (Harus login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group route yang memerlukan login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('events', EventController::class);

    Route::post('events/{event}/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::delete('events/{event}/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
    
    Route::get('events/{event}/export/pdf', [EventController::class, 'exportRecipientsPdf'])->name('events.export.pdf');
});

// ROUTE PUBLIK (Tamu Undangan)
Route::get('i/{token}', [EInvitationController::class, 'show'])->name('einvite.show');
Route::post('i/{token}/rsvp', [EInvitationController::class, 'submitRsvp'])->name('einvite.rsvp');
Route::get('checkin/{token}', [CheckInController::class, 'checkin'])->name('checkin.show');

// Login Route
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');  // Halaman login

// Autentikasi
require __DIR__.'/auth.php';
