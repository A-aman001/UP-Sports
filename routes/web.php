<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\RequireStaff;  

// หน้าแรก
Route::get('/', fn () => view('welcome'));

// Login + SSO callback
Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login');
Route::get('/auth',  [AuthPageController::class, 'redirectToSso'])->name('auth.redirect');

// หน้า/ฟีเจอร์ทั่วไป
Route::get('/scan',      [PageController::class, 'scan'])->name('scan');
Route::get('/report',    [PageController::class, 'report'])->name('report');
Route::get('/choose',    [PageController::class, 'choose'])->name('choose');
Route::get('/generator', [PageController::class, 'generator'])->name('generator');

// Endpoint ประมวลผล
Route::post('/scan/submit',   [CheckinController::class, 'submitScan'])->name('scan.submit');
Route::post('/choose/submit', [CheckinController::class, 'chooseSubmit'])->name('choose.submit');

Route::get('/staff/console', [StaffController::class, 'console'])
    ->middleware(RequireStaff::class)   // 👈 ใช้คลาสแทน 'staff'
    ->name('staff.console');

Route::post('/logout', [StaffController::class, 'logout'])->name('logout');