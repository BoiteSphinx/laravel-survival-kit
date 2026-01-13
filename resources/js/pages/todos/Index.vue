<template>
    <Head title="Todos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl mx-auto mt-4">
            <h1 class="text-2xl font-bold">Mes Todos</h1>

            <!-- Formulaire de création -->
            <TodoForm :statuses="statuses" class="my-4" />

            <Separator class="my-4" />

            <!-- Liste des todos -->
            <TodoList :todos="todos" />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import TodoForm from '@/components/Todos/TodoForm.vue';
import TodoList from '@/components/Todos/TodoList.vue';
import { Separator } from '@/components/ui/separator';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/todos';
import { BreadcrumbItem, TodoCollection, TodoStatusCollection } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: index().url,
    }
]

defineProps<{
    todos: TodoCollection,
    statuses: TodoStatusCollection
}>()
</script>
