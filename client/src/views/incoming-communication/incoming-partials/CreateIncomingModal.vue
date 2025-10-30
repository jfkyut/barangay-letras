<script setup>

import { Button } from 'primevue';
import Modal from '@/components/Modal.vue';
import Container from '@/components/Container.vue';
import { ref } from 'vue';
import { useCommon } from '@/composables/common';
import { useHttpIncoming } from '@/http/incoming';
import { useIncomingStore } from '@/stores/incoming';
import { useRoute } from 'vue-router';
import IncomingForm from './IncomingForm.vue';
import { useToast } from 'vue-toastification';
import { storeToRefs } from 'pinia';

const { createIncomingRequest } = useHttpIncoming();

const isShowModal = ref(false);
const route = useRoute();
const submitButtonRef = ref(null);
const errors = ref(null);
const toast = useToast();

const { fetchIncomings } = useIncomingStore();
const { isDataLoading } = storeToRefs(useIncomingStore());

const form = ref({
    year: null,
    month: null,
    sequence_no: null,
    reference_no: null,
    classification: null,
    sender: null,
    subject: null,
    date_received: null,
    addressee: null,
    required_action: null,
    remarks: null
});

const submit = async () => {
    
    isDataLoading.value = true;

    form.value.reference_no = `${form.value.month}-${form.value.sequence_no}`;

    const { data } = await createIncomingRequest(form.value);

    if (!data?.errors) {
        form.value = {
            year: null,
            month: null,
            sequence_no: null,
            reference_no: null,
            classification: null,
            sender: null,
            subject: null,
            date_received: null,
            addressee: null,
            required_action: null,
            remarks: null
        }
        isShowModal.value = false;

        toast.success('Created incoming communication successfully.')

        await fetchIncomings(route.params);
    } else {
        errors.value = data.errors
    }

    isDataLoading.value = false;
}

</script>

<template>
    <Button @click="isShowModal = true">
        <i class="ri-add-line"></i>
        <span>New</span>
    </Button>

    <Modal
        :show="isShowModal"
        @close="isShowModal = false"
        max-width="4xl"
    >
        <Container>
            <template #header>
                <div class="flex justify-between items-center">
                    <header>
                        <h3 class="text-xl font-semibold text-zinc-900 dark:text-white uppercase">
                            New Incoming Communication
                        </h3>
                    </header>
                    <div class="flex gap-2 items-center">
                        <Button :loading="isDataLoading" severity="contrast" @click="submitButtonRef.click()">
                            <i class="ri-save-line"></i>
                            <span>Save</span>
                        </Button>
                    </div>
                </div>
            </template>
            <template #body>
                <form @submit.prevent="submit">
                    <IncomingForm :form="form" :errors="errors" />
                    <button ref="submitButtonRef" type="submit" class="sr-only"></button>
                </form>
            </template>
        </Container>
    </Modal>
</template>