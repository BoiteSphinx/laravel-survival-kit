<?php

namespace App\Http\Requests;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Policies\TodoPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Cette classe est responsable de la validation et de l'autorisation
 * lors de la création d'un Todo.
 *
 * Elle permet de séparer la logique de validation et de sécurité
 * du controller, afin de garder un code plus lisible et maintenable.
 */
class StoreTodoRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     *
     * Cette méthode est appelée automatiquement par Laravel
     * avant l'exécution du controller.
     *
     * Ici, on délègue la logique d'autorisation à la TodoPolicy
     * afin de centraliser les règles de sécurité.
     */
    public function authorize(): bool
    {
        return $this->user()
            ?->can(TodoPolicy::CREATE, Todo::class) ?? false;
    }

    /**
     * Définit les règles de validation applicables à la requête.
     *
     * Si la validation échoue :
     * - l'utilisateur est automatiquement redirigé
     * - les erreurs sont renvoyées au frontend via Inertia
     *
     * Aucune gestion manuelle des erreurs n'est nécessaire.
     *
     */
    public function rules(): array
    {
        return [
            // Le titre est obligatoire et limité à 255 caractères
            'title' => ['required', 'string', 'max:255'],

            // La description est optionnelle
            'description' => ['nullable', 'string'],

            // Le statut doit correspondre à une valeur définie dans l'enum TodoStatus
            'status' => ['required', Rule::enum(TodoStatus::class)],
        ];
    }
}
