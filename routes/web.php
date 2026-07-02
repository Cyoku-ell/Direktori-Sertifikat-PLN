<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============================
// Guest
// ===============================

Route::get('/', function () {
    return view('auth.register');
});

// ===============================
// Auth (Admin & User)
// ===============================

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Certificate
    Route::prefix('certificates')
        ->name('certificates.')
        ->group(function () {

            // Halaman Datatable
            Route::get('/', [CertificateController::class, 'index'])
                ->name('index');

            // Ajax Datatable
            Route::get('/datatable', [CertificateController::class, 'datatable'])
                ->name('datatable');

            // Upload
            Route::post('/', [CertificateController::class, 'store'])
                ->name('store');

            // Detail
            Route::get('/{certificate}', [CertificateController::class, 'show'])
                ->name('show');

            // Edit
            Route::put('/{certificate}', [CertificateController::class, 'update'])
                ->name('update');

            // Delete
            Route::delete('/{certificate}', [CertificateController::class, 'destroy'])
                ->name('destroy');
        });
});

// ===============================
// Admin Only
// ===============================

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    // Unit
    Route::prefix('units')
        ->name('units.')
        ->group(function () {

            Route::get('/', [UnitController::class, 'index'])
                ->name('index');

            // Halaman Add Unit
            Route::get('/create', [UnitController::class, 'create'])
                ->name('create');

            Route::post('/', [UnitController::class, 'store'])
                ->name('store');

            Route::put('/{unit}', [UnitController::class, 'update'])
                ->name('update');

            Route::delete('/{unit}', [UnitController::class, 'destroy'])
                ->name('destroy');
        });

    // Certification
    Route::prefix('certifications')
        ->name('certifications.')
        ->group(function () {

            Route::get('/', [CertificationController::class, 'index'])
                ->name('index');

            // Halaman Add Certification
            Route::get('/create', [CertificationController::class, 'create'])
                ->name('create');

            Route::post('/', [CertificationController::class, 'store'])
                ->name('store');

            Route::put('/{certification}', [CertificationController::class, 'update'])
                ->name('update');

            Route::delete('/{certification}', [CertificationController::class, 'destroy'])
                ->name('destroy');
        });
});

// ===============================
// Profile
// ===============================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
