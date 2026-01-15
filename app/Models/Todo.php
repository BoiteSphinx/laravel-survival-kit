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
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @method static Builder<static>|Todo done()
 * @method static \Database\Factories\TodoFactory factory($count = null, $state = [])
 * @method static Builder<static>|Todo newModelQuery()
 * @method static Builder<static>|Todo newQuery()
 * @method static Builder<static>|Todo query()
 * @method static Builder<static>|Todo whereCreatedAt($value)
 * @method static Builder<static>|Todo whereDescription($value)
 * @method static Builder<static>|Todo whereId($value)
 * @method static Builder<static>|Todo whereStatus($value)
 * @method static Builder<static>|Todo whereTitle($value)
 * @method static Builder<static>|Todo whereUpdatedAt($value)
 * @method static Builder<static>|Todo whereUserId($value)
 * @mixin \Eloquent
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
