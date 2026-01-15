<template>
    <!-- Définit le titre de la page (balise <title>) via Inertia -->
    <Head title="Todos" />

    <!-- Layout principal de l'application -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl mx-auto mt-4">
            <h1 class="text-2xl font-bold">Mes Todos</h1>

            <!--
                Formulaire de création d'un todo
                Le composant reçoit la liste des statuts depuis le backend
            -->
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

/**
 * Les breadcrumbs sont utilisés par le layout pour afficher le fil de navigation
 *
 * L'URL est générée à partir des routes Laravel grace à Laravel Wayfinder,
 * afin d'éviter les chemins codés en dur
 */
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: index().url,
    }
]

/**
 * Déclaration des propriétés que le composant à besoin.
 * Ces props sont injectées par Inertia depuis notre controller Laravel
 */
defineProps<{
    todos: TodoCollection,
    statuses: TodoStatusCollection
}>()
</script>
