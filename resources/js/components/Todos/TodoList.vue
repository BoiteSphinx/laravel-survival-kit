<template>
    <div class=" columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4">
        <template v-for="todo in todos.data" :key="todo.id">
            <TodoCard :todo="todo" />
        </template>
    </div>
</template>

<script setup lang="ts">
import { TodoCollection } from '@/types';
import TodoCard from '@/components/Todos/TodoCard.vue';

defineProps<{
    todos: TodoCollection
}>()

</script>
