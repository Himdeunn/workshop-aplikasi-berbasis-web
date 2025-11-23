<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EmployeeApiController;

/*
|--------------------------------------------------------------------------
| Public/Guest API Routes
|--------------------------------------------------------------------------
| FIX: Membungkus rute login/register dengan middleware guest:sanctum
| untuk menjamin respons JSON dan menghindari redirect HTML.
*/
Route::middleware('guest:sanctum')->group(function () {
    // Auth
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| Authenticated (Sanctum) API Routes for Employee
|--------------------------------------------------------------------------
| Semua endpoint di bawah ini memerlukan Token Sanctum yang valid
*/

Route::middleware('auth:sanctum')->group(function () {

    // Profile & Settings
    Route::get('/employee/profile', [EmployeeApiController::class, 'profile']);
    Route::put('/settings/update', [EmployeeApiController::class, 'updateProfile']);

    // Attendance
    Route::get('/attendance/absence', [EmployeeApiController::class, 'getAttendanceData']);
    Route::post('/attendance/check-in', [EmployeeApiController::class, 'checkIn']);
    Route::post('/attendance/check-out', [EmployeeApiController::class, 'checkOut']);

    // Fallback info user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
