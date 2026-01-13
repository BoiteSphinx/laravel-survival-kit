<template>
    <Collapsible v-model:open="open" class="w-full space-y-4">
        <CollapsibleTrigger as-child>
            <Button variant="outline" class="w-full justify-between">
                <span>Nouvelle Tâche</span>
                <ChevronDown class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" />
            </Button>
        </CollapsibleTrigger>
        <CollapsibleContent>
            <Form v-bind="store.form()" v-slot="{ processing, errors }" class="flex flex-col gap-6">
                <!-- Titre -->
                <div class="grid gap-2">
                    <Label for="title">Titre</Label>
                    <Input name="title" id="title" type="text" required autofocus placeholder="Nouvelle tâche..." />
                    <InputError :message="errors.title" />
                </div>

                <div class="grid gap-2">
                    <Label for="description">Description</Label>
                    <Textarea name="description" id="description" />
                    <InputError :message="errors.description" />
                </div>

                <div class="grid gap-2">
                    <Label for="status">Statut</Label>
                    <Select name="status" :default-value="'todo' as TodoStatus">
                        <SelectTrigger>
                            <SelectValue placeholder="Choisir un statut" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="status in statuses" :key="status.value" :value="status.value">
                                {{ status.label }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="errors.status" />
                </div>

                <div class="grid gap-2">
                    <Button class="w-full" :disabled="processing">
                        Créer
                    </Button>
                </div>
            </Form>
        </CollapsibleContent>
    </Collapsible>

</template>

<script setup lang="ts">
import { store } from '@/routes/todos';
import { TodoStatus, TodoStatusOption } from '@/types';
import { Form } from '@inertiajs/vue3';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import InputError from '../InputError.vue';
import { Textarea } from '@/components/ui/textarea';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '../ui/collapsible';
import { ref } from 'vue';
import { ChevronDown } from 'lucide-vue-next';

defineProps<{
    statuses: TodoStatusOption[]
}>()

const open = ref(false)


</script>
