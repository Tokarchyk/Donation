import { ref } from 'vue'
import axios from "axios";

export default function useDonations() {
        const donations = ref([])

        const getDonations = async (page) => {
                axios.get('/api/donations?page=' + page)
                .then(response => {
                        donations.value = response.data;
                })
        }
        return { donations, getDonations }
}