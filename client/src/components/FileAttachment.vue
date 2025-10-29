<script setup>

import { Button } from 'primevue';
import { ref } from 'vue';
import Modal from './Modal.vue';
import Container from './Container.vue';
import { useCommon } from '@/composables/common';

defineProps({
    file: Object
});

const emit = defineEmits(['delete']);

const { redirectToNewTab, copyText } = useCommon();

const backendUrl = import.meta.env.VITE_BACKEND_URL;

const isShowActions = ref(false);
const isShowDelete = ref(false);

</script>

<template>
    <Button
        class="w-full"
        :title="file?.file_name"
        severity="secondary"
        variant="outlined"
        @click="isShowActions = !isShowActions"
    >
        <div class="text-sm truncate max-w-[150px] w-full text-start">
            <span>{{ file?.file_name }}</span>
        </div>
        <i class="ri-arrow-down-s-fill" v-if="!isShowActions"></i>
        <i class="ri-arrow-up-s-fill" v-else></i>
    </Button>
    <div class="mt-1 flex gap-2 justify-end" v-if="isShowActions">
        <Button 
            @click="redirectToNewTab(`${backendUrl}/storage/${file?.file_path}`)"
            title="Open"
            severity="secondary"
        >
            <i class="ri-external-link-line"></i>
        </Button>
        <Button 
            @click="copyText(file?.file_path)"
            title="Copy file path"
            severity="secondary"
        >
            <i class="ri-clipboard-line"></i>
        </Button>
        <Button 
            @click="isShowDelete = true"
            title="Delete file"
            severity="danger"
            variant="outlined"
        >
            <i class="ri-delete-bin-line"></i>
        </Button>

        
    </div>

    <Modal
        :show="isShowDelete"
        @close="isShowDelete = false"
    >
        <Container>
            <template #header>
                <div class="text-lg font-medium">
                    Delete File
                </div>
            </template>
            <template #body>
                <div class="space-y-4">
                    <p>Are you sure you want to delete this file?</p>
                    <p class="font-medium">{{ file?.file_name }}</p>
                    
                    <div class="flex justify-end gap-2">
                        <Button
                            severity="secondary"
                            @click="isShowDelete = false"
                        >
                            Cancel
                        </Button>
                        <Button
                            severity="danger"
                            @click="() => {
                                emit('delete');
                                isShowDelete = false;
                            }"
                        >
                            Delete
                        </Button>
                    </div>
                </div>
            </template>
        </Container>
    </Modal>
</template>