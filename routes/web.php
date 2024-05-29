<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes Start
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');
});
// Admin Routes End

require __DIR__ . '/auth.php';
