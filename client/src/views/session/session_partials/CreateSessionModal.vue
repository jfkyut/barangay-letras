<script setup>

import Container from '@/components/Container.vue';
import Modal from '@/components/Modal.vue';
import { ref, watch } from 'vue';
import { Button, Select, InputText, Textarea } from 'primevue';
import { useCommon } from '@/composables/common';
import { useHttpSession } from '@/http/session';
import { useHttpCouncil } from '@/http/council';
import { useToast } from 'vue-toastification';
import { storeToRefs } from 'pinia';
import { useCouncilStore } from '@/stores/council';
import { useSessionStore } from '@/stores/session';
import { useRoute } from 'vue-router';
import SessionForm from './SessionForm.vue';

const toast = useToast();

const route = useRoute();

const { fetchSessions } = useSessionStore();

const isShowModal = ref(false);
const submitButtonRef = ref(null);

const { createSessionRequest } = useHttpSession();

const form = ref({
    council_id: null,
    year: null,
    type_id: null,
    session_no: null,
    date: null,
    remarks: null,
})

const createSession = async () => {
    if (await createSessionRequest(form.value)) {
        isShowModal.value = false;
        form.value = {
            council_id: null,
            year: null,
            type_id: null,
            session_no: null,
            date: null,
            remarks: null,
        }

        await fetchSessions(route.params);

        toast.success('Session created successfully.');
    }
}

</script>

<template>
    <Button @click="isShowModal = true">
        <i class="ri-add-line"></i>
        <span class="ms-2">New</span>
    </Button>

    <Modal
        :show="isShowModal"
        @close="isShowModal = false"
    >
        <Container>
            <template #header>
                <div class="flex justify-between">
                    <h3 class="text-xl font-semibold text-zinc-900 dark:text-white">
                        Create New Session
                    </h3>
                    <div class="flex items-center gap-2">
                        <Button 
                            severity="secondary" 
                            @click="isShowModal = false"
                        >
                            Cancel
                        </Button>
                        <Button 
                            severity="contrast"
                            @click="submitButtonRef?.click()"
                        >
                            Create
                        </Button>
                    </div>
                </div>
            </template>
            <template #body>
                <form @submit.prevent="createSession">
                    <SessionForm :form="form" />
                    <button type="submit" ref="submitButtonRef" class="sr-only">
                        submit
                    </button>
                </form>
            </template>
        </Container>
    </Modal>
</template>