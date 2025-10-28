<script setup>

import { InputText, Button } from 'primevue';

defineProps({
    params: {
        type: Object,
        required: false, 
        default: () => ({
            keyword: ''
        })
    }
});

const emit = defineEmits(['filter']);

</script>

<template>
    <!-- {{ console.log(params) }} -->
    <form @submit.prevent="emit('filter', params)" class="flex items-center">
        <slot name="dropdown" />
        <InputText
            v-model="params.keyword" 
            placeholder="Input keyword"
        />
        <Button style="rounded-l-none" type="submit">
            <i class="ri-search-line"></i>
        </Button>
    </form>
</template>