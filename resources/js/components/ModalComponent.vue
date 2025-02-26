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
                        <input v-model="formData.donator_name" type="name" class="form-control" id="name" name="donator_name" aria-describedby="name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input v-model="formData.email" type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="">
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input v-model="formData.amount" type="sum" class="form-control" id="amount" name="amount" value="">
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

const props = defineProps({
  isOpen: Boolean,
});

const emit = defineEmits(['close', 'saved']);

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
};

const submitForm = async () => {
  try {
    const response = await axios.post('/api/donations/store', formData.value);

    emit('saved', response.data);

    closeModal();
  } catch (error) {
    console.error('Error saving data:', error);
  }
};

</script>

<style>

</style>
