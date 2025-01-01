<template>
    <div>
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard! You're successfully logged in.</p>
        <button @click="logout" class="logout-button">Logout</button>

        <h2>Transportation List</h2>
        <table border="1" class="transport-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle Number</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Route</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transport in transportations" :key="transport.id">
                    <td>{{ transport.id }}</td>
                    <td>{{ transport.vehicle_number }}</td>
                    <td>{{ transport.type }}</td>
                    <td>{{ transport.capacity }}</td>
                    <td>{{ transport.route }}</td>
                    <td>{{ transport.status }}</td>
                    <td>{{ transport.created_at }}</td>
                    <td>{{ transport.updated_at }}</td>
                    <td>
                        <button @click="deleteTransportation(transport.id)" class="delete-button">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import apiClient from '@/axios'; // Ensure your axios.js file is correctly configured

const router = useRouter();
const transportations = ref([]);

// Fetch transportation data
const fetchTransportations = async () => {
    try {
        const response = await apiClient.get('/transportations');
        transportations.value = response.data; // Adjust this if your response structure is different
    } catch (error) {
        console.error('Error fetching transportation data:', error);
    }
};

// Delete transportation by ID
const deleteTransportation = async (id) => {
    try {
        await apiClient.delete(`/transportations/${id}`);
        alert('Transportation deleted successfully!');
        fetchTransportations(); // Refresh the data after deletion
    } catch (error) {
        console.error('Error deleting transportation:', error);
    }
};

// Logout user
const logout = () => {
    localStorage.removeItem('token'); // Clear token from storage
    router.push('/login'); // Redirect to login page
};

// Fetch data when component is mounted
onMounted(() => {
    fetchTransportations();
});
</script>

<style scoped>
h1 {
    color: #4caf50;
}

.logout-button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.logout-button:hover {
    background-color: #d32f2f;
}

h2 {
    margin-top: 30px;
    color: #333;
}

.transport-table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    text-align: left;
}

.transport-table th,
.transport-table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.transport-table th {
    background-color: #f2f2f2;
}

.delete-button {
    padding: 5px 10px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.delete-button:hover {
    background-color: #d32f2f;
}
</style>

  
  
