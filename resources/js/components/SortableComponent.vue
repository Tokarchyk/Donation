<template>

<th  @click="sortDonations" scope="col">
    <slot></slot>
    <span v-if="sortColumn === column">
        {{ sortOrder === "asc" ? '▲' : '▼' }}
    </span>
</th>

</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// --- SORTED METHOD ---

const props = defineProps({
    column: String,
    sortColumn: String,
    sortOrder: String,
});

const emit = defineEmits(['update-sort']);

const sortDonations = () => {
    let newSortOrder = 'asc';

    if (props.sortColumn === props.column) {
        newSortOrder = props.sortOrder === 'asc' ? 'desc' : 'asc';
    }

    emit('update-sort', {
        column: props.column,
        order: newSortOrder,
    });
};

</script>
