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

const toast = useToast();

const route = useRoute();

const { councils } = storeToRefs(useCouncilStore());
const { getCouncils } = useCouncilStore();

const { fetchSessions } = useSessionStore();

const isShowModal = ref(false);
const submitButtonRef = ref(null);

const councilOptions = ref([]);
const sessionTypeOptions = ref([]);

const { createSessionRequest, getSessionTypesRequest } = useHttpSession();

const { years } = useCommon();

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

watch(isShowModal, (isShowModal) => {
    if (isShowModal) {
        (async () => {
            await getCouncils();
            const { session_types } = await getSessionTypesRequest();
            
            councilOptions.value = councils.value;
            sessionTypeOptions.value = session_types;
        })()
    }
})

</script>

<template>
    <Button severity="contrast" @click="isShowModal = true">
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
                <form @submit.prevent="createSession" class="space-y-4">
                    <div class="flex gap-2">
                        <div class="space-y-2 w-full">
                            <label for="">Council</label>
                            <Select 
                                v-model="form.council_id"
                                class="w-full" 
                                :options="councilOptions"
                                option-label="number"
                                option-value="id"
                                filter
                                placeholder="Select council"
                            />
                        </div>
                        <div class="space-y-2 w-full">
                            <label for="">Year</label>
                            <Select 
                                v-model="form.year"
                                class="w-full" 
                                :options="years" 
                                filter
                                placeholder="Select year"
                            />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div class="space-y-2 w-full">
                            <label for="">Type</label>
                            <Select 
                                :options="sessionTypeOptions"
                                v-model="form.type_id"
                                class="w-full" 
                                option-label="name"
                                option-value="id"
                                filter
                                placeholder="Select type"
                            />
                        </div>
                        <div class="space-y-2 w-full">
                            <label for="">Session No.</label>
                            <InputText 
                                v-model="form.session_no"
                                type="number"
                                class="w-full"
                                placeholder="session no."
                            />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div class="space-y-2 w-full">
                            <label for="">Date</label>
                            <InputText 
                                v-model="form.date"
                                type="date"
                                class="w-full"
                                placeholder="Select date"
                            />
                        </div>
                        <div class="space-y-2 w-full">
                            <label for="">Remarks</label>
                            <Textarea 
                                v-model="form.remarks"
                                class="w-full"
                                placeholder="Add remarks"
                                rows="4"
                                auto-resize
                            />
                        </div>
                    </div>
                    <button type="submit" ref="submitButtonRef" class="sr-only">
                        submit
                    </button>
                </form>
                
            </template>
        </Container>
    </Modal>
</template>