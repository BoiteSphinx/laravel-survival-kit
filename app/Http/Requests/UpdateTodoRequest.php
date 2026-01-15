<?php

namespace App\Http\Requests;

use App\Enums\TodoStatus;
use App\Policies\TodoPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Cette classe gère la validation et l'autorisation
 * lors de la mise à jour d'un Todo existant.
 *
 * Contrairement au StoreTodoRequest, l'autorisation
 * dépend ici du Todo ciblé par la route.
 */
class UpdateTodoRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     *
     * Le Todo est récupéré depuis les paramètres de la route
     * grâce au Route Model Binding.
     *
     * L'autorisation est ensuite déléguée à la TodoPolicy.
     */
    public function authorize(): bool
    {
        // Récupération du Todo injecté dans la route
        $todo = $this->route('todo');

        return $todo
            && $this->user()->can(TodoPolicy::UPDATE, $todo);
    }

    /**
     * Définit les règles de validation applicables à la requête.
     *
     * Les règles sont identiques à celles de la création,
     * mais sont regroupées dans une classe dédiée afin de
     * garder une responsabilité claire.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Le titre est obligatoire et limité à 255 caractères
            'title' => ['required', 'string', 'max:255'],

            // La description est optionnelle
            'description' => ['nullable', 'string'],

            // Le statut doit correspondre à une valeur de l'enum TodoStatus
            'status' => ['required', Rule::enum(TodoStatus::class)],
        ];
    }
}
