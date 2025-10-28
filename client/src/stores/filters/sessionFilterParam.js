import { defineStore } from "pinia";
import { ref, watch } from "vue";
import { useRouter, useRoute } from "vue-router";

export const useSessionFilterParamStore = defineStore('session-filter-param', () => {
    const router = useRouter();
    const route = useRoute();
    
    // Initialize params from URL query if they exist
    const params = ref(JSON.parse(sessionStorage.getItem('session-filter-param')) || {
        keyword: route.query.keyword || '',
        year: route.query.year || null,
        type_id: route.query.type_id || null,
        council_id: route.query.council_id || null,
    });

    // Watch for params changes and update URL
    watch(params, (newParams) => {
        // Remove null/empty values to keep URL clean
        const query = Object.fromEntries(
            Object.entries(newParams).filter(([_, value]) => value !== null && value !== '')
        );
        
        // Update URL without reloading the page
        router.replace({ query });

        sessionStorage.setItem('session-filter-param', JSON.stringify(newParams));
    }, { 
        deep: true ,
        immediate: true
    });

    

    /**
     * actions
     */
    const resetParams = () => {
        params.value = {
            keyword: '',
            year: null,
            type_id: null,
            council_id: null,
        };
        // Clear URL query parameters
        router.replace({ query: {} });
    };

    return {
        params,
        resetParams
    };
});