<template>
    <div>
      <h1>Register</h1>
      <form @submit.prevent="register">
        <div>
          <label>Name:</label>
          <input v-model="name" type="text" required />
        </div>
        <br />
        <div>
          <label>Email:</label>
          <input v-model="email" type="email" required />
        </div>
        <br />
        <div>
          <label>Password:</label>
          <input v-model="password" type="password" required />
        </div>
        <br />
        <div>
          <label>Confirm Password:</label>
          <input v-model="password_confirmation" type="password" required />
        </div>
        <br />
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "RegisterPage",
    data() {
      return {
        name: "",
        email: "",
        password: "",
        password_confirmation: "", // Added password confirmation
      };
    },
    methods: {
      async register() {
        try {
          // Send registration request
          const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
  
          const response = await axios.post(
            "/register",
            {
              name: this.name,
              email: this.email,
              password: this.password,
              password_confirmation: this.password_confirmation, // Pass confirmation
            },
            {
              headers: {
                "X-CSRF-TOKEN": csrfToken,
              },
            }
          );
  
          console.log(response); // Check what the server sends back
          if (response.request.responseURL.includes('/dashboard')) {
            window.location.href = response.request.responseURL; // Redirect to dashboard
        } else {
            alert("Registration successful, but no redirect was triggered.");
        }
    } catch (error) {
        console.error(error.response?.data || error.message);
        alert("An error occurred during registration.");
    }
      },
    },
  };

  </script>
  
  
  
  