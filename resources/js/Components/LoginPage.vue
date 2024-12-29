<template>
    <div>
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div>
          <label>Email:</label>
          <input v-model="email" type="email" required />
        </div>
        <div>
          <label>Password:</label>
          <input v-model="password" type="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import apiClient from "../axios"; // Import the configured Axios instance
  
  export default {
    name: "LoginPage",
    data() {
      return {
        email: "",
        password: "",
      };
    },
    methods: {
      async login() {
        try {
          // Send login request
          const response = await apiClient.post("/login", {
            email: this.email,
            password: this.password,
          });
  
          // Store token in localStorage
          localStorage.setItem("token", response.data.token);
  
          // Redirect to the dashboard
          this.$router.push("/dashboard");
  
          alert("Login successful!");
        } catch (error) {
          console.error(error.response?.data?.message || error.message);
          alert(
            error.response?.data?.message || "An error occurred during login."
          );
        }
      },
    },
  };
  </script>
  
  <style scoped>
  h1 {
    color: #4caf50;
  }
  </style>
  
  