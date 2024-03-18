<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShortLinkController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\RedirectController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/sign-up', [SignUpController::class, 'index'])->name('signUp');
});

Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

//Email Verification
Route::get('/send-mail/{id}', [EmailVerificationController::class, 'sendMail'])->name('sendMail');
Route::get('/verification/{id}/{token}', [EmailVerificationController::class, 'index'])->name('verification');
Route::post('/verify', [EmailVerificationController::class, 'verify'])->name('verify');

Route::middleware(['auth', 'verify'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('settings/roles', RoleController::class);
    Route::get('short-links', [ShortLinkController::class, 'index'])->name('links.index');
    Route::get('links', [ShortLinkController::class, 'user'])->name('links.user');
    Route::get('short-links/create', [ShortLinkController::class, 'create'])->name('links.create');
    Route::get('short-links/{id}/view', [ShortLinkController::class, 'view'])->name('links.view');
    Route::get('short-links/{id}/edit', [ShortLinkController::class, 'edit'])->name('links.edit');
});

Route::get('/{main_link}', [RedirectController::class, 'index'])->name('redirect.link');
