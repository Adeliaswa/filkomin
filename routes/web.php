<?php

use Illuminate\Support\Facades\Route;

// =====================
// EO / GENERAL
// =====================
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; 
use App\Http\Controllers\RecipientController;
<<<<<<< HEAD
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
=======

// =====================
// ADMIN CONTROLLERS
// =====================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventApprovalController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController;

// =====================
// ADMIN SYSTEM
// =====================
use App\Http\Controllers\Admin\System\SettingsController;
use App\Http\Controllers\Admin\System\DistributionSettingsController;
use App\Http\Controllers\Admin\System\ActivityLogsController;

// =====================
// PUBLIC
// =====================
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('eo.dashboard');
    }
    return view('welcome');
});


Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'organizer' => redirect()->route('eo.dashboard'),
        default => redirect()->route('user.dashboard'),
    };
})->name('dashboard');
>>>>>>> origin/feature-phi

<<<<<<< HEAD
// Login Route
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');  // Halaman login

<<<<<<< HEAD
// Autentikasi
=======
// =====================
// ADMIN AREA (SATU-SATUNYA)
// =====================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // EVENT APPROVAL
        Route::get('/event-approval/{status?}', [EventApprovalController::class, 'index'])
            ->name('events.approval');

        Route::post('/event/{event}/approve', [EventApprovalController::class, 'approve'])
            ->name('events.approve');

        Route::post('/event/{event}/reject', [EventApprovalController::class, 'reject'])
            ->name('events.reject');

        Route::post('/event/{event}/revision', [EventApprovalController::class, 'revision'])
            ->name('events.revision');

        // TEMPLATES
        Route::get('/templates', [TemplateController::class, 'index'])
            ->name('templates.index');

        Route::post('/templates/{template}/toggle', [TemplateController::class, 'toggle'])
            ->name('templates.toggle');

        Route::get('/templates/{template}/preview', [TemplateController::class, 'preview'])
            ->name('templates.preview');

        // USERS
        Route::get('/users/admins', [UserController::class, 'admins'])
            ->name('users.admins');

        Route::get('/users/event-organizers', [UserController::class, 'eventOrganizers'])
            ->name('users.eos');

        // REPORTS
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportsController::class, 'dashboard'])->name('dashboard');
            Route::get('/events', [ReportsController::class, 'events'])->name('events');
            Route::get('/organizers', [ReportsController::class, 'organizers'])->name('organizers');
        });

        // SYSTEM 🔒
        Route::prefix('system')->name('system.')->group(function () {
            Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
            Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

            Route::get('/distribution', [DistributionSettingsController::class, 'edit'])
                ->name('distribution.edit');
            Route::post('/distribution', [DistributionSettingsController::class, 'update'])
                ->name('distribution.update');

            Route::get('/logs', [ActivityLogsController::class, 'index'])
                ->name('logs.index');
        });
    });

>>>>>>> origin/feature-phi
require __DIR__.'/auth.php';
=======
// 6. Login & Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
require __DIR__.'/auth.php';
>>>>>>> origin/feature/p3-dashboardeo
