<?php

use App\Console\Commands\GreetingCommand;
use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

/**
 * Fichier de bootstrap de l'application Laravel
 *
 * Il configure :
 * - le routing
 * - les middlewares
 * - la gestion des exceptions
 * - et les tâches planifiées (scheduler)
 *
 * En savoir plus : https://laravel.com/docs/12.x/scheduling
 */
return Application::configure(basePath: dirname(__DIR__))

    /**
     * Définitions des fichiers de route utilisés par l'application
     */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    /**
     * Configuration des middleware globaux et Web
     */
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })

    /**
     * Configuration de la gestion des exceptions
     */
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    /**
     * Définition des tâches planifiées de l'application. (depuis Laravel 12)
     */
    ->withSchedule(function (Schedule $schedule): void {

        /**
         * Exemple de tâche planifiée
         *
         * Ici, on planifie l'exécution d'une commande Artisan.
         *
         * - command('inspire')     : commande Artisan à exécuter
         * - between(...)           : exécution tous les jours entre 08:00 et 09:00
         * - everyFifteenMinutes()  : toutes les 15 minutes
         *
         * Cette commande sera donc exécutée entre 08:00 et 09:00 toutes les 15 minutes.
         */
        $schedule->command('inspire')
            ->between('08:00', '09:00')
            ->everyFifteenMinutes();

        $schedule->command(GreetingCommand::class)
            ->dailyAt('09:00')
            ->weekdays();
    })

    /**
     * Création finale de l'application
     */
    ->create();
