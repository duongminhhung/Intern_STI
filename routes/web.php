<?php

use App\Http\Controllers\LoginContrller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\checklogin;
use App\Http\Middleware\checklogin_;
use App\Http\Middleware\CheckLoginEmployee;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::view('/login','layouts.app')->name('login');
Route::get('/register', [LoginContrller::class, 'viewregister'])->name('register');
Route::middleware([checklogin_::class])->group(function () {

    Route::get('/login', [LoginContrller::class, 'viewlogin'])->name('login');
});
Route::get('/logout', [LoginContrller::class, 'logout'])->name('logout');
Route::get('/login1', [LoginContrller::class, 'viewlogin'])->name('login1');



Route::middleware([checklogin::class])->group(function () {
    Route::get('/admin', function () {
       return view('admin.index');
    })->name('admin.index');
});


Route::middleware([CheckLoginEmployee::class])->group(function () {
    Route::get('/employee', [UserController::class, 'index'])->name('employee.index');
});



