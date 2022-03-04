<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\SoftDeleteUserController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\Users\UserAttendanceRecordController;
use App\Http\Controllers\Admin\Users\UserScheduleController;
use App\Models\User;

Route::get('/', function () {
    return view('admin.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('dashboard');

Route::prefix('users')->middleware(['auth:admin'])->group(function (){
    Route::get('index', [UserController::class, 'index'])->name('users.index');
    Route::get('create', [UserController::class, 'create'])->name('users.create');
    Route::post('store', [UserController::class, 'store'])->name('users.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('soft_delete_users')->middleware(['auth:admin'])->group(function (){
    Route::get('index', [SoftDeleteUserController::class, 'index'])->name('soft_delete_users.index');
    Route::delete('destroy/{id}', [SoftDeleteUserController::class, 'destroy'])->name('soft_delete_users.destroy');
});

Route::prefix('shifts')->middleware(['auth:admin'])->group(function (){
    Route::get('index', [ShiftController::class, 'index'])->name('shifts.index');
    Route::get('create', [ShiftController::class, 'create'])->name('shifts.create');
    Route::post('store', [ShiftController::class, 'store'])->name('shifts.store');
    Route::get('edit/{id}', [ShiftController::class, 'edit'])->name('shifts.edit');
    Route::post('update/{id}', [ShiftController::class, 'update'])->name('shifts.update');
});

Route::prefix('user_attendance_record')->middleware(['auth:admin'])->group(function(){
    Route::get('index/{id}', [UserAttendanceRecordController::class, 'index'])->name('user_attendance_record.index');
    Route::get('create/{id}', [UserAttendanceRecordController::class, 'create'])->name('user_attendance_record.create');
    Route::post('store/{id}', [UserAttendanceRecordController::class, 'store'])->name('user_attendance_record.store');
    Route::get('edit/{user_id}/{attendance_id}', [UserAttendanceRecordController::class, 'edit'])->name('user_attendance_record.edit');
    Route::post('update/{user_id}/{attendance_id}', [UserAttendanceRecordController::class, 'update'])->name('user_attendance_record.update');
    Route::delete('destroy/{user_id}/{attendance_id}', [UserAttendanceRecordController::class, 'destroy'])->name('user_attendance_record.destroy');
});

Route::prefix('user_schedule')->middleware(['auth:admin'])->group(function (){
    Route::get('index', [UserScheduleController::class, 'index'])->name('user_schedule.index');
    Route::get('create/{id}', [UserScheduleController::class, 'create'])->name('user_schedule.create');
    Route::post('store/{id}', [UserScheduleController::class, 'store'])->name('user_schedule.store');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:admin')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:admin', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:admin')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:admin');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:admin')
                ->name('logout');
