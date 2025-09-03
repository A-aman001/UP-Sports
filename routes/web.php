<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\CheckinController;

use App\Http\Middleware\RequireStaff;
use App\Http\Middleware\RequirePerson;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

// Root → login
Route::get('/', fn () => redirect()->route('login'));

// Login + Callback + Logout
Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login');
Route::get('/auth',  [AuthPageController::class, 'redirectToSso'])->name('auth.redirect');
Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');

// เมนูนิสิต/บุคลากร
Route::get('/user/menu', [UserMenuController::class, 'index'])
    ->middleware(RequirePerson::class)
    ->name('user.menu');

// เมนูเจ้าหน้าที่
Route::get('/staff/console', [StaffController::class, 'console'])
    ->middleware(RequireStaff::class)
    ->name('staff.console');

// choose (เฉพาะนิสิต/บุคลากร)
Route::get('/choose', [PageController::class, 'choose'])
    ->middleware(RequirePerson::class)
    ->name('choose');

// checkin (เฉพาะนิสิต/บุคลากร)
Route::post('/checkin', [CheckinController::class, 'submit'])
    ->middleware(RequirePerson::class)
    ->name('checkin.submit');

// ปลายทางอื่นให้ route() ไม่พัง (ชั่วคราว)
Route::get('/pool/checkout', fn() => 'pool checkout page')->name('pool.checkout');
Route::get('/staff/equipment', fn() => 'staff equipment page')->name('staff.equipment');
Route::get('/staff/badminton-booking', fn() => 'staff badminton page')->name('staff.badminton');

// Report (เฉพาะ staff)
Route::get('/staff/report', [StaffReportController::class, 'index'])
    ->middleware(RequireStaff::class)
    ->name('staff.report');