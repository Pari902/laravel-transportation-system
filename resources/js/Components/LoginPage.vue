<template>
  <div class="login-page">
    <h1>LOGIN</h1>
    <form @submit.prevent="login" class="login-form">
      <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" v-model="email" type="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" v-model="password" type="password" required />
      </div>
      <button type="submit" class="login-button">Login</button>
    </form>
  </div>
</template>

<script>
import apiClient from "../axios";

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
        const response = await apiClient.post("/login", {
          email: this.email,
          password: this.password,
        });

        localStorage.setItem("token", response.data.token);

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
.login-page {
  display: flex;
  flex-direction: column;
  align-items: center; /* Centers content horizontally */
  justify-content: center; /* Centers content vertically */
  height: 100vh; /* Full viewport height */
  background-color: #f4f4f4; /* Light background color */
  font-family: Arial, sans-serif;
  text-align: center; /* Center-align text */
}

h1 {
  color: #4caf50;
  margin-bottom: 20px;
}

.login-form {
  background: white;
  padding: 20px 30px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px; /* Ensure responsiveness */
}

.form-group {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

label {
  margin-bottom: 5px;
  font-weight: bold;
  color: #333;
}

input {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input:focus {
  border-color: #4caf50;
  outline: none;
}

.login-button {
  width: 100%;
  padding: 10px 15px;
  font-size: 16px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #388e3c;
}
</style>

  
  