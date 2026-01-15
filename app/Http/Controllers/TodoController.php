<?php

namespace App\Http\Controllers;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoStatusResource;
use App\Mail\TodoCreatedMail;
use App\Models\User;
use App\Policies\TodoPolicy;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Ce controller est responsable de la gestion des Todos.
 *
 * Il contient la logique liée aux actions CRUD :
 * - affichage de la liste
 * - création
 * - modification
 * - suppression
 *
 * Le controller agit comme un intermédiaire entre :
 * - les requêtes HTTP
 * - la base de données (via Eloquent)
 * - le frontend (via Inertia)
 */
class TodoController extends Controller
{
    /**
     * Affiche la liste des Todos de l'utilisateur connecté.
     *
     * L'attribut #[CurrentUser] permet d'injecter automatiquement l'utilisateur
     * authentifié, san appeler auth()->user().
     *
     * Les données sont transformées via des JsonResources afin de contrôler
     * précisément ce qui est envoyé au frontend.
     */
    public function index(#[CurrentUser] User $user): Response
    {
        return Inertia::render('todos/Index', [
            // Liste des todos de l'utilisateur, triés du plus récent au plus ancien.
            'todos' => TodoResource::collection(
                $user->todos()->latest()->get()
            ),
            // Liste des statuts disponibles (enum PHP)
            'statuses' => TodoStatusResource::collection(
                TodoStatus::cases()
            ),
        ]);
    }

    /**
     * Enregistre un nouveau Todo en base de données.
     *
     * La validation et l'autorisation sont gérées par le StoreTodoRequest
     * Les données validées son automatiquement récupérées via validated().
     */
    public function store(StoreTodoRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        // Création du todo lié à l'utilisateur connecté
        $todo = $user->todos()->create(
            $request->validated()
        );

        /**
         * Envoi conditionnel d'un email.
         *
         * L'envoi du mail est contrôlé par une configuration.
         * Cela permet d'activer ou désactiver la fonctionnalité sans modifier le code.
         *
         * Cette valeur peut être modifiée dans le .env.
         */
        if (config('survival-kit.send_email')) {
            Mail::to($user)
                ->send(new TodoCreatedMail($todo));
        }

        return redirect()->route('todos.index');
    }

    /**
     * Mets à jour un Todo existant.
     *
     * Le Todo est injecté automatiquement grâce au Route Model Binding.
     * L'autorisation est gérée dans le UpdateTodoRequest (Policy).
     */
    public function update(UpdateTodoRequest $request, Todo $todo): RedirectResponse
    {
        $todo->update($request->validated());

        return to_route('todos.index')->with('success', 'Todo mis à jour avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'un Todo.
     *
     * Le Todo est transformé via un JsonResource avant d'être envoyé au frontend.
     */
    public function edit(Todo $todo): Response
    {
        return Inertia::render('todos/Edit', [
            'todo' => new TodoResource($todo),
            'statuses' => TodoStatusResource::collection(TodoStatus::cases()),
        ]);
    }

    /**
     * Supprime un Todo.
     *
     * L'autorisation est vérifiée explicitement via la Policy.
     * Si l'utilisateur n'est pas autorisé, une erreur 403 est retournée.
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorize(TodoPolicy::DELETE, $todo);

        $todo->delete();

        return back();
    }
}
