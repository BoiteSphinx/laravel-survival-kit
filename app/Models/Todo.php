<?php

namespace App\Models;

use App\Enums\TodoStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modèle Eloquent représentant un Todo.
 *
 * Cette classe encapsule :
 * - la structure des données
 * - les relations avec les autres modèles
 * - la logique de requête (scopes)
 */
class Todo extends Model
{
    /**
     * Permet d'utiliser les factories Eloquent
     * (tests, seeders, données de démonstration).
     */
    use HasFactory;

    /**
     * Tous les attributs sont assignables.
     *
     * Dans un projet réel, on préférera souvent
     * utiliser $fillable pour plus de sécurité.
     */
    protected $guarded = [];

    /**
     * Relation : un Todo appartient à un utilisateur.
     *
     * Permet par exemple :
     * - $todo->user
     * - $user->todos
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : un Todo peut avoir plusieurs tags.
     *
     * Cette relation utilise une table pivot
     * (todo_tag par défaut).
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope local : ne récupérer que les Todos terminés.
     *
     * Utilisation :
     * Todo::done()->get();
     *
     * Les scopes permettent d'encapsuler des filtres
     * réutilisables directement dans le modèle.
     */
    #[Scope]
    protected function done(Builder $query): void
    {
        $query->where('status', TodoStatus::DONE->value);
    }
}
