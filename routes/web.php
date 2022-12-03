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
