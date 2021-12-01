<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\LicenseController;
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

Auth::routes();

// Custom routes for reset password method
Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.resets');

// Dashboard
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

// Billings
Route::get('/billing', [LicenseController::class, 'bills'])->middleware(['auth'])->name('billing');

// License
Route::resource('/licenses', LicenseController::class);
