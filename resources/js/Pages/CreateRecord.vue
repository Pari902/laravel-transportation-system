<template>
    <div>
      <h2>Create a Record</h2>
      <form @submit.prevent="submitForm">
        <input 
          v-model="name" 
          placeholder="Enter Name" 
          required 
        />
        <button type="submit">Submit</button>
      </form>
      <div v-if="responseMessage" class="response-message">
        {{ responseMessage }}
      </div>
      <h3>Existing Records</h3>
      <ul v-if="records.length > 0">
        <li v-for="record in records" :key="record.id">
          {{ record.name }}
        </li>
      </ul>
      <p v-else>No records available.</p>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        name: "", // Holds the value entered in the input field
        responseMessage: "", // Holds the success or error message
        records: [], // Holds the fetched records
      };
    },
    methods: {
      async submitForm() {
        try {
            const response = await axios.post("http://127.0.0.1:8000/api/records", { name: this.name });
          console.log(response.data); // Log the response for debugging
          this.responseMessage = "Record created successfully!"; // Set success message
          this.name = ""; // Reset the input field after successful submission
          this.fetchRecords(); // Refresh the records list
        } catch (error) {
          console.error(error); // Log the error for debugging
          this.responseMessage = "An error occurred while creating the record."; // Set error message
        }
      },
      async fetchRecords() {
        try {
            const response = await axios.get("http://127.0.0.1:8000/api/records");
          this.records = response.data; // Update the records array with fetched data
        } catch (error) {
          console.error("Error fetching records:", error);
        }
      },
    },
    mounted() {
      this.fetchRecords(); // Fetch records when the component is mounted
    },
  };
  </script>
  
  <style scoped>
  /* Styling for the form, response message, and records list */
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
  
  .response-message {
    margin-top: 10px;
    font-size: 14px;
    color: #333;
  }
  
  h3 {
    margin-top: 20px;
  }
  
  ul {
    list-style-type: none;
    padding: 0;
  }
  
  li {
    padding: 5px 0;
  }
  </style>
  
  
