<?php

namespace App\Http\Requests;

use App\Enums\TodoStatus;
use App\Policies\TodoPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $todo = $this->route('todo');

        return $todo
            && $this->user()->can(TodoPolicy::UPDATE, $todo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::enum(TodoStatus::class)],
        ];
    }
}
