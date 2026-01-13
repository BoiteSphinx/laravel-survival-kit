<?php

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;


it('forbids updating a todo not owned by user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $todo = Todo::factory()->for($owner)->create();

    $this->actingAs($other)
        ->put(route('todos.update', $todo), [
            'title' => 'Something',
            'status' => TodoStatus::TODO->value,
        ])
        ->assertForbidden();
})
// ->only() // Exécuter seulement ce test (on peut en mettre sur d'autres tests pour en exécuter certains)
;
