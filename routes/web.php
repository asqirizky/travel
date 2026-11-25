<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourPackageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/about', 'public/About')->name('about');
Route::inertia('/service', 'public/Service')->name('service');
Route::get('/contact', function () {
    return Inertia::render('public/Contact', [
        'whatsappNumber' => config('services.whatsapp.number'),
    ]);
})->name('contact');
Route::get('/packages/{slug}', [TourPackageController::class, 'show'])->name('packages.show');
Route::get('/destinations/{destination:slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/contact/login', function () {
    return Inertia::render('auth/Login', [
        'status' => session('status'),
        'canResetPassword' => true,
        'teamInvitation' => null,
    ]);
})->name('contact.login');

Route::middleware(['auth', 'verified', 'role:admin,operator'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::resource('/packages', TourPackageController::class);
        Route::resource('/destinations', AdminDestinationController::class)->except('show');
    });

require __DIR__.'/settings.php';
