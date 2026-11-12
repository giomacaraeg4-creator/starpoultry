<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\AdminSensorController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// REGISTRATION
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.store');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['role:ADMIN'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ADMIN DASHBOARD
        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');

        // ACCOUNT MANAGEMENT
        Route::get('/accounts', [
            AccountManagementController::class,
            'index'
        ])->name('accounts.index');

        Route::patch('/accounts/{id}/approve', [
            AccountManagementController::class,
            'approve'
        ])->name('accounts.approve');

        Route::patch('/accounts/{id}/reject', [
            AccountManagementController::class,
            'reject'
        ])->name('accounts.reject');

        // SENSOR MANAGEMENT
        Route::get('/sensors', [
            AdminSensorController::class,
            'index'
        ])->name('sensors.index');

        Route::get('/sensors/create', [
            AdminSensorController::class,
            'create'
        ])->name('sensors.create');

        Route::post('/sensors', [
            AdminSensorController::class,
            'store'
        ])->name('sensors.store');

    });


/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['role:EMPLOYEE'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('dashboard');

    });


/*
|--------------------------------------------------------------------------
| LOGOUT ROUTE
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthController::class,
    'logout'
])->name('logout');
