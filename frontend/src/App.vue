<template>
  <div style="display: flex; flex-direction: column;">
    <header style="background-color: #a9a9a9; padding: 10px; text-align: right;">
      <button v-if="loggedIn && isAdminRoute" @click="logout" style="background: #f0f0f0; border: none; padding: 5px 10px; cursor: pointer; color: black;">Logout</button>
      <router-link v-else to="/login" style="background: #f0f0f0; border: none; padding: 5px 10px; cursor: pointer; text-decoration: none; color: black;">Log in Admin</router-link>
    </header>
    <div style="display: flex;">
      <aside v-if="isAdminRoute" style="width: 250px; background: #f8f9fa; padding: 20px; height: calc(100vh - 50px); box-shadow: 2px 0 5px rgba(0,0,0,0.1); font-family: 'Roboto', sans-serif;">
        <h3 style="margin-bottom: 20px; color: #333; font-weight: 500; border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">Admin Menu</h3>
        <ul style="list-style: none; padding: 0;">
          <li style="margin-bottom: 10px;">
            <router-link to="/dashboard" style="display: block; padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s;">
              <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i> Dashboard
            </router-link>
          </li>
          <li style="margin-bottom: 10px;">
            <router-link to="/posts/create" style="display: block; padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s;">
              <i class="fas fa-plus" style="margin-right: 10px;"></i> Create Post
            </router-link>
          </li>
        </ul>
      </aside>
      <main :style="{ flex: 1, padding: '20px' }">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script>
import { emitter } from './eventBus';

export default {
  name: 'App',
  data() {
    return {
      loggedIn: !!localStorage.getItem('token')
    };
  },
  computed: {
    isAdminRoute() {
      const path = this.$route.path;
      return path.startsWith('/dashboard') || path.startsWith('/posts/create') || path.startsWith('/posts/edit');
    }
  },
  created() {
    this.updateLoginStatus();
    window.addEventListener('storage', this.updateLoginStatus);
    emitter.on('loginStatusChanged', this.updateLoginStatus);
  },
  beforeDestroy() {
    window.removeEventListener('storage', this.updateLoginStatus);
    emitter.off('loginStatusChanged', this.updateLoginStatus);
  },
  methods: {
    updateLoginStatus() {
      this.loggedIn = !!localStorage.getItem('token');
    },
    logout() {
      localStorage.removeItem('token');
      this.updateLoginStatus();
      this.$router.push('/login');
    }
  }
};
</script>

<style>
/* Tambahkan ini jika diperlukan untuk hover */
a:hover {
  background: #0056b3 !important;
}
</style>
