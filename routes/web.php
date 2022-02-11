<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AttendanceController;

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

require __DIR__.'/auth.php';
