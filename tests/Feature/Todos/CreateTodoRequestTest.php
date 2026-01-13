<?php

use App\Enums\TodoStatus;
use App\Models\User;

it('requires a title', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('todos.store'), [
            'title' => null,
            'status' => TodoStatus::TODO->value,
        ])
        ->assertSessionHasErrors('title');
});
