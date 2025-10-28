<script setup>
import SecondaryButton from '@/components/buttons/SecondaryButton.vue';
import DangerButton2 from '@/components/buttons/DangerButton2.vue';
import DangerModal from '@/components/modals/DangerModal.vue';
import { ref, toRefs } from 'vue';
import { useToast } from 'vue-toastification';
import axios from 'axios';
import { Button } from 'primevue';

const props = defineProps({
    attachment: Object,
    deleteRoute: String,
    isAudio: {
        type: Boolean,
        default: false
    },
    // Add prop for checking user role
    userRole: String
});

const { attachment, deleteRoute, isAudio, userRole } = toRefs(props);

const isShowOptionList = ref(false);
const isFileLoaded = ref(false);
const isShowDeleteModal = ref(false);

const toast = useToast();

const copyLink = async (textLink) => {
    try {
        await navigator.clipboard.writeText(textLink);
        console.log("Text copied to clipboard!");
        alert("Link copied to clipboard!");
    } catch (err) {
        console.error("Failed to copy text: ", err);
        if (!navigator.clipboard) {
            copyTextFallback(textLink);
        } else {
            if (navigator.permissions && navigator.permissions.query) {
                try {
                    const permission = await navigator.permissions.query({ name: 'clipboard-write' });
                    if (permission.state === 'denied') {
                        console.log('Clipboard access denied. Please allow clipboard access in your browser settings.');
                    } else {
                        console.log("Copying to clipboard failed. Please try again.");
                    }
                } catch (permissionErr) {
                    console.error("Permission query error: ", permissionErr);
                    console.log("Copying to clipboard failed. Please try again.");
                }
            } else {
                console.log("Copying to clipboard failed. Please try again.");
            }
        }
    }
};

function copyTextFallback(text) {
    const tempInput = document.createElement('textarea');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            console.log('Text copied successfully (fallback)');
            alert("Link copied to clipboard!");
        } else {
            console.error('Unable to copy text (fallback)');
            alert("Copying to clipboard failed. Please try again.");
        }
    } catch (err) {
        console.error('Error copying text (fallback):', err);
        alert("Copying to clipboard failed. Please try again.");
    } finally {
        document.body.removeChild(tempInput);
    }
}

const deleteFile = async () => {
    try {
        await axios.delete(deleteRoute.value);
        toast.success('File deleted.');
        // Emit event to parent to update the file list
        emit('file-deleted');
    } catch (error) {
        toast.error('Error while deleting file.');
        console.error('Delete error:', error);
    }
};

const toggleOptions = () => {
    isShowOptionList.value = !isShowOptionList.value;
    if (isShowOptionList.value) {
        isFileLoaded.value = true;
    }
};

const emit = defineEmits(['file-deleted']);
</script>

<template>
    <Button severity="secondary" @click="toggleOptions" class="truncate max-w-[200px]" :title="attachment?.file_name">
        <span class="text-sm">
            {{ attachment?.file_name }}attachment name
        </span>
    </Button>

    <ul v-if="isShowOptionList" class="mt-2 pl-8 space-y-1 text-xs">
        <li v-if="isFileLoaded">
            <Button severity="secondary" v-if="!isAudio" @click="$refs.linkPathRef.click()" class="w-full text-start text-xs">
                <i class="ri-external-link-line"></i>
                <span class="ms-2 text-sm">Open</span>
            </Button>

            <audio v-if="isAudio" :src="attachment?.path" controls></audio>
        </li>
        <li v-if="isFileLoaded">
            <Button severity="secondary" @click="copyLink(attachment?.path)" class="w-full text-start">
                <i class="ri-link"></i>
                <span class="ms-2 text-sm">Copy link</span>
            </Button>
        </li>
        <li v-if="isFileLoaded && (userRole === 'administrator' || userRole === 'developer')">
            <Button severity="danger" @click="isShowDeleteModal = true" class="w-full text-start">
                <i class="ri-delete-bin-line"></i>
                <span class="ms-2 text-sm">Delete</span>
            </Button>
            <!-- <DangerModal
                :show="isShowDeleteModal"
                @onConfirm="deleteFile"
                @onCancel="isShowDeleteModal = false"
                :title='`Are you sure you want to delete "${attachment?.file_name}"`'
            /> -->
        </li>
    </ul>

    <a
        v-if="isFileLoaded"
        ref="linkPathRef"
        target="_blank"
        :href="attachment?.path"
        class="hover:text-emerald-500 sr-only"
    >
        file link
    </a>
</template>