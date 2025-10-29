<script setup>

import { Select, InputText, Textarea } from 'primevue';
import { storeToRefs } from 'pinia';
import { useCouncilStore } from '@/stores/council';
import { useSessionStore } from '@/stores/session';
import { useCommon } from '@/composables/common';
import { onMounted, ref } from 'vue';

defineProps({
    form: Object,
    formType: {
        type: String,
        default: 'create'
    }
})

const { councils } = storeToRefs(useCouncilStore());
const { sessionTypes } = storeToRefs(useSessionStore());

const { getCouncils } = useCouncilStore();
const { getSessionTypes } = useSessionStore();

const { years } = useCommon();

const setFiles = (e, cb) => {
    cb(e.target.files);
}

onMounted(() => {
    (async () => {
        await getCouncils();
        await getSessionTypes();
    })();
})

</script>

<template>
    <div class="space-y-4">
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Council</label>
                <Select 
                    v-model="form.council_id"
                    class="w-full" 
                    :options="councils"
                    option-label="number"
                    option-value="id"
                    filter
                    placeholder="Select council"
                />
            </div>
            <div class="space-y-2 w-full">
                <label for="">Year</label>
                <Select 
                    v-if="formType === 'create'"
                    v-model="form.year"
                    class="w-full" 
                    :options="years" 
                    filter
                    placeholder="Select year"
                />
                <select v-if="formType === 'edit'" name="" id="" class="border border-zinc-500 bg-white dark:border-zinc-500 dark:bg-zinc-950 p-2 w-full">
                    <option :value="year" v-for="(year, index) in years" :key="index">
                        {{ year }}
                    </option>
                </select>
            </div>
        </div>
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Type</label>
                <Select 
                    :options="sessionTypes"
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
                    required
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
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Agenda</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.agenda = files)"
                />
            </div>
            <div class="space-y-2 w-full">
                <label for="">Minutes</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.minutes = files)"
                />
            </div>
        </div>
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Journal</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.journal = files)"
                />
            </div>
            <div class="space-y-2 w-full">
                <label for="">Audio</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.audio = files)"
                />
            </div>
        </div>
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Photos</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.photo = files)"
                />
            </div>
            <div class="space-y-2 w-full">
                <label for="">Attendance</label>
                <InputText 
                    type="file"
                    class="w-full"
                    multiple
                    @change="(e) => setFiles(e, (files) => form.attachment.attendance = files)"
                />
            </div>
        </div>
    </div>
</template>