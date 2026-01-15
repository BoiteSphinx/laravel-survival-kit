<template>
    <Card class="
        relative
        mb-4
        break-inside-avoid
        cursor-pointer
        transition
        hover:shadow-lg
        group
        shadow-gray-700
    ">
        <!-- Delete Button -->
        <TodoDelete :todo="todo" />

        <Link :href="edit(todo)">
            <CardContent class="py-4">
                <div>
                    <p class="font-medium">
                        {{ todo.title }}
                    </p>
                    <p class="text-sm text-muted-foreground">
                        {{ todo.description }}
                    </p>
                </div>
            </CardContent>

            <CardFooter class="flex flex-col items-start space-y-2">
                <Badge :class="statusClasses[todo.status]">
                    {{ todo.status }}
                </Badge>
                <span class="text-sm text-muted-foreground">
                    Dernière modification {{ new Date(todo.updated_at).toLocaleDateString() }}
                </span>
            </CardFooter>
        </Link>
    </Card>
</template>

<script setup lang="ts">
import { Todo, TodoStatus } from '@/types';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { Badge } from '../ui/badge';
import { Button } from '../ui/button';
import { Trash2 } from 'lucide-vue-next';
import { deleteMethod, edit } from '@/routes/todos';
import { Form, Link } from '@inertiajs/vue3';
import TodoDelete from './TodoDelete.vue';

defineProps<{
    todo: Todo,
}>()

const statusClasses: Record<TodoStatus, string> = {
    todo: 'bg-yellow-500 text-white',
    in_progress: 'bg-blue-500 text-white',
    done: 'bg-green-500 text-white',
    archived: 'bg-gray-400 text-white',
}

</script>
