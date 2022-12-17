<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/events/1', function () {
    return view('events.index0');
});
Route::get('/events/view2', function () {
    return view('events.index2');
});
Route::get('/events/view3', function () {
    return view('events.index3');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/departmentStaff', [App\Http\Controllers\ShiftController::class, 'getDepartmentUsers'])->name('getDepartmentUsers');
Route::post('/events/getShifts', [App\Http\Controllers\ShiftController::class, 'getShifts'])->name('getShifts');
Route::post('/events/getUserShifts', [App\Http\Controllers\ShiftUserController::class, 'getShiftByUserDate'])->name('getUserShifts');
Route::get('/events', [App\Http\Controllers\HomeController::class, 'viewUserDay'])->name('viewUserDay');
Route::get('/eventsHourly', [App\Http\Controllers\HomeController::class, 'viewDayHours'])->name('viewDayHours');
Route::post('/userShiftByDate', [App\Http\Controllers\HomeController::class, 'getUserShiftByDate'])->name('getUserShiftByDate');

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/users', [App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('admin.getusers')->middleware('is_admin');
Route::get('/timeoffTypes', [App\Http\Controllers\TimeoffTypeController::class, 'getTimeoffTypes'])->name('timeofftypes.gettimeofftypes')->middleware('is_admin');
Route::get('/shiftTypes', [App\Http\Controllers\ShiftTypeController::class, 'getShiftTypes'])->name('shifttypes.getshifttypes')->middleware('is_admin');
