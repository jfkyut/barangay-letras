<script setup>

import { Button } from 'primevue';
import Modal from '@/components/Modal.vue';
import { ref, toRefs, watch } from 'vue';
import Container from '@/components/Container.vue';
import SessionForm from './SessionForm.vue';
import { useHttpSession } from '@/http/session';
import { useToast } from 'vue-toastification';
import { useSessionStore } from '@/stores/session';
import { useRoute } from 'vue-router';
import { useCommon } from '@/composables/common';
import { storeToRefs } from 'pinia';

const props = defineProps({ session: Object });

const { session } = toRefs(props);

const isShowModal = ref(false);
const submitButtonRef = ref(false);
const toast = useToast();
const route = useRoute();

const errors = ref([]);

const { convertToOrdinal } = useCommon();

const { isDataLoading } = storeToRefs(useSessionStore());
const { fetchSessions } = useSessionStore();
const { updateSessionRequest } = useHttpSession();

const form = ref({
    council_id: null,
    year: null,
    type_id: null,
    session_no: null,
    date: null,
    remarks: null,
    attachment: {
        agenda: [],
        minutes: [],
        journal: [],
        audio: [],
        photo: [],
        attendance: []
    }
});

watch(isShowModal, (isShowModal) => {
    if (isShowModal) {
        form.value.council_id = session.value.council_id;
        form.value.year = session.value.year;
        form.value.type_id = session.value.type_id;
        form.value.session_no = session.value.session_no;
        form.value.date = session.value.date;
        form.value.remarks = session.value.remarks;
    }
}, { immediate: true });

const submit = async (session) => {

    isDataLoading.value = true;

    const formData = new FormData();

    // console.log(form.value);
    
    // Append basic form fields
    Object.keys(form.value).forEach(key => {
        if (key !== 'attachment') {
            formData.append(key, form.value[key]);
        }
    });

    // Append files with attachment prefix
    Object.entries(form.value.attachment).forEach(([key, files]) => {
        if (files && files.length > 0) {
            Array.from(files).forEach(file => {
                formData.append(`attachment[${key}][]`, file);
            });
        }
    });

    const { data } = await updateSessionRequest(session?.id, formData);

    if (!data.errors) {
        isShowModal.value = false;
        form.value = {
            council_id: null,
            year: null,
            type_id: null,
            session_no: null,
            date: null,
            remarks: null,
            attachment: {
                agenda: [],
                minutes: [],
                journal: [],
                audio: [],
                photo: [],
                attendance: []
            }
        }

        await fetchSessions(route.params);

        toast.success('Session updated successfully.');
    } else {
        errors.value = data.errors;
    }

    isDataLoading.value = false;
}

</script>

<template>
    <Button @click="isShowModal = true" variant="outlined">
        <i class="ri-edit-line"></i>
        <span>Edit</span>
    </Button>

    <Modal
        :show="isShowModal"
        @close="isShowModal = false"
    >
        <Container>
            <template #header>
                <div class="flex justify-between">
                    
                    <header class="flex items-center">
                        <h3 class="text-xl font-semibold text-zinc-900 dark:text-white uppercase">
                            Edit {{ convertToOrdinal(session?.session_no) }} {{ session?.type?.name }} Session
                        </h3>
                    </header>
                    <div class="flex items-center gap-2">
                        <Button 
                            severity="secondary" 
                            @click="isShowModal = false"
                        >
                            Cancel
                        </Button>
                        <Button 
                            :loading="isDataLoading"
                            severity="contrast"
                            @click="submitButtonRef?.click()"
                        >
                            Update
                        </Button>
                    </div>
                </div>
            </template>
            <template #body>
                <form @submit.prevent="submit(session)">
                    <SessionForm :form="form" form-type="edit" :errors="errors" />
                    <button type="submit" ref="submitButtonRef" class="sr-only">
                        submit
                    </button>
                </form>
            </template>
        </Container>
    </Modal>
</template>