<template>
    <Collapsible
        v-if="isCreate"
        v-model:open="open"
        class="w-full space-y-4"
    >
        <CollapsibleTrigger as-child>
            <Button variant="outline" class="w-full justify-between">
                <span>Créer Nouvelle Tâche</span>
                <ChevronDown class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" />
            </Button>
        </CollapsibleTrigger>

        <CollapsibleContent>
            <FormContent :form="formBinding" :statuses="statuses" >
                <template #submit>
                    Créer
                </template>
            </FormContent>
        </CollapsibleContent>
    </Collapsible>

    <!-- Mode édition -->
    <div v-else>
        <FormContent :form="formBinding" :todo="todo" :statuses="statuses" >
            <template #submit>
                Mettre à jour
            </template>
        </FormContent>
    </div>
</template>

<script setup lang="ts">
import { store, update } from '@/routes/todos';
import { TodoResource, TodoStatusCollection } from '@/types';
import { Button } from '@/components/ui/button';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '../ui/collapsible';
import { computed, ref } from 'vue';
import { ChevronDown } from 'lucide-vue-next';
import FormContent from '@/components/Todos/FormContent.vue';

const props = defineProps<{
    statuses: TodoStatusCollection
    todo?: TodoResource
}>()

const isCreate = computed(() => ! props.todo)

const open = ref(false)

const formBinding = computed(() => {
    return isCreate.value
        ? store.form()
        : update.form(props.todo?.data.id!) // ! veut dire non-null
})

</script>
