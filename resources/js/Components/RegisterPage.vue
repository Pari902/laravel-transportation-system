<template>
    <div>
      <h1>Register</h1>
      <form @submit.prevent="register">
        <div>
          <label>Name:</label>
          <input v-model="Text" type="text" required />
        </div> <br>
        <div>
          <label>Email:</label>
          <input v-model="email" type="email" required />
        </div><br>
        <div>
          <label>Password:</label>
          <input v-model="password" type="password" required />
        </div><br>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: "RegisterPage",
    data() {
      return {
        email: "",
        password: "",
      };
    },
    methods: {
      async register() {
        try {
          const response = await axios.post("/register", {
            email: this.email,
            password: this.password,
          });
          console.log(response.data);
          alert("Registration successful!");
        } catch (error) {
          console.error(error);
          alert("An error occurred during registration.");
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
  