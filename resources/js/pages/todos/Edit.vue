<template>
    <Head title="Todos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl mx-auto mt-4">
            <h1 class="text-2xl font-bold">Modifier le Todo</h1>

            <TodoForm
                :todo="todo"
                :statuses="statuses"
            />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import TodoForm from '@/components/Todos/TodoForm.vue';
import CreateTodoForm from '@/components/Todos/TodoForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { edit } from '@/routes/todos';
import { BreadcrumbItem, Todo, TodoStatusOption } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    todo: Todo,
    statuses: TodoStatusOption[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: edit(props.todo.id).url,
    }
]



</script>
