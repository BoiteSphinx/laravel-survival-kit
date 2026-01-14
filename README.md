<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## A propos du projet

### Présentation

Cette application Todo a pour objectif de support pédagogique pour découvrir le framework **Laravel** et son intégration avec **Vue 3 via InertiaJS**.

Le projet couvre les bases d'une application web moderne:
- Authentification ([Laravel Fortify](https://github.com/laravel/fortify))
- CRUD
- Validation
- Autorisations
- Tests unitaires
- Frontend moderne

Des commentaires explicatifs sont présents dans différentes parties de l'application afin de faciliter la compréhension du code, notamment dans le fichier `routes/web.php`.

### Stack technique

- [Laravel 12](https://laravel.com/docs/12.x/starter-kits#vue) (starter-kit Vue)
- [Vue 3](https://vuejs.org/) (Composition API)
- [InertiaJS](https://inertiajs.com/) (Communication entre le backend et le frontend)
- [TypeScript](https://www.typescriptlang.org/)
- [TailwindCSS](https://tailwindcss.com/) (librairie CSS)
- [Shadcn-vue](https://www.shadcn-vue.com/) (librairie de composants)
- [Lucide](https://lucide.dev/) (librairie d'icones)
- [Pest](https://pestphp.com/) (tests)

## Installation

### Prérequis

- PHP >= 8.2
- Composer 2
- Node.js >= 16
- Une base de données (SQLite / MySQL 8)

Afin de faciliter l'installation des prérequis, il est recommandé d'utiliser [Laravel Herd](https://herd.laravel.com/windows), un environnemnt de développement dédié à PHP et Laravel, qui fournit tous les outils nécessaires pour travailler en local.

### Installation

```bash
git clone <url>
cd laravel-survival-kit

# Installation des dépendances composer
composer install

# Installation des dépendances npm
npm install

# build le frontend
npm run build

# Génération de la clé de projet
cp .env.example .env
php artisan key:generate
```

Modifier les variables d'environnement :

```sh
# .env
DB_CONNECTION=sqlite

DEFAULT_USER_NAME=<your_name>
DEFAULT_USER_EMAIL=<your_email>

SEND_EMAIL=true
```
Alimenter la base de données et lancer le serveur de développement :

```bash
# Populer la base de données
php artisan migrate:fresh --seed

# Lancer le serveur de développement
composer run dev
```

L'application est accessible sur http://laravel-survival-kit.test.

## Prise en main

### Structure du projet

- `app/Models` : modèles Eloquent
- `app/Http/Controllers` : logique applicative
- `app/Http/Requests` : Validation et autorisation
- `app/Policies` : gestion des droits
- `config` : gestion des configurations de l'application
- `database/migrations` : structure de la base de données
- `database/factories` & `seeders` : données de test
- `resources` : composants Javascript / Tailwind / Blade
- `routes/web.php` : définition des routes de l'application
- `storage` : stockage des fichiers de l'application (logs, images, ..)
- `tests` : tests unitaires
- `.env` : variables d'environnement

### Fonctionnalités principales

- Création, modification et suppression de Todos
- Statuts via enum PHP
- Autorisation par utilisateur (Policy)
- Envoi conditionnel d'un mail

### Validation & sécurité

- Validation via FormRequest
- Autorisations via Policy
- Protection CSRF automatique

## Exercices

### Installer Laravel Debugbar

Objectif: découvrir le cycle d'une requête Laravel.

```bash
composer require barryvdh/laravel-debugbar --dev
```

- Recharger une page
- Observer
    - les requêtes SQL
    - Le temps d'exécution
    - les variables partagées avec Inertia

### Filtrer les Todos

Ajouter un filtre pour chaque statut de Todo (Terminé, en cours, ...)
Utiliser un Query Scope dans le modèle Todo
Adapter le frontend Vue

> Tips: Utiliser le composant [Tabs](https://www.shadcn-vue.com/docs/components/tabs) de shadcn-vue.

## Pour aller plus loin

Voici quelques pistes pour approfondir :

- Events & Listeners
- Queues et jobs asynchrones
- Planification de tâches
- Notifications (mail, database)
- Soft deletes
- Test navigateur avec Pest
- Api REST avec Sanctum
- Gestion des rôles et permissions
- Cache & performance
- Traductions

### Ressources utiles

- [Documentation Laravel](https://laravel.com/docs)
- [Modules de formation Laravel / PHP](https://laravel.com/learn) (gratuit)
- [Formations écosystème Laravel](https://laracasts.com) (gratuit & payant)
- [Documentation Pest](https://pestphp.com/docs/installation)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
