<?php

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;

/**
 * Test : création d'une Todo
 *
 * Ce test simule un utilisateur connecté qui crée une nouvelle tâche.
 * On vérifie que le Todo est bien créée et qu'elle appartient à l'utilisateur.
 *
 * Astuce Pest : si tu veux exécuter seulement ce test pendant le développement,
 * tu peux ajouter ->only() :
 *
 * it('allows a user to create a todo', function () { ... })->only();
 */
it('allows a user to create a todo', function () {
    // Crée un utilisateur fictif
    $user = User::factory()->create();

    // Se connecter en tant que cet utilisateur et envoyer une requête POST pour créer une Todo
    $this->actingAs($user)
        ->post(route('todos.store'), [
            'title' => 'New Task',
            'status' => TodoStatus::TODO->value
        ])
        ->assertRedirect(route('todos.index')); // Vérifie que la redirection est correcte

    // Vérifie que la Todo a bien été créée dans la base de données
    expect(Todo::query()->where('title', 'New Task')->exists())->toBeTrue();

    // Vérifie que la Todo appartient bien à l'utilisateur
    $todo = $user->todos()->first();
    expect($todo)
        ->title->toBeString()->toBe('New Task')
        ->user_id->toBe($user->id);
});

/**
 * Test : suppression d'une Todo
 *
 * Ce test simule un utilisateur connecté qui supprime une Todo qu'il possède.
 * On vérifie que la Todo n'existe plus après la suppression.
 *
 * Astuce Pest : pour ne lancer que ce(s) test(s), tu peux écrire :
 *
 * it('allows a user to delete a todo', function () { ... })->only();
 */
it('allows a user to delete a todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->for($user)->create();

    // Se connecter et envoyer la requête DELETE
    $this->actingAs($user)
        ->delete(route('todos.delete', $todo))
        ->assertRedirect(); // Vérifie la redirection après suppression

    // Vérifie que la Todo a bien été supprimée
    expect(Todo::query()->find($todo->id))->toBeNull();
});
