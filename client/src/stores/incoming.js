import { ref } from "vue";
import { defineStore } from "pinia";
import { useHttpIncoming } from "@/http/incoming";

const { getIncomingsRequest } = useHttpIncoming();

export const useIncomingStore = defineStore('incoming-store', () => {
    const incomings = ref([]);
    const isDataLoading = ref(false);

    const getIncomings = async (params) => {
        if (incomings.value.length === 0) {
            await fetchIncomings(params);
        }

        return incomings.value;
    }

    const fetchIncomings = async (params) => {
        const { data } = await getIncomingsRequest(params);
        
        incomings.value = data.incoming_communications;
    }

    return {
        incomings,
        isDataLoading,
        getIncomings,
        fetchIncomings,
    }
})