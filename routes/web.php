<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;

// GENERAL
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\EInvitationController;
use App\Http\Controllers\CheckInController;

// EO
use App\Http\Controllers\Eo\EoDashboardController;
use App\Http\Controllers\Eo\EoEventController;

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
| DASHBOARD REDIRECT
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

        // 📋 LIST EVENT / DASHBOARD EO
        Route::get('/events', [EoDashboardController::class, 'index'])
            ->name('events.index');

        // alias dashboard
        Route::get('/dashboard', [EoDashboardController::class, 'index'])
            ->name('dashboard');

        // ➕ FORM CREATE EVENT
        Route::get('/events/create', [EoEventController::class, 'create'])
            ->name('events.create');

        // 💾 SIMPAN EVENT
        Route::post('/events', [EoEventController::class, 'store'])
            ->name('events.store');

        // 🔍 PREVIEW UNDANGAN (BERDASARKAN CATEGORY)
        Route::get('/events/{event}/preview', function (\App\Models\Event $event) {

            // EO hanya boleh preview event miliknya
            if ($event->user_id !== auth()->id()) {
                abort(403);
            }

            // event harus punya template
            if (!$event->template) {
                abort(404, 'Template not found');
            }

            return view($event->template->blade_view, [
                'event'         => $event,
                'recipientName' => 'Nama Tamu',
                'showRsvp'      => false, // PREVIEW MODE
            ]);
        })->name('events.preview');

    });

/*
|--------------------------------------------------------------------------
| AUTHENTICATED CORE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('events', EventController::class);

    Route::post('events/{event}/recipients', [RecipientController::class, 'store'])
        ->name('recipients.store');

    Route::delete('events/{event}/recipients/{recipient}', [RecipientController::class, 'destroy'])
        ->name('recipients.destroy');

    Route::get('events/{event}/export/pdf', [EventController::class, 'exportRecipientsPdf'])
        ->name('events.export.pdf');
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

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/event-approval/{status?}', [EventApprovalController::class, 'index'])
            ->name('events.approval');

        Route::post('/event/{event}/approve', [EventApprovalController::class, 'approve'])
            ->name('events.approve');

        Route::post('/event/{event}/reject', [EventApprovalController::class, 'reject'])
            ->name('events.reject');

        Route::post('/event/{event}/revision', [EventApprovalController::class, 'revision'])
            ->name('events.revision');

        Route::get('/templates', [TemplateController::class, 'index'])
            ->name('templates.index');

        Route::post('/templates/{template}/toggle', [TemplateController::class, 'toggle'])
            ->name('templates.toggle');

        Route::get('/templates/{template}/preview', [TemplateController::class, 'preview'])
            ->name('templates.preview');

        Route::get('/users/admins', [UserController::class, 'admins'])
            ->name('users.admins');

        Route::get('/users/event-organizers', [UserController::class, 'eventOrganizers'])
            ->name('users.eos');

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportsController::class, 'dashboard'])->name('dashboard');
            Route::get('/events', [ReportsController::class, 'events'])->name('events');
            Route::get('/organizers', [ReportsController::class, 'organizers']);
        });

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

/*
|--------------------------------------------------------------------------
| PUBLIC INVITATION
|--------------------------------------------------------------------------
*/
Route::get('i/{token}', [EInvitationController::class, 'show'])->name('einvite.show');
Route::post('i/{token}/rsvp', [EInvitationController::class, 'submitRsvp'])->name('einvite.rsvp');
Route::get('checkin/{token}', [CheckInController::class, 'checkin'])->name('checkin.show');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
