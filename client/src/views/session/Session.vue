<script setup>

import Container from '@/components/Container.vue';
import SearchForm from '@/components/SearchForm.vue';
import { Button, DataTable, Column } from 'primevue';
import CreateSessionModal from './session_partials/CreateSessionModal.vue';
import { onMounted, ref } from 'vue';
import { useHttpSession } from '@/http/session';
import { storeToRefs } from 'pinia';
import { useSessionStore } from '@/stores/session';
import { useSessionFilterParamStore } from '@/stores/filters/sessionFilterParam';
import SessionFilterDropdown from './session_partials/SessionFilterDropdown.vue';
import { useCommon } from '@/composables/common';
import Paginator from '@/components/Paginator.vue';

const { getSessionsRequest } = useHttpSession();

const { sessions } = storeToRefs(useSessionStore());
const { fetchSessions } = useSessionStore();

const { params } = storeToRefs(useSessionFilterParamStore());

const isTableLoading = ref(false);

const { convertToOrdinal } = useCommon();

const handleFilter = async (filterParams) => {
    
    isTableLoading.value = true;

    await fetchSessions(filterParams);

    isTableLoading.value = false;
}

const handlePageChange = async (pageParams) => {
    isTableLoading.value = true;

    await fetchSessions(pageParams);

    isTableLoading.value = false;
}

onMounted(() => {
    (async () => {
        isTableLoading.value = true;

        const { data } = await getSessionsRequest(params.value);

        isTableLoading.value = false;

        sessions.value = data.sessions;
    })();
});

</script>

<template>
    <Container>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <SearchForm
                        :params="params"
                        @filter="handleFilter"
                    >
                        <template #dropdown>
                            <!-- You can add dropdown filters here in the future -->
                            <SessionFilterDropdown 
                                :params="params" 
                                @filter="handleFilter"
                            />
                        </template>
                    </SearchForm>
                </div>

                <!-- buttons -->
                <div class="flex items-center gap-">
                    <CreateSessionModal />
                </div>
            </div>
        </template>
        <template #body>
            <DataTable
                :value="sessions.data"
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
                :loading="isTableLoading"
            >
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable header="Council">
                    <template #body="slotProps">
                        {{ convertToOrdinal(slotProps.data.council?.number) }} Council
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="year" header="Year"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="session_no" header="Session No."></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="type.name" header="Type"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="date" header="Date"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="remarks" header="Remarks"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Agenda"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Minutes"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Journal"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Audio"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Photos"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Attendance"></Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" :frozen="true" align-frozen="right" header="Action">
                    <template #body="slotProps">
                        <Button icon="ri-pencil-line" class="p-button-text p-button-sm" />
                        <Button icon="ri-delete-bin-6-line" class="p-button-text p-button-sm p-button-danger" />
                    </template>
                </Column>

                <template #empty>
                    <div class="text-zinc-500">
                        Empty
                    </div>
                </template>

            </DataTable>

            <div class="mt-2">
                <Paginator 
                    :links="sessions.links" 
                    :params="params"
                    @page-change="handlePageChange"
                />
            </div>
        </template>
    </Container>
</template>