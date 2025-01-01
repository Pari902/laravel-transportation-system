<template>
    <div>
      <h1>Admin Dashboard</h1>
      <button @click="createTransportation">Add Transportation</button>
      <table border="1">
        <thead>
          <tr>
            <th>ID</th>
            <th>Vehicle Number</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Route</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="transportation in transportations" :key="transportation.id">
            <td>{{ transportation.id }}</td>
            <td>{{ transportation.vehicle_number }}</td>
            <td>{{ transportation.type }}</td>
            <td>{{ transportation.capacity }}</td>
            <td>{{ transportation.route }}</td>
            <td>{{ transportation.status }}</td>
            <td>
              <button @click="editTransportation(transportation)">Edit</button>
              <button @click="deleteTransportation(transportation.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Modal for creating/updating -->
      <div v-if="showModal">
        <input v-model="currentTransportation.vehicle_number" placeholder="Vehicle Number" />
        <input v-model="currentTransportation.type" placeholder="Type" />
        <input v-model="currentTransportation.capacity" type="number" placeholder="Capacity" />
        <input v-model="currentTransportation.route" placeholder="Route" />
        <select v-model="currentTransportation.status">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
        <button @click="saveTransportation">Save</button>
        <button @click="closeModal">Cancel</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        transportations: [],
        showModal: false,
        currentTransportation: {
          id: null,
          vehicle_number: '',
          type: '',
          capacity: null,
          route: '',
          status: 'Active',
        },
      };
    },
    methods: {
      async fetchTransportations() {
        try {
          const response = await axios.get('/api/transportations');
          this.transportations = response.data.data;
        } catch (error) {
          alert('Error fetching transportations');
        }
      },
      createTransportation() {
        this.currentTransportation = {
          id: null,
          vehicle_number: '',
          type: '',
          capacity: null,
          route: '',
          status: 'Active',
        };
        this.showModal = true;
      },
      editTransportation(transportation) {
        this.currentTransportation = { ...transportation };
        this.showModal = true;
      },
      async saveTransportation() {
        try {
          if (this.currentTransportation.id) {
            await axios.put(`/api/transportations/${this.currentTransportation.id}`, this.currentTransportation);
          } else {
            await axios.post('/api/transportations', this.currentTransportation);
          }
          this.closeModal();
          this.fetchTransportations();
        } catch (error) {
          alert('Error saving transportation');
        }
      },
      async deleteTransportation(id) {
        try {
          await axios.delete(`/api/transportations/${id}`);
          this.fetchTransportations();
        } catch (error) {
          alert('Error deleting transportation');
        }
      },
      closeModal() {
        this.showModal = false;
      },
    },
    mounted() {
      this.fetchTransportations();
    },
  };
  </script>
  
  <style scoped>
  h1 {
    color: #4caf50;
  }
  table {
    margin-top: 20px;
    width: 100%;
  }
  </style>
  