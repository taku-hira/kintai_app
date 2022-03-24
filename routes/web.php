<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AttendanceController;
use App\Http\Controllers\User\LeaveApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

Route::get('/index', [AttendanceController::class, 'index'])
    ->middleware(['auth:users'])
    ->name('index');
Route::post('/attendance', [AttendanceController::class, 'attendanceStamp'])
    ->middleware('auth:users')
    ->name('attendanceStamp');
Route::post('/leaveWork', [AttendanceController::class, 'leaveWorkStamp'])
    ->middleware('auth:users')
    ->name('leaveWorkStamp');
Route::get('/attendanceRecord', [AttendanceController::class, 'attendanceRecord'])
    ->middleware('auth:users')
    ->name('attendanceRecord');

Route::prefix('leave_application')->middleware(['auth:users'])->group(function(){
    Route::get('index', [leaveApplicationController::class, 'index'])->name('leave_application.index');
    Route::get('show/{id}', [leaveApplicationController::class, 'show'])->name('leave_application.show');
    Route::get('create', [leaveApplicationController::class, 'create'])->name('leave_application.create');
    Route::post('store', [leaveApplicationController::class, 'store'])->name('leave_application.store');
    Route::get('edit/{id}', [leaveApplicationController::class, 'edit'])->name('leave_application.edit');
    Route::put('update/{id}', [leaveApplicationController::class, 'update'])->name('leave_application.update');
});


require __DIR__.'/auth.php';
