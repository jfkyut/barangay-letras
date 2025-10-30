<script setup>
import { Button } from 'primevue';
import Modal from '@/components/Modal.vue';
import Container from '@/components/Container.vue';
import { ref } from 'vue';
import { useCommon } from '@/composables/common';
import { useHttpSession } from '@/http/session';
import { useSessionStore } from '@/stores/session';
import { useRoute } from 'vue-router';
import { useToast } from 'vue-toastification';

defineProps({
    session: Object
});

const { convertToOrdinal } = useCommon();
const { deleteSessionRequest } = useHttpSession();

const route = useRoute();
const toast = useToast();

const { fetchSessions } = useSessionStore();

const isShowModal = ref(false);
const isLoading = ref(false);

const submit = async (session) => {
    isLoading.value = true;

    const { data } = await deleteSessionRequest(session?.id);

    if (!data.errors) {
        isShowModal.value = false;

        await fetchSessions(route.params);

        toast.success('Session deleted successfully.');
    }

    isLoading.value = false;
}

</script>

<template>
    <Button 
        @click="isShowModal = true" 
        severity="danger"
        variant="outlined"
    >
        <i class="ri-delete-bin-line"></i>
        <span>Delete</span>
    </Button>

    <Modal :show="isShowModal" @close="isShowModal = false">
        <Container class="dark:bg-gray-800">
            <template #header>
                <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                    <i class="ri-error-warning-line text-xl"></i>
                    <h3 class="text-lg font-semibold dark:text-white uppercase">
                        Delete {{ convertToOrdinal(session?.session_no) }} {{ session?.type?.name }} Session
                    </h3>
                </div>
            </template>
            <template #body>
                <div class="space-y-4">
                    <p class="text-gray-600 dark:text-gray-300">
                        Are you sure you want to delete this session? This action cannot be undone.
                    </p>
                    <div class="flex justify-end gap-2">
                        <Button 
                            severity="secondary"
                            label="Cancel" 
                            class="p-button-text dark:text-gray-300 dark:hover:bg-gray-700" 
                            @click="isShowModal = false"
                        />
                        <Button 
                            @click="submit(session)"
                            :loading="isLoading"
                            label="Delete" 
                            severity="danger"
                            class="dark:bg-red-600 dark:hover:bg-red-700 dark:border-red-600"
                        />
                    </div>
                </div>
            </template>
        </Container>
    </Modal>
</template>