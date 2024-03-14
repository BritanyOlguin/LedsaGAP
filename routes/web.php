<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    if (auth()->check()) {
        return Redirect::route('dashboard');
    }
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => false,
        // Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/roles', RoleController::class);
});

Route::post('/users/create', [UserController::class, 'store'])->name('users.store')->middleware('auth');


require __DIR__ . '/auth.php';
