<?php

use App\Models\Todo;
use App\Models\User;
use App\Policies\TodoPolicy;
use Database\Factories\TodoFactory;

it('allows owner to update todo', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->for($user)->create();

    expect($user->can(TodoPolicy::UPDATE, $todo))->toBeTrue();
});

it('denies non-owner to update todo', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $todo = Todo::factory()->for($owner)->create();

    expect($other->can(TodoPolicy::UPDATE, $todo))->toBeFalse();
});
