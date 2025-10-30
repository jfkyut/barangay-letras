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
import FileAttachment from '@/components/FileAttachment.vue';
import EditSessionModal from './session_partials/EditSessionModal.vue';
import DeleteSessionModal from './session_partials/DeleteSessionModal.vue';

const { getSessionsRequest } = useHttpSession();

const { sessions, isDataLoading } = storeToRefs(useSessionStore());
const { fetchSessions } = useSessionStore();

const { params } = storeToRefs(useSessionFilterParamStore());


const { convertToOrdinal, redirectToNewTab } = useCommon();

const handleFilter = async (filterParams) => {
    
    isDataLoading.value = true;

    await fetchSessions(filterParams);

    isDataLoading.value = false;
}

const handlePageChange = async (pageParams) => {
    isDataLoading.value = true;

    await fetchSessions(pageParams);

    isDataLoading.value = false;
}

onMounted(() => {
    (async () => {
        isDataLoading.value = true;

        const { data } = await getSessionsRequest(params.value);

        isDataLoading.value = false;

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
                :loading="isDataLoading"
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
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Agenda">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'agenda')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Minutes">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'minutes')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Journal">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'journal')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Audio">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'audio')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Photos">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'photo')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" header="Attendance">
                    <template #body="slotProps">
                        <div>
                            <ul class="space-y-2">
                                <li v-for="(file, index) in slotProps.data?.attachments?.filter(a => a?.type?.name === 'attendance')" :key="index" class="whitespace-pre-wrap ">
                                    <FileAttachment 
                                        :file="file"
                                    />
                                </li>
                            </ul>
                        </div>
                    </template>
                </Column>
                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" sortable field="remarks" header="Remarks"></Column>

                <Column header-class="sticky top-0" class="w-[200px] md:w-[400px]" :frozen="true" align-frozen="right" header="Action">
                    <template #body="slotProps">
                        <div class="flex flex-col gap-2">
                            <EditSessionModal :session="slotProps.data" />
                            <DeleteSessionModal :session="slotProps.data" />
                        </div>
                    </template>
                </Column>

                <template #empty>
                    <div class="text-zinc-500">
                        Empty
                    </div>
                </template>

            </DataTable>

            <div class="mt-2" v-if="sessions.links?.length > 3">
                <Paginator 
                    :links="sessions.links" 
                    :params="params"
                    @page-change="handlePageChange"
                />
            </div>
        </template>
    </Container>
</template>