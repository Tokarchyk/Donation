<template>

<div v-if="loading">
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="d-flex justify-content-center card-body">
            <h5 class="spinner-grow" role="status"></h5>
            <h6></h6>
        </div>
    </div>
</div>

<div v-else class="card text-white bg-info mb-1 text-center mt-3">
    <div class="card-header">{{ title }}</div>
    <div class="card-body">
        <h5 class="card-title">{{ amount }}</h5>
        <h6 class="card-text">{{ email }}</h6>
    </div>
</div>

</template>

<script setup>

import { ref, onMounted } from 'vue'

const loading = ref(true)

const props = defineProps({
    title: String,
    amount: Number,
    email: String,
});

onMounted(() => {
  setTimeout(() => {
    loading.value = false;
  }, 2000); 
});

</script>

<style scoped>

.card {
    background-color: transparent;
    height: 135px;
}

</style>