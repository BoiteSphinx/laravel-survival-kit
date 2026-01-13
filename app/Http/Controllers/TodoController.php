<?php

namespace App\Http\Controllers;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoStatusResource;
use App\Models\User;
use App\Policies\TodoPolicy;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(#[CurrentUser] User $user): Response
    {
        return Inertia::render('todos/Index', [
            'todos' => TodoResource::collection(
                $user->todos()->latest()->get()
            ),
            'statuses' => TodoStatusResource::collection(
                TodoStatus::cases()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request, #[CurrentUser] User $user): RedirectResponse {
        $user->todos()->create(
            $request->validated()
        );

        return redirect()->route('todos.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo): RedirectResponse
    {
        $todo->update($request->validated());

        return to_route('todos.index')->with('success', 'Todo mis à jour avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Todo $todo): Response
    {
        return Inertia::render('todos/Edit', [
            'todo' => new TodoResource($todo),
            'statuses' => TodoStatusResource::collection(TodoStatus::cases()),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorize(TodoPolicy::DELETE, $todo);

        $todo->delete();

        return back();
    }
}
