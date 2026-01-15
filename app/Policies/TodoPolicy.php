<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

/**
 * Cette Policy centralise toutes les règles d'autorisation
 * liées au modèle Todo.
 *
 * Elle permet de déterminer ce qu'un utilisateur
 * a le droit de faire sur un Todo donné.
 */
class TodoPolicy
{
    /**
     * Constantes représentant les actions possibles.
     *
     * Elles sont utilisées lors des appels à :
     * $this->authorize(...)
     * ou $user->can(...)
     */
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const DELETE = 'delete';

    /**
     * Détermine si l'utilisateur peut créer un Todo.
     *
     * Ici, tout utilisateur authentifié est autorisé.
     * Dans un cas réel, on pourrait restreindre par rôle
     * ou par abonnement.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Détermine si l'utilisateur peut modifier un Todo.
     *
     * Seul le propriétaire du Todo peut le modifier.
     */
    public function update(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un Todo.
     *
     * La règle est identique à la mise à jour :
     * seul le propriétaire peut supprimer son Todo.
     */
    public function delete(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }
}
