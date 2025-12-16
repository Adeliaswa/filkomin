<?php

use Illuminate\Support\Facades\Route;

// =====================
// EO / GENERAL
// =====================
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; 
use App\Http\Controllers\RecipientController;

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

require __DIR__.'/auth.php';
