<script setup>

import { useCommon } from '@/composables/common';
import { Select, Button, InputText, FloatLabel, Textarea } from 'primevue';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';

defineProps({
    form: Object,
    formType: {
        type: String,
        default: () => 'create'
    },
    errors: {
        type: Object,
        default: () => {}
    }
})

const { years } = useCommon();

const classificationOptions = [
    'classification 1',
    'classification 2',
    'classification 3',
    'classification 4',
];

const requiredActionOptions = [
    'Action 1',
    'Action 2',
    'Action 3',
    'Action 4',
]

</script>

<template>
    <div class="space-y-4">
        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Classification</label>
                <Select 
                    class="w-full"
                    placeholder="Select classification"
                    filter
                    :options="classificationOptions"
                    v-model="form.classification"
                />
                <div class="mt-2" v-if="errors.classification?.length > 0">
                    <InputError :message="errors.classification[0]" />
                </div>
            </div>
            <div class="space-y-2 w-full">
                <label for="">Year</label>
                <Select 
                    class="w-full"
                    placeholder="Select year"
                    :options="years"
                    filter
                    v-model="form.year"
                />
                <div class="mt-2" v-if="errors.year?.length > 0">
                    <InputError :message="errors.year[0]" />
                </div>
            </div>
            
            
        </div>

        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Date Received</label>
                <InputText 
                    type="date"
                    class="w-full"
                    v-model="form.date_received"
                />
                <div class="mt-2" v-if="errors.date_received?.length > 0">
                    <InputError :message="errors.date_received[0]" />
                </div>
            </div>
            <div class="space-y-2 w-full">
                <label for="">Sender</label>
                <Textarea 
                    class="w-full"
                    placeholder="Input sender"
                    auto-resize
                    rows="1"
                    v-model="form.sender"
                />
                <div class="mt-2" v-if="errors.sender?.length > 0">
                    <InputError :message="errors.sender[0]" />
                </div>
            </div>
            
        </div>

        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Addressee</label>
                <Textarea 
                    class="w-full"
                    placeholder="Input addressee"
                    auto-resize
                    rows="1"
                    v-model="form.addressee"
                />
                <div class="mt-2" v-if="errors.addressee?.length > 0">
                    <InputError :message="errors.addressee[0]" />
                </div>
            </div>
            
            <div class="w-full space-y-2">
                <label for="">Reference No</label>
                <div class="flex gap-2">
                    <div class="space-y-1 w-full">
                        <FloatLabel variant="on">
                            <InputText 
                                class="w-full"
                                type="month"
                                v-model="form.month"
                            />
                            <label for="" class="text-xs text-zinc-500 dark:text-zinc-400">Month</label>

                        </FloatLabel>
                        <div class="mt-2" v-if="errors.month?.length > 0">
                    <InputError :message="errors.month[0]" />
                </div>
                    </div>
                    <div class="space-y-1 w-full">
                        <FloatLabel variant="on">
                            <InputText 
                                class="w-full"
                                type="number"
                                v-model="form.sequence_no"
                            />
                            <label for="" class="text-xs text-zinc-500 dark:text-zinc-400">Sequence No</label>

                        </FloatLabel>
                        <div class="mt-2" v-if="errors.sequence_no?.length > 0">
                            <InputError :message="errors.sequence_no[0]" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Subject</label>
                <Textarea 
                    class="w-full"
                    placeholder="Input subject"
                    auto-resize
                    rows="4"
                    v-model="form.subject"
                />
                <div class="mt-2" v-if="errors.subject?.length > 0">
                    <InputError :message="errors.subject[0]" />
                </div>
            </div>
        </div>

        <div class="flex gap-2">
            <div class="space-y-2 w-full">
                <label for="">Required Action</label>
                <Select 
                    :options="requiredActionOptions"
                    class="w-full"
                    placeholder="Select required action"
                    filter
                    v-model="form.required_action"
                />
                <div class="mt-2" v-if="errors.required_action?.length > 0">
                    <InputError :message="errors.required_action[0]" />
                </div>
            </div>
            <div class="space-y-2 w-full">
                <label for="">Remarks</label>
                <Textarea 
                    class="w-full"
                    auto-resize
                    rows="4"
                    placeholder="Input remarks"
                    v-model="form.remarks"
                />
                <div class="mt-2" v-if="errors.remarks?.length > 0">
                    <InputError :message="errors.remarks[0]" />
                </div>
            </div>
        </div>
    </div>
</template>