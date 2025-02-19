<template>

<div  class="grid-row">
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="card-body">
            <h5 />
            <h6 />
        </div>
    </div>
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="card-body">
            <h5 />
            <h6 />
        </div>
    </div>
    <div class="card mb-1 mt-3">
        <div class="card-header" ></div>
        <div class="card-body">
            <h5 />
            <h6 />
        </div>
    </div>
</div>

</template>

<script setup>
import { ref } from 'vue'

// const isLoading = ref(true)

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