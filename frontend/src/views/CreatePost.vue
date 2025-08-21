<template>
  <div style="max-width: 600px; margin: auto; padding: 20px; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="text-align: center; color: #333;">Create New Post</h1>
    <form @submit.prevent="createPost" style="display: flex; flex-direction: column; gap: 15px;">
      <div>
        <label for="judul" style="display: block; margin-bottom: 5px; font-weight: bold;">Judul</label>
        <input id="judul" v-model="judul" placeholder="Judul" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" />
      </div>
      <div>
        <label for="konten" style="display: block; margin-bottom: 5px; font-weight: bold;">Konten</label>
        <textarea id="konten" v-model="konten" placeholder="Konten" required style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
      </div>
      <div>
        <label for="tanggal_post" style="display: block; margin-bottom: 5px; font-weight: bold;">Tanggal Post</label>
        <input id="tanggal_post" v-model="tanggal_post" type="date" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" />
      </div>
      <button type="submit" style="padding: 15px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Save</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      judul: '',
      konten: '',
      tanggal_post: ''
    };
  },
  methods: {
    async createPost() {
      const token = localStorage.getItem('token');
      try {
        await axios.post('http://127.0.0.1:8000/api/posts', {
          judul: this.judul,
          konten: this.konten,
          tanggal_post: this.tanggal_post
        }, {
          headers: { Authorization: `Bearer ${token}` }
        });
        this.$router.push('/dashboard');
      } catch (error) {
        console.error('Error creating post:', error);
      }
    }
  }
};
</script>