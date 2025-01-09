<template>
  <div class="register-page">
    <h1>REGISTER</h1>
    <form @submit.prevent="register" class="register-form">
      <div class="form-group">
        <label for="name">Name:</label>
        <input id="name" v-model="name" type="text" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" v-model="email" type="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" v-model="password" type="password" required />
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input id="password_confirmation" v-model="password_confirmation" type="password" required />
      </div>
      <button type="submit" class="register-button">Register</button>
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
      password_confirmation: "",
    };
  },
  methods: {
    async register() {
      try {
        const csrfToken = document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content");

        const response = await axios.post(
          "/register",
          {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          },
          {
            headers: {
              "X-CSRF-TOKEN": csrfToken,
            },
          }
        );

        console.log(response);
        if (response.request.responseURL.includes("/dashboard")) {
          window.location.href = response.request.responseURL;
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

<style scoped>
.register-page {
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

.register-form {
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

.register-button {
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

.register-button:hover {
  background-color: #388e3c;
}
</style>

  
  
  
  