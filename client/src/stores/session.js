import { defineStore } from "pinia";
import { ref, watch } from "vue";
import { useHttpSession } from "@/http/session";

const { getSessionsRequest, getSessionTypesRequest } = useHttpSession();

export const useSessionStore = defineStore('session', () => {
    const sessions = ref([]);
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

    const deleteSession = async (session) => {
        const index = sessions.value.findIndex(s => s.id === session.id);
        if (index > -1) {
            sessions.value.splice(index, 1);
        }
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
        sessions,
        sessionTypes,
        getSessions,
        fetchSessions,
        deleteSession,
        getSessionTypes
    }
})