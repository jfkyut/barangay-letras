<script setup>

import Container from '@/components/Container.vue';
import { useProfileStore } from '@/stores/profile';
import { Button, DataTable, Column, ColumnGroup } from 'primevue';

const { user } = useProfileStore();

</script>

<template>
  <div>
    Welcome home {{ user.name }}

    <!-- <Button severity="contrast">
      test
    </Button> -->

    <Container>
      <template #header>
      
      </template>
      <template #body>
        <DataTable
          :value="[1,2,3,4]"
          scrollable 
          removable-sort
          scrollHeight="400px"
          show-gridlines
          striped-rows
          :loading="false"
        >
          <Column header="Test">
            <template #body="">
              test adasdasd
            </template>
          </Column>
          <Column header="Test">
            <template #body="">
              test adasdasd
            </template>
          </Column>
          <Column header="Test">
            <template #body="">
              test adasdasd
            </template>
          </Column>
          <Column header="Test">
            <template #body="">
              test adasdasd
            </template>
          </Column>
        </DataTable>
      </template>
    </Container>

    <div class="p-2">
      
    </div>
  </div>
</template>