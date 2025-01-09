<template>
  <div class="homepage">
    <h1>Welcome to Transportation Management System</h1>
    <p>This is your Homepage.</p>
    <p>Select to Register or Login.</p>
    <div class="buttons">
      <button @click="goToRegister" class="register-button">Register</button>
      <button @click="goToLogin" class="login-button">Login</button>
    </div>
  </div>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
  name: "HomePage",
  setup() {
    const router = useRouter();

    const goToRegister = () => {
      router.push('/register'); // Navigate to the Register page
    };

    const goToLogin = () => {
      router.push('/login'); // Navigate to the Login page
    };

    return { goToRegister, goToLogin };
  }
};
</script>

<style scoped>
.homepage {
  display: flex;
  flex-direction: column;
  align-items: center; /* Centers content horizontally */
  justify-content: center; /* Centers content vertically */
  height: 100vh; /* Full viewport height */
  text-align: center; /* Center-align text */
  background-color: #f9f9f9; /* Light background color */
  font-family: Arial, sans-serif;
}

h1 {
  color: #4caf50;
  margin-bottom: 10px;
}

p {
  margin-bottom: 20px;
  color: #555;
  font-size: 16px;
}

.buttons {
  display: flex;
  gap: 15px; /* Space between buttons */
}

.register-button,
.login-button {
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.register-button {
  background-color: #4caf50;
  color: white;
}

.login-button {
  background-color: #2196f3;
  color: white;
}

.register-button:hover {
  background-color: #388e3c;
}

.login-button:hover {
  background-color: #1976d2;
}
</style>

  
