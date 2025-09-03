<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\CheckinController;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login');
Route::get('/auth',  [AuthPageController::class, 'redirectToSso'])->name('auth.redirect');
Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');

Route::get('/user/menu', [UserMenuController::class, 'index'])
    ->middleware('person')
    ->name('user.menu');

Route::get('/staff/console', [StaffController::class, 'console'])
    ->middleware('staff')
    ->name('staff.console');

Route::get('/choose', [PageController::class, 'choose'])
    ->middleware('person')
    ->name('choose');

Route::post('/checkin', [CheckinController::class, 'submit'])
    ->middleware('person')
    ->name('checkin.submit');

Route::get('/pool/checkout', fn() => 'pool checkout page')->name('pool.checkout');
Route::get('/staff/equipment', fn() => 'staff equipment page')->name('staff.equipment');
Route::get('/staff/badminton-booking', fn() => 'staff badminton page')->name('staff.badminton');

Route::get('/staff/report', [StaffReportController::class, 'index'])
    ->middleware('staff')
    ->name('staff.report');