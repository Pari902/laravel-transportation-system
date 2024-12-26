<template>
  <div>
    <h2>Create a Record</h2>
    <form @submit.prevent="submitForm">
      <input v-model="name" placeholder="Enter Name" />
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '', // Holds the value entered in the input field
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('/api/records', { name: this.name });
        console.log(response.data); // Log the response for debugging
        alert('Record created successfully!'); // Show success message
      } catch (error) {
        console.error(error); // Log the error for debugging
        alert('An error occurred while creating the record.');
      }
    },
  },
};
</script>

<style scoped>
/* Optional: Add some styling */
form {
  display: flex;
  flex-direction: column;
  width: 300px;
}

input {
  margin-bottom: 10px;
  padding: 8px;
  font-size: 16px;
}

button {
  padding: 8px;
  background-color: #4caf50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
