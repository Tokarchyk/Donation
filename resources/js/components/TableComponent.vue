<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue'

const donations = ref([])
const searchQuery = ref('')

const sortColumn = ref('')
const sortOrder = ref('asc')

const isLoading = ref(true)


//--- GET ALL RECORDS FROM DATABASE METHOD ---

const getDonations = async (page) => {
    try {
        const response = await axios.get(`/api/donations?page=${page}`)
        donations.value = response.data
        isLoading.value = false
    }   catch (error) {
    console.error('Error fetching donations:', error)
    }
}

//--- SEARCH METHOD ---

const getSearchDonations = async () => {
    try {
        const response = await axios.get(`/api/donations`, {params: {search: searchQuery.value }})
        donations.value = response.data;
    }   catch (error) {
    console.error('Error fetching donations:', error)
    }
}

// --- SORTED METHOD ---

const sortDonations = async (column) => {
    try {
        if (sortColumn.value === column) {
            sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn.value = column;
            sortOrder.value = 'asc';
        }
        const response = await axios.get(`/api/donations`, {
            params: {
                sortBy: sortColumn.value,
                sortOrder: sortOrder.value
            }
        })
        donations.value = response.data; 
    } catch (error) {
    console.error('Error fetching donations:', error)
    }
}

//--- DELETE METHOD ---

const deleteDonation = async (id) => {
    try {
        await axios.delete(`/api/donations/${id}`)
        getDonations();
    } catch (error) {
        console.error(error.message);
    }
}

onMounted(() => {
  getDonations()
})

</script>
<template>
    
    <div class="d-flex justify-content-between pb-2 mb-2">
        <input 
            v-model="searchQuery"
            @input="getSearchDonations"
            type="text"
            class="form-control me-2"
            placeholder="Search here"
        />           
    </div>
    <div>
        <div v-if="isLoading" class="d-flex justify-content-center">    
            <div  class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>    
        <table v-else class="table table-striped">
        <thead>
        <tr>
            <th @click="sortDonations('donator_name')" scope="col">
                Name
                <span v-if="sortColumn === 'donator_name'">
                    {{ sortOrder === "asc" ? '▲' : '▼' }}
                </span>
            </th>
            <th @click="sortDonations('email')" scope="col">
                Email
                <span v-if="sortColumn === 'email'">
                    {{ sortOrder === 'asc' ? '▲' : '▼' }}
                </span>
            </th>
            <th @click="sortDonations('amount')" scope="col">
                Amount
                <span v-if="sortColumn === 'amount'">
                    {{ sortOrder === 'asc' ? '▲' : '▼' }}
                </span>
            </th>
            <th scope="col">Message</th>
            <th @click="sortDonations('date')" scope="col">
                Data
                <span v-if="sortColumn === 'date'">
                    {{ sortOrder === 'asc' ? '▲' : '▼' }}
                </span>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="donation in donations.data" :key="donation.id">
            <td>{{ donation.donator_name }}</td>
            <td>{{ donation.email }}</td>
            <td>{{ donation.amount }}</td>
            <td>{{ donation.message }}</td>
            <td>{{ donation.date }}</td>
            <td>
                <form method="GET" :action="`/donations/${donation.id}/edit`">
                    <button class="btn btn-outline-success" tittle="Edit">
                        <i class="bi bi-arrow-repeat"></i>
                    </button>
                </form>
            </td>
            <td>
                <button @click="deleteDonation(donation.id)" class="btn btn-outline-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="donations" @pagination-change-page="getDonations" />
</div>
</template>

<style scoped>

</style>
