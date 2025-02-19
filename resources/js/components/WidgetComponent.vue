<template>

<div v-if="isLoading" class="grid-row">
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="d-flex justify-content-center card-body">
            <h5 class="spinner-grow" role="status" />
            <h6 />
        </div>
    </div>
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class=" d-flex justify-content-center card-body">
            <h5 class="spinner-grow" role="status" />
            <h6 />
        </div>
    </div>
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="d-flex justify-content-center card-body">
            <h5 class="spinner-grow" role="status" />
            <h6 />
        </div>
    </div>
</div>

<div  class="grid-row">
    <div v-for="value in values" :key="value.id" class="card text-white bg-info mb-1 text-center mt-3">
        <div class="card-header">{{ value.title }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ value.amount }}</h5>
            <h6 class="card-text">{{ value.email }}</h6>
        </div>
    </div>
</div>

</template>

<script setup>

import axios from 'axios';
import { onMounted, ref } from 'vue'

const values = ref([]);
const isLoading = ref(true)

//--- GET VALUES FROM SERVICES ---

const getValues = async () => {
    try {
        const response = await axios.get(`/api/donations/widget`)
        values.value = response.data;
        isLoading.value = false
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

.card {
    background-color: transparent;
    height: 135px;
}

</style>
