<script setup>

import { Button, Checkbox } from 'primevue';
import { onMounted, ref, computed } from 'vue';
import DropdownMenu from '@/components/dropdowns/DropdownMenu.vue';
import DropdownButton from '@/components/dropdowns/DropdownButton.vue';
import { storeToRefs } from 'pinia';
import { useCouncilStore } from '@/stores/council';
import { useCommon } from '@/composables/common';
import { useSessionFilterParamStore } from '@/stores/filters/sessionFilterParam';
import { useHttpSession } from '@/http/session';
import { useRoute } from 'vue-router';

const emit = defineEmits(['filter']);

const route = useRoute();

const isShowDropdown = ref(false);
const isShowCouncil = ref(false);
const isShowYearDropdown = ref(false);
const isShowSessionType = ref(false);

const { councils } = storeToRefs(useCouncilStore());
const { getCouncils } = useCouncilStore();

const { getSessionTypesRequest } = useHttpSession();
const sessionTypeOptions = ref([]);

const { params } = storeToRefs(useSessionFilterParamStore());
const { resetParams } = useSessionFilterParamStore();

const { years, convertToOrdinal } = useCommon();

const filterSpecific = (cb) => {
    cb();

    console.log(params.value);

    emit('filter', params.value);
}

onMounted(() => {
    (async () => {
        await getCouncils();

        const { session_types } = await getSessionTypesRequest(); 

        sessionTypeOptions.value = session_types;
    })();
})

</script>

<template>
    <div class="relative">
        <Button 
            severity="secondary"
            @mouseover="isShowDropdown = true"
            @mouseout="isShowDropdown = false"
        >
            <i class="ri-filter-line"></i>
        </Button>

        <DropdownMenu 
            :show="isShowDropdown"
            @mouseover="isShowDropdown = true"
            @mouseout="isShowDropdown = false"
            position="top-10"
        >

            <!-- council -->
            <DropdownButton
                @mouseover="isShowCouncil = true"
                @mouseout="isShowCouncil = false"
                class="relative"
            >
                Council

                <DropdownMenu
                    position="top-0 left-[102%] max-h-[400px] overflow-y-auto"
                    :show="isShowCouncil"
                    @mouseover="isShowCouncil = true"
                    @mouseout="isShowCouncil = false"
                >
                    <DropdownButton @click="filterSpecific(() => params.council_id = council?.id)" v-for="(council, index) in councils" :key="index" class="flex justify-between">
                        <span>{{ convertToOrdinal(council?.number) }} Council</span>
                        <Checkbox :model-value="params.council_id === council?.id" binary />
                    </DropdownButton>
                </DropdownMenu>
            </DropdownButton>
            <!-- council end -->

            <!-- years -->
            <DropdownButton
                @mouseover="isShowYearDropdown = true"
                @mouseout="isShowYearDropdown = false"
                class="relative"
            >
                Years

                <DropdownMenu
                    :show="isShowYearDropdown"
                    @mouseover="isShowYearDropdown = true"
                    @mouseout="isShowYearDropdown = false"
                    position="top-0 left-[102%] max-h-[400px] overflow-y-auto"
                >
                    <DropdownButton @click="() => filterSpecific(() => params.year = year)" v-for="(year, index) in years" :key="index" class="flex justify-between">
                        <span>{{ year }}</span>
                        <Checkbox :model-value="params.year === year" binary />
                    </DropdownButton>
                </DropdownMenu>
            </DropdownButton>
            <!-- years end -->

            <!-- session type -->
            <DropdownButton
                @mouseover="isShowSessionType = true"
                @mouseout="isShowSessionType = false"
                class="relative"
            >
                Type

                <DropdownMenu
                    position="top-0 left-[102%] max-h-[400px] overflow-y-auto"
                    :show="isShowSessionType"
                    @mouseover="isShowSessionType = true"
                    @mouseout="isShowSessionType = false"
                >
                    <DropdownButton @click="() => filterSpecific(() => params.type_id = type.id)" v-for="(type, index) in sessionTypeOptions" :key="index" class="flex justify-between">
                        <span>{{ type?.name }}</span>
                        <Checkbox 
                            :model-value="params.type_id === type.id"
                            binary
                        />
                    </DropdownButton>
                </DropdownMenu>
            </DropdownButton>
            <DropdownButton @click="() => filterSpecific(() => resetParams())" class="flex justify-between">
                <span>Reset Filter</span>
                <i class="ri-filter-off-line"></i>
            </DropdownButton>
        </DropdownMenu>
    </div>
</template>