<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])
    ->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

//Home Routes
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

//Staff Routes
Route::resource('staff', StaffController::class);
Route::view('/staff/shifts', 'staff.shifts');

//Shift Routes
Route::get('/shift', [ShiftController::class, 'index'])
    ->name('shift.index');
Route::get('/shift/today', [ShiftController::class, 'today'])
    ->name('shift.today');
Route::get('/shift/create', [ShiftController::class, 'create'])
    ->name('shift.create');
Route::post('/shift', [ShiftController::class, 'store'])
    ->name('shift.store');
Route::get('/shift/{shift}/edit', [ShiftController::class, 'edit'])
    ->name('shift.edit');
Route::put('/shift/{shift}', [ShiftController::class, 'update'])
    ->name('shift.update');
Route::get('/shift/{year}/{month}', [ShiftController::class, 'monthView'])
    ->name('shift.month')
    ->where(['year' => '[0-9]+', 'month' => '[0-9]+']);
Route::post('/shift/clear-month', [ShiftController::class, 'clearMonth'])
    ->name('shift.clear-month');
Route::get('/shift/week', [ShiftController::class, 'weekView'])
    ->name('shift.week');
Route::post('/shifts/clear-week', [ShiftController::class, 'clearWeek'])
    ->name('shift.clear-week');
Route::delete('/shift/{shift}', [ShiftController::class, 'destroy'])
    ->name('shift.destroy');
Route::get('/staff/{staff}/shifts/{year}/{month}', [StaffController::class, 'shift'])
    ->name('staff.shift');
Route::post('/shift/toggle-public-holiday', [ShiftController::class, 'togglePublicHoliday'])
    ->name('shift.togglePublicHoliday');
Route::get('/staff/{staff}/shifts', [StaffController::class, 'wildcard'])
    ->name('staff.wildcard');
Route::get('/shift/details/{date}', [ShiftController::class, 'details'])
    ->name('shift.details');

//Payslip Routes
Route::get('/staff/{staff}/payslip/{month}', [StaffController::class, 'downloadPayslip'])
    ->name('staff.payslip.download');
