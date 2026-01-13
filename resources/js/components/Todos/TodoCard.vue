<template>
    <Card
        class="
            relative
            mb-4
            break-inside-avoid
            cursor-pointer
            transition
            hover:shadow-lg
            group
            shadow-gray-700
        "
        @click="edit(todo)"
    >
        <!-- Delete Button -->
        <Button
            variant="ghost"
            size="icon"
            class="
                absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition cursor-pointer
            "
            @click.stop="destroy(todo)"
        >
            <Trash2 class="h-4 w-4" />
        </Button>

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
                Créé le {{ new Date(todo.created_at).toLocaleDateString() }}
            </span>
        </CardFooter>
    </Card>
</template>

<script setup lang="ts">
import { Todo, TodoStatus } from '@/types';
import { Card, CardContent, CardFooter } from '../ui/card';
import { Badge } from '../ui/badge';
import { Button } from '../ui/button';
import { Trash2 } from 'lucide-vue-next';
import { deleteMethod } from '@/routes/todos';

defineProps<{
    todo: Todo,
}>()

const statusClasses: Record<TodoStatus, string> = {
    todo: 'bg-yellow-500 text-white',
    in_progress: 'bg-blue-500 text-white',
    done: 'bg-green-500 text-white',
    archived: 'bg-gray-400 text-white',
}

const destroy = (todo: Todo) => {
    if (!confirm('Supprimer cette tâche ?')) return

    deleteMethod(todo)
}

const edit = (todo: Todo) => {
    console.log('Edit', todo)
}

</script>
