<template>
    <div class="homepage">
      <h1>Welcome to the Homepage</h1>
      <p>This is the homepage of your application.</p>
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
  h1 {
    color: #4caf50;
  }
  
  .buttons {
    margin-top: 20px;
    display: flex;
    gap: 10px;
  }
  
  .register-button,
  .login-button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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
  
