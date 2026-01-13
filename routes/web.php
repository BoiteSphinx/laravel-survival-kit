<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

/**
 * Les routes pour le l'autentification sont renseignées via le package Laravel/Fortify,
 * Les vues sont renseignées dans ./app/Providers/FortifyServiceProvider.php
 *
 * @see vendor\laravel\fortify\routes\routes.php
 * @see \App\Providers\FortifyServiceProvider
 */

// Guest Routes (unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    })->name('home');
});

// Registered routes (authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('todos/{todo:id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::delete('todos/{todo:id}', [TodoController::class, 'destroy'])->name('todos.delete');
});


require __DIR__.'/settings.php';
