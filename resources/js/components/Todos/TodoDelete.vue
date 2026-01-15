<template>
    <Button
        variant="ghost"
        size="icon"
        class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition cursor-pointer"
        @click="open = true"
    >
        <Trash2 class="h-4 w-4" />
    </Button>

    <Dialog v-model:open="open">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Supprimer le Todo {{ todo.title }} ?</DialogTitle>
                <DialogDescription>
                    Cette action est irréversible.
                </DialogDescription>
            </DialogHeader>

            <DialogFooter>
                <Button
                    variant="outline"
                    @click="open = false"
                >
                    Annuler
                </Button>

                <Form
                    :method="deleteMethod(todo.id).method"
                    :action="deleteMethod(todo.id)"
                >
                    <Button variant="destructive" type="submit">
                        Supprimer
                    </Button>
                </Form>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { deleteMethod } from '@/routes/todos';
import { Todo } from '@/types';
import { Form } from '@inertiajs/vue3';
import { Trash2 } from 'lucide-vue-next';
import { Button } from '../ui/button';
import { ref } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '../ui/dialog';

defineProps<{
    todo: Todo
}>()

const open = ref(false)
</script>
