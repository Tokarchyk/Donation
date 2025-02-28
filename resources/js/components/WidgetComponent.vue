<template>

    <div class="grid-row">
        <CardComponent
            v-for="value in values"
                :key="value.id"
                :title="value.title"
                :amount="value.amount"
                :email="value.email"
            />
    </div>

</template>

<script setup>

import axios from 'axios';
import { onMounted, ref } from 'vue'
import CardComponent from './CardComponent.vue';

const values = ref([
    [],
    [],
    [],
]);

//--- GET VALUES FROM SERVICES ---

const getValues = async () => {
    try {
        const response = await axios.get(`/api/donations/widget`)
        values.value = response.data;
    }   catch (error) {
    console.error('Error fetching donations:', error)
    }
}

onMounted(() => {
    getValues()
})

</script>

<style scoped>

.grid-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

</style>
