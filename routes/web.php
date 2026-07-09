<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PositionController;

Route::get('/', function () {
    return view('auth.register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->group(function () {
            Route::get('/', 'index')
                ->name('dashboard');
            Route::get('/chart', 'chart')
                ->name('dashboard.chart');
        });

    Route::controller(CertificateController::class)
        ->prefix('certificates')
        ->name('certificates.')
        ->group(function () {
            Route::get('/', 'index')
                ->name('index');
            Route::get('/datatable', 'datatable')
                ->name('datatable');
            Route::post('/', 'store')
                ->name('store');
            Route::get('/{certificate}', 'show')
                ->name('show');
            Route::get('/{certificate}/edit', 'edit')
                ->name('edit');
            Route::put('/{certificate}', 'update')
                ->name('update');
            Route::delete('/{certificate}', 'destroy')
                ->name('destroy');
        });
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::controller(UnitController::class)
        ->prefix('units')
        ->name('units.')
        ->group(function () {
            Route::get('/', 'index')
                ->name('index');
            Route::get('/create', 'create')
                ->name('create');
            Route::post('/', 'store')
                ->name('store');
            Route::put('/{unit}', 'update')
                ->name('update');
            Route::delete('/{unit}', 'destroy')
                ->name('destroy');
        });

    Route::controller(PositionController::class)
        ->prefix('positions')
        ->name('positions.')
        ->group(function () {
            Route::get('/', 'index')
                ->name('index');
            Route::get('/create', 'create')
                ->name('create');
            Route::post('/', 'store')
                ->name('store');
            Route::put('/{certification}', 'update')
                ->name('update');
            Route::delete('/{certification}', 'destroy')
                ->name('destroy');
        });
});

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)
        ->prefix('profile')
        ->group(function () {
            Route::get('/', 'edit')
                ->name('profile.edit');
            Route::patch('/', 'update')
                ->name('profile.update');
            Route::delete('/', 'destroy')
                ->name('profile.destroy');
        });
});

require __DIR__ . '/auth.php';
