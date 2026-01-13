<?php

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;

it('allows a user to create a todo', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('todos.store'), [
            'title' => 'New Task',
            'status' => TodoStatus::TODO->value
        ])
        ->assertRedirect(route('todos.index'));

    expect(Todo::query()->where('title', 'New Task')->exists())->toBeTrue();

    $todo = $user->todos()->first();

    expect($todo)
        ->title->toBeString()->toBe('New Task')
        ->user_id->toBe($user->id);
});

it('allows a user to delete a todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->for($user)->create();

    $this->actingAs($user)
        ->delete(route('todos.delete', $todo))
        ->assertRedirect();

    expect(Todo::query()->find($todo->id))->toBeNull();
});
