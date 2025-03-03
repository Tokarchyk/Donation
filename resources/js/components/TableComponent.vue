<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue'
import SortableComponent from './SortableComponent.vue';
import ModalComponent from './ModalComponent.vue';

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

const fetchDonations = async (column = sortColumn.value, order = sortOrder.value) => {
    try {
        sortColumn.value = column;
        sortOrder.value = order;

        const response = await axios.get(`/api/donations`, {
            params: {
                sortBy: sortColumn.value,
                sortOrder: sortOrder.value,
            },
        });

        donations.value = response.data;

    } catch (error) {
        console.error('Error fetching donations:', error);
    }
};

const handleSort = ({ column, order }) => {
    fetchDonations(column, order);
};

//--- DELETE METHOD ---

const deleteDonation = async (id) => {
    try {
        await axios.delete(`/api/donations/${id}`)
        getDonations();
    } catch (error) {
        console.error(error.message);
    }
}

//  --- MODAL WINDOW METHOD ---

const isModalOpen = ref(false);
const successMessage = ref('');

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const handleSaved = () => {
    successMessage.value = 'Thank you for your donation.';
    setTimeout(() => {
    successMessage.value = '';
    }, 3000);

};

const deleteOldDonation = async () => {
    const response = await axios.get(`/api/donations/job`)
    console.log(response);
}

onMounted(() => {
    getDonations(),
    fetchDonations()
})

</script>

<template>

<!-- Button trigger modal -->
<div>
    <button @click="openModal"
        type="button"
        class="btn btn-primary w-25 mt-4 d-grid gap-2 col-6 mx-auto mb-3"
        data-bs-target="#exampleModal"
    >
    Donate Now 
    </button>

    <ModalComponent :isOpen="isModalOpen" @close="closeModal" @success-message="handleSaved"></ModalComponent>

    <div v-if="successMessage" class="success-message">
        {{ successMessage }}
    </div>
</div>
    <!-- EXAMPLE JOB -->

<button @click="deleteOldDonation"
        type="button"
        class="btn btn-outline-dark w-25 mt-4 d-grid gap-2 col-6 mx-auto mb-3">
        Delete Old Donation
</button>

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
                <SortableComponent
                    column="donator_name"
                    :sortColumn="sortColumn"
                    :sortOrder="sortOrder"
                    @update-sort="handleSort"
                >
                Name
                </SortableComponent>
                <SortableComponent
                    column="email"
                    :sortColumn="sortColumn"
                    :sortOrder="sortOrder"
                    @update-sort="handleSort"
                >
                Email
                </SortableComponent>
                <SortableComponent
                    column="amount"
                    :sortColumn="sortColumn"
                    :sortOrder="sortOrder"
                    @update-sort="handleSort"
                >
                Amount
                </SortableComponent>
                <th scope="col">Message</th>
                <SortableComponent
                    column="date"
                    :sortColumn="sortColumn"
                    :sortOrder="sortOrder"
                    @update-sort="handleSort"
                >
                Date
                </SortableComponent>
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

.success-message {
  margin-top: 20px;
  padding: 10px;
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
  border-radius: 4px;
}

</style>
