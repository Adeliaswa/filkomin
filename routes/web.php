<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
// PROFILE & GENERAL
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\EInvitationController;
use App\Http\Controllers\CheckInController;

// EO (Event Organizer)
use App\Http\Controllers\Eo\EoDashboardController;
use App\Http\Controllers\Eo\EoEventController;

// AUTH
use App\Http\Controllers\Auth\LoginController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventApprovalController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\System\SettingsController;
use App\Http\Controllers\Admin\System\DistributionSettingsController;
use App\Http\Controllers\Admin\System\ActivityLogsController;

/*
|--------------------------------------------------------------------------
| PUBLIC / LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (CENTRAL)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    $role = strtolower($user->role ?? '');

    return match ($role) {
        'admin'             => redirect()->route('admin.dashboard'),
        'eo', 'organizer'   => redirect()->route('eo.dashboard'),
        default             => view('dashboard'),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| EO AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:eo'])
    ->prefix('eo')
    ->name('eo.')
    ->group(function () {

        // Dashboard & List Events
        Route::get('/dashboard', [EoDashboardController::class, 'index'])->name('dashboard');
        Route::get('/events', [EoDashboardController::class, 'index'])->name('events.index');

        // CRUD Event
        Route::get('/events/create', [EoEventController::class, 'create'])->name('events.create');
        Route::post('/events', [EoEventController::class, 'store'])->name('events.store');

        // Preview Undangan
        Route::get('/events/{event}/preview', function (Event $event) {
            if ($event->user_id !== auth()->id()) {
                abort(403);
            }
            if (!$event->template) {
                abort(404, 'Template not found');
            }
            return view($event->template->blade_view, [
                'event'         => $event,
                'recipientName' => 'Nama Tamu',
                'showRsvp'      => false,
            ]);
        })->name('events.preview');
    });

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER CORE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Events Resource
    Route::resource('events', EventController::class);

    // Recipients
    Route::post('events/{event}/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::delete('events/{event}/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');

    // Export PDF
    Route::get('events/{event}/export/pdf', [EventController::class, 'exportRecipientsPdf'])->name('events.export.pdf');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Event Approval
        Route::get('/event-approval/{status?}', [EventApprovalController::class, 'index'])->name('events.approval');
        Route::post('/event/{event}/approve', [EventApprovalController::class, 'approve'])->name('events.approve');
        Route::post('/event/{event}/reject', [EventApprovalController::class, 'reject'])->name('events.reject');
        Route::post('/event/{event}/revision', [EventApprovalController::class, 'revision'])->name('events.revision');

        // Templates
        Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
        Route::post('/templates/{template}/toggle', [TemplateController::class, 'toggle'])->name('templates.toggle');
        Route::get('/templates/{template}/preview', [TemplateController::class, 'preview'])->name('templates.preview');

        // Users
        Route::get('/users/admins', [UserController::class, 'admins'])->name('users.admins');
        Route::get('/users/event-organizers', [UserController::class, 'eventOrganizers'])->name('users.eos');

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportsController::class, 'dashboard'])->name('dashboard');
            Route::get('/events', [ReportsController::class, 'events'])->name('events');
            Route::get('/organizers', [ReportsController::class, 'organizers'])->name('organizers');
        });

        // System Settings
        Route::prefix('system')->name('system.')->group(function () {
            Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
            Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

            Route::get('/distribution', [DistributionSettingsController::class, 'edit'])->name('distribution.edit');
            Route::post('/distribution', [DistributionSettingsController::class, 'update'])->name('distribution.update');

            Route::get('/logs', [ActivityLogsController::class, 'index'])->name('logs.index');
        });
    });

/*
|--------------------------------------------------------------------------
| PUBLIC INVITATION (NO AUTH)
|--------------------------------------------------------------------------
*/
Route::get('i/{token}', [EInvitationController::class, 'show'])->name('einvite.show');
Route::post('i/{token}/rsvp', [EInvitationController::class, 'submitRsvp'])->name('einvite.rsvp');
Route::get('checkin/{token}', [CheckInController::class, 'checkin'])->name('checkin.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| NINJA MIGRATION (Gunakan jika Render Shell tidak bisa diakses)
|--------------------------------------------------------------------------
*/
Route::get('/jalankan-migrasi', function () {
    Artisan::call('migrate', ['--force' => true]);
    return "Database berhasil dimigrasi!";
});