import { defineStore } from "pinia";
import { ref } from "vue";
import { useHttpCouncil } from "@/http/council";

export const useCouncilStore = defineStore('council-store', () => {

    const { getCouncilsRequest } = useHttpCouncil();

    const councils = ref([]);

    const getCouncils = async () => {

        if (councils.value.length === 0) {
            // Fetch councils from API or other source
            const data = await getCouncilsRequest();
            
            councils.value = data.councils;
        }

        return councils.value;
    } 

    function setCouncils(data) {
        councils.value = data;
    }

    return {
        councils,
        setCouncils,
        getCouncils,
    }
});