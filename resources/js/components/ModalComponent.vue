<template>

<div v-show="isOpen" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fill out the form</h1>
                <button @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form @submit.prevent="submitForm" class="w-50 mt-2 m-auto">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label ">Name</label>
                        <input v-model="formData.donator_name" type="name" class="form-control" id="name" name="donator_name" aria-describedby="name" >
                        <span class="error" v-if="errors.donator_name">{{ errors.donator_name[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input v-model="formData.email" type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" >
                        <span class="error" v-if="errors.email">{{ errors.email[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input v-model="formData.amount" type="sum" class="form-control" id="amount" name="amount" >
                        <span class="error" v-if="errors.amount">{{ errors.amount[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Message</label>
                        <input v-model="formData.message" type="text" class="form-control" id="text" name="message">
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send a donation</button>
                </div>
            </form>
        </div>
    </div>
</div>

</template>

<script setup>
import axios from 'axios';
import { ref, defineProps, defineEmits, watch, onMounted } from 'vue';
import { Modal } from 'bootstrap';

const errors = ref({})

const props = defineProps({
    isOpen: Boolean,
});

const emit = defineEmits(['close', 'saved', 'success-message']);

const formData = ref({
    donator_name: '',
    email: '',
    amount: 0,
    message: '',
});

let modal;

onMounted(() => {
    const modalElement = document.getElementById('myModal');
    modal = new Modal(modalElement);
});

watch(
    () => props.isOpen,
    (newValue) => {
        if (modal) {
            if (newValue) {
                modal.show();
            } else {
                modal.hide();
            }
        }
    }
);

const closeModal = () => {
    emit('close');
    resetForm();
};

const resetForm = () => {
    formData.value = {
        donator_name: '',
        email: '',
        amount: 0,
        message: '',
    };
    errors.value = {};
};

const submitForm = async () => {
    try {
        errors.value = {};
        const response = await axios.post('/api/donations/store', formData.value);
        console.log('Success save data:', response.data);
        emit('saved', response.data);
        emit('success-message', response.data.message);
        closeModal();
    } catch (error) {
        if (error.response && error.response.status === 404) {
            errors.value = error.response.data.errors;
            alert(error.response.data.message);
        } else {
            console.error('Error saving data:', error);
        }
    }
};

</script>

<style>

.error {
  color: red;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

</style>
