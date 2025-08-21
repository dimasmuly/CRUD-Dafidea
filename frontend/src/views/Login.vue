<template>
  <div style="max-width: 400px; margin: auto; padding: 20px; text-align: center;">
    <h1>Login Admin</h1>
    <p>Sign in to continue</p>
    <form @submit.prevent="login">
      <input v-model="email" type="email" placeholder="hello@mygreatsite.com" style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; background: #f0f0f0;" />
      <input v-model="password" type="password" placeholder="Password" style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; background: #f0f0f0;" />
      <button type="submit" style="width: 105%; padding: 10px; background: linear-gradient(#424242, #212121); color: white; border: none; border-radius: 4px;">Sign in</button>
    </form>
    <router-link to="/" style="display: block; width: 100%; padding: 10px; margin-top: 10px; background: linear-gradient(#9e9e9e, #757575); color: white; text-decoration: none; border-radius: 4px;">Back to Home</router-link>
  </div>
</template>

<script>
import axios from 'axios';
import { emitter } from '@/eventBus';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      console.log('Login method called with email:', this.email, 'and password:', this.password);
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });
        console.log('Login successful, token:', response.data.token);
        localStorage.setItem('token', response.data.token);
        this.$router.push('/dashboard');
        emitter.emit('loginStatusChanged'); 
      } catch (error) {
        console.error('Login failed:', error.response ? error.response.data : error.message);
        alert('Login gagal. Periksa kredensial Anda.');
      }
    }
  }
};
</script>