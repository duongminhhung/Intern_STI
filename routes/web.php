<?php

use App\Http\Controllers\LoginContrller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Route::view('/login','layouts.app')->name('login');
Route::get('/login', [LoginContrller::class, 'viewlogin'])->name('login');
Route::get('/register', [LoginContrller::class, 'viewregister'])->name('register');

// Route::view('/register', 'layouts.app')->name('register');