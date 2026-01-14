<?php

use App\Enums\TodoStatus;
use App\Mail\TodoCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('sends a mail when config is enabled', function () {
    Mail::fake();
    config()->set('survival-kit.send_email', true);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('todos.store'), [
            'title' => 'Test Mail',
            'status' => TodoStatus::TODO->value,
        ]);

    Mail::assertSent(TodoCreatedMail::class);
});

it('doesn\'t send a mail when config is disabled', function () {
    Mail::fake();
    config()->set('survival-kit.send_email', false);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('todos.store'), [
            'title' => 'Test Mail',
            'status' => TodoStatus::TODO->value,
        ]);

    Mail::assertNotSent(TodoCreatedMail::class);
});
