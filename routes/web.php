<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| GENERAL CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EInvitationController;
use App\Http\Controllers\CheckInController;

/*
|--------------------------------------------------------------------------
| EO CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Eo\EoDashboardController;
use App\Http\Controllers\Eo\EoEventController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventApprovalController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\System\SettingsController;
use App\Http\Controllers\Admin\System\DistributionSettingsController;
use App\Http\Controllers\Admin\System\ActivityLogsController;

/*
|--------------------------------------------------------------------------
| LANDING
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
| DASHBOARD REDIRECT (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    return match (strtolower($user->role ?? '')) {
        'admin' => redirect()->route('admin.dashboard'),
        'eo'    => redirect()->route('eo.dashboard'),
        default => abort(403),
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

        // DASHBOARD EO
        Route::get('/dashboard', [EoDashboardController::class, 'index'])
            ->name('dashboard');

        // LIST EVENT (INI YANG BENAR)
        Route::get('/events', [EoEventController::class, 'index'])
            ->name('events.index');

        // CREATE EVENT
        Route::get('/events/create', [EoEventController::class, 'create'])
            ->name('events.create');

        Route::post('/events', [EoEventController::class, 'store'])
            ->name('events.store');

        // PREVIEW EVENT
        Route::get('/events/{event}/preview', function (Event $event) {
            if ($event->eo_id !== auth()->id()) {
                abort(403);
            }

            return view('eo.events.preview', compact('event'));
        })->name('events.preview');
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

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // EVENT APPROVAL (INI YANG ERROR KEMARIN)
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
            Route::get('/', [ReportsController::class, 'dashboard'])
                ->name('dashboard');

            Route::get('/events', [ReportsController::class, 'events'])
                ->name('events');

            Route::get('/organizers', [ReportsController::class, 'organizers']);
        });

        // SYSTEM
        Route::prefix('system')->name('system.')->group(function () {
            Route::get('/settings', [SettingsController::class, 'edit'])
                ->name('settings.edit');

            Route::post('/settings', [SettingsController::class, 'update'])
                ->name('settings.update');

            Route::get('/distribution', [DistributionSettingsController::class, 'edit'])
                ->name('distribution.edit');

            Route::post('/distribution', [DistributionSettingsController::class, 'update'])
                ->name('distribution.update');

            Route::get('/logs', [ActivityLogsController::class, 'index'])
                ->name('logs.index');
        });
    });

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PUBLIC INVITATION
|--------------------------------------------------------------------------
*/
Route::get('i/{token}', [EInvitationController::class, 'show'])
    ->name('einvite.show');

Route::get('i/{token}/pdf', [EInvitationController::class, 'pdf'])
    ->name('einvite.pdf');

Route::post('i/{token}/rsvp', [EInvitationController::class, 'submitRsvp'])
    ->name('einvite.rsvp');

Route::get('checkin/{token}', [CheckInController::class, 'checkin'])
    ->name('checkin.show');

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
