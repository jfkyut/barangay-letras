<script setup>
import Container from '@/components/Container.vue';
import SearchForm from '@/components/SearchForm.vue';
import { Button, DataTable, Column } from 'primevue';
import CreateIncomingModal from './incoming-partials/CreateIncomingModal.vue';
import { storeToRefs } from 'pinia';
import { useIncomingStore } from '@/stores/incoming';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

const { incomings, isDataLoading } = storeToRefs(useIncomingStore());
const { getIncomings } = useIncomingStore();

const route = useRoute();

onMounted(() => {
    (async () => {
        await getIncomings(route.params);
    })();
})

</script>

<template>
    <Container>
        <template #header>
            <div class="flex items-center justify-between">
                <SearchForm>
                    
                </SearchForm>
                <div class="gap-2 flex items-center">
                    <CreateIncomingModal />
                </div>
            </div>
        </template>
        <template #body>
            <DataTable
                :loading="isDataLoading"
                :value="incomings.data"
                responsiveLayout="scroll"
                :striped-rows="true"
                filter
                removable-sort
                resizableColumns 
                columnResizeMode="fit" 
                showGridlines 
                tableStyle="min-width: 50rem"
                scrollable
                scrollHeight="70vh"
            >
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="reference_no" header="Reference No."></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="year" header="Year"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="date_received" header="Date Received"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="subject" header="Subject"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="sender" header="Sender"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="addressee" header="Addressee"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="required_action" header="Required Action"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="remarks" header="Remarks"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable header="Attachments"></Column>

                <Column frozen align-frozen="right" header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable header="Action">
                    <template #body="slotProps">
                        <div class="flex flex-col gap-2">
                            <Button
                                variant="outlined"
                            >
                                <i class="ri-edit-line"></i>
                                <span>Edit</span>
                            </Button>
                            <Button
                                variant="outlined"
                                severity="danger"
                            >
                                <i class="ri-delete-bin-line"></i>
                                <span>Delete</span>
                            </Button>
                        </div>
                    </template>
                </Column>

                <template #empty>
                    Empty
                </template>
            </DataTable>
        </template>
    </Container>
</template>