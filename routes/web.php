<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;

// หน้าเช็คว่า routes โหลดแล้ว
Route::get('/', fn() => 'OK: routes loaded');

// Login + Callback
Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login');
Route::get('/auth',  [AuthPageController::class, 'redirectToSso'])->name('auth.redirect');

// เมนูนิสิต/บุคลากร (ยังไม่ใส่ middleware ตอนดีบัก)
Route::get('/user/menu', [UserMenuController::class, 'index'])->name('user.menu');

// เมนูเจ้าหน้าที่ (ล็อกด้วย staff)
Route::get('/staff/console', [StaffController::class, 'console'])
    ->middleware(\App\Http\Middleware\RequireStaff::class)
    ->name('staff.console');

// ออกจากระบบ
Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');

// เมนูนิสิต
Route::get('/choose', [PageController::class, 'choose'])
    ->middleware('person')
    ->name('choose');

// ปุ่ม Check out สระ (ชั่วคราวให้ขึ้นหน้าเปล่าๆก่อน)
Route::get('/pool/checkout', function () {
    return 'pool checkout page';
})->name('pool.checkout');

// ปุ่มอื่นในเมนูที่อ้างชื่อไว้
Route::get('/staff/equipment', fn() => 'staff equipment page')->name('staff.equipment');
Route::get('/staff/badminton-booking', fn() => 'staff badminton page')->name('staff.badminton');
