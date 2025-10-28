<script setup>

import Container from '@/components/Container.vue';
import { useProfileStore } from '@/stores/profile';
import { Button, DataTable, Column, ColumnGroup } from 'primevue';

const { user } = useProfileStore();

</script>

<template>
  Welcome home {{ user.name }}
</template>