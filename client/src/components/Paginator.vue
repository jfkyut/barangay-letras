<script setup>
import { useRouter } from 'vue-router';
import { useHttpSession } from '@/http/session';
import { useSessionStore } from '@/stores/session';
import { storeToRefs } from 'pinia';

const props = defineProps({ 
    links: Array, 
    params: Object 
});

const router = useRouter();

const emit = defineEmits(['page-change']);

// Transform object to query params
const objectToParams = (obj, parentKey = '') => {
    return Object.entries(obj)
        .filter(([key, value]) => value !== null && value !== undefined)
        .map(([key, value]) => {
            const fullKey = parentKey ? `${parentKey}[${key}]` : key;
            if (typeof value === 'object' && !Array.isArray(value)) {
                return objectToParams(value, fullKey);
            } else {
                return `${encodeURIComponent(fullKey)}=${encodeURIComponent(value)}`;
            }
        })
        .filter(Boolean)
        .join('&');
};

// Handle pagination click
const handlePaginationClick = async (url) => {
    if (!url) return;

    // Extract page number from URL
    const pageMatch = url.match(/page=(\d+)/);
    const page = pageMatch ? pageMatch[1] : 1;

    // Update URL without triggering route change
    const currentQuery = { ...router.currentRoute.value.query };
    router.replace({ 
        query: { 
            ...currentQuery,
            page 
        }
    });

    emit('page-change', { 
        ...props.params, 
        page 
    });
};
</script>

<template>
    <nav>
        <ul class="flex items-center -space-x-px h-8 text-sm">
            <li v-for="(link, index) in links" :key="index">
                <button
                    @click="handlePaginationClick(link.url)"
                    :disabled="!link.url"
                    :class="[
                        index === 0
                            ? 'rounded-s-lg'
                            : index === links.length - 1
                            ? 'rounded-e-lg'
                            : '',
                        link.active === true
                            ? 'flex items-center justify-center px-3 h-8 text-emerald-600 border border-zinc-300 bg-emerald-50 hover:bg-emerald-100 hover:text-emerald-700 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white'
                            : 'flex items-center justify-center px-3 h-8 leading-tight text-zinc-500 bg-white border border-zinc-300 hover:bg-zinc-100 hover:text-zinc-700 dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-white',
                        !link.url ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
                    ]"
                >
                    <span v-html="link.label" class="truncate"></span>
                </button>
            </li>
        </ul>
    </nav>
</template>