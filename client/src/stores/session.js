import { defineStore } from "pinia";
import { ref, watch } from "vue";
import { useHttpSession } from "@/http/session";

const { getSessionsRequest, getSessionTypesRequest } = useHttpSession();

export const useSessionStore = defineStore('session', () => {
    const sessions = ref([]);
    const isDataLoading = ref(false);
    const sessionTypes = ref([]);

    const getSessions = async (params) => {
        if (sessions.value.length === 0) {
            await fetchSessions(params);
        }

        return sessions.value;
    }

    const fetchSessions = async (params) => {
        const { data } = await getSessionsRequest(params);
        
        sessions.value = data.sessions;
    }

    // session types
    const getSessionTypes = async () => {
        if (sessionTypes.value.length === 0) {
            const { session_types } = await getSessionTypesRequest();

            sessionTypes.value = session_types;
        }

        return sessionTypes.value;
    }

    return {
        isDataLoading,
        sessions,
        sessionTypes,

        getSessions,
        fetchSessions,
        getSessionTypes
    }
})