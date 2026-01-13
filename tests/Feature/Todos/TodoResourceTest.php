<?php

use App\Enums\TodoStatus;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

it('formats todo resource correctly', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->for($user)->create([
        'title' => 'Test',
        'status' => TodoStatus::TODO->value,
    ]);

    $resource = (new TodoResource($todo))
        ->toArray(Request::create('/'));

    expect($resource)->toMatchArray([
        'id' => $todo->id,
        'title' => 'Test',
        'status' => TodoStatus::TODO->value,
        'user' => [
            'id' => $todo->user->id,
        ]
    ]);
});
