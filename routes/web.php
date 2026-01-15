<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;


/**
 * AUTHENTIFICATION
 *
 * Les routes liées à l'authentification (login, register, logout, mot de passe)
 * sont automatiquement fournies par le package Laravel Fortify.
 *
 * Les vues utilisées par Fortify sont définies dans :
 * - app/Providers/FortifyServiceProvider.php
 *
 * Les routes Fortify peuvent être consultées ici :
 * - vendor/laravel/fortify/routes/routes.php
 *
 */

Route::middleware('guest')->group(function () {
    /**
     * PAGE D'ACCUEIL (utilisateur non authentifié)
     *
     * Cette route est accessible uniquement aux utilisateurs non connectés.
     * Elle affiche la page "Welcome" via Inertia, avec en paramètre la variable `canRegister`.
     *
     */
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    })->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    /**
     * TABLEAU DE BORD
     *
     * Route accessible uniquement aux utilisateurs authentifiés et ayant vérifié leur adresse email.
     *
     */

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    /**
     * GESTION DES TODOS
     *
     * Routes CRUD pour les Todos.
     * Le paramètre {todo:id} utilise le Route Model Binding pour injecter automatiquement le modèle Todo correspondant.
     *
     * En savoir plus: https://laravel.com/docs/12.x/routing#route-model-binding
     *
     */

    Route::get( // type de requête
        'todos', // Chemin de la route (en web)
        [TodoController::class, 'index'] // Controller + nom de méthode
        )->name('todos.index'); // Nom de la route (en interne)
    Route::post('todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('todos/{todo:id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('todos/{todo:id}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('todos/{todo:id}', [TodoController::class, 'destroy'])->name('todos.delete');

    /**
     * ALTERNATIVE SIMPLIFIÉE
     *
     * Laravel permet de déclarer toutes les routes CRUD en une seule ligne grace à la méthode resource().
     *
     * Exemple :
     * Route::resource('todos', TodoController::class);
     *
     * En savoir plus :
     * https://laravel.com/docs/12.x/controllers#resource-controllers
     *
     */
});

require __DIR__.'/settings.php';
