<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; 
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\EInvitationController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// 2. Halaman Dashboard Central (Logika Pengalihan)
Route::get('/dashboard', function () {
    // Jika user adalah EO, arahkan ke dashboard khusus EO
    if (Auth::user()->email === 'eo@filkom.ac.id') {
        return redirect()->route('eo.dashboard');
    }
    // Jika user biasa, arahkan ke dashboard standar
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Khusus EO Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/eo/dashboard', function () {
        // Proteksi tambahan: hanya akun eo@filkom yang boleh buka URL ini
        if (Auth::user()->email !== 'eo@filkom.ac.id') {
            return redirect()->route('dashboard');
        }
        
        // Mengambil data event milik EO ini
        $events = \App\Models\Event::where('user_id', Auth::id())->latest()->get();
        return view('eo.dashboard', compact('events'));
    })->name('eo.dashboard');
});

// 4. Group route yang memerlukan login (Sistem Inti)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Resource untuk Event (CRUD)
    Route::resource('events', EventController::class);

    // Management Penerima/Tamu
    Route::post('events/{event}/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::delete('events/{event}/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
    
    // Fitur Cetak PDF
    Route::get('events/{event}/export/pdf', [EventController::class, 'exportRecipientsPdf'])->name('events.export.pdf');
});

// 5. ROUTE PUBLIK (Untuk Tamu Undangan via WhatsApp)
Route::get('i/{token}', [EInvitationController::class, 'show'])->name('einvite.show');
Route::post('i/{token}/rsvp', [EInvitationController::class, 'submitRsvp'])->name('einvite.rsvp');
Route::get('checkin/{token}', [CheckInController::class, 'checkin'])->name('checkin.show');

// 6. Login & Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
require __DIR__.'/auth.php';