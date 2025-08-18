<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ChallansController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home.index');
});

Auth::routes(['verify' => true]);

// Custom email verification route
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::prefix('admin')->middleware(['auth', 'is-admin',])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('admin.home');
    Route::resource('users', UserController::class);
    Route::get('list/users', [ UserController::class, 'list'])->name('list.users');
});

Route::prefix('agent')->middleware(['auth', 'is-agent'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('agent.home');
});

Route::prefix('user')->middleware(['auth', 'is-user'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('user.home');
    // Route::resource('users', UserController::class);
    // Route::get('list/users', [ UserController::class, 'list'])->name('list.users');

});