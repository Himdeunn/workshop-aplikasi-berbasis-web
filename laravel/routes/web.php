<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::get('/', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

    // EMPLOYEE ONLY
    Route::middleware('role:employee')->group(function () {
        Route::get('/attendance/absence', [AttendanceController::class, 'absence'])->name('attendance.absence');
        Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
        Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

    // ADMIN ONLY
    Route::middleware('role:admin')->group(function () {
        // Hapus rute 'create' dan 'store' untuk employees
        Route::resource('employees', EmployeeController::class)->except(['create', 'store']);

        Route::resource('departments', DepartmentController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('attendances', AttendanceController::class)->except([
            'create',
            'store',
            'destroy'
        ]);

        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/export/{type?}', [ReportController::class, 'export'])->name('report.export');
    });
});
