<template>
    <Form v-bind="form" v-slot="{ processing, errors }" class="flex flex-col gap-6">
        <!-- Titre -->
        <div class="grid gap-2">
            <Label for="title">Titre</Label>
            <Input
                id="title"
                name="title"
                type="text"
                :model-value="todo?.data.title"
                required
                autofocus
                placeholder="Nouvelle tâche..."
             />
            <InputError :message="errors.title" />
        </div>

        <div class="grid gap-2">
            <Label for="description">Description</Label>
            <Textarea
                id="description"
                name="description"
                :model-value="todo?.data.description ?? ''"
            />
            <InputError :message="errors.description" />
        </div>

        <div class="grid gap-2">
            <Label for="status">Statut</Label>

            <Select name="status" :default-value="todo?.data.status ?? 'todo' as TodoStatus">
                <SelectTrigger>
                    <SelectValue placeholder="Choisir un statut" />
                </SelectTrigger>

                <SelectContent>
                    <SelectItem v-for="status in statuses.data" :key="status.value" :value="status.value">
                        {{ status.label }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <input
                type="hidden"
                name="status"
                :value="status"
            />
            <InputError :message="errors.status" />
        </div>

        <div class="grid gap-2">
            <Button class="w-full" :disabled="processing">
                <slot name="submit">
                    Enregistrer
                </slot>
            </Button>
        </div>
    </Form>
</template>

<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Label } from '../ui/label';
import { Input } from '../ui/input';
import InputError from '../InputError.vue';
import { Textarea } from '../ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '../ui/select';
import { TodoResource, TodoStatus, TodoStatusCollection } from '@/types';
import { Button } from '../ui/button';
import { ref } from 'vue';

const props = defineProps<{
    form: Record<string, any>,
    todo?: TodoResource,
    statuses: TodoStatusCollection,
}>()

const status = ref<string>(
    props.todo?.data.status ?? 'todo'
)
</script>
