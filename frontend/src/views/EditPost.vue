<template>
  <div style="max-width: 600px; margin: auto; padding: 20px; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="text-align: center; color: #333;">Edit Post</h1>
    <form @submit.prevent="updatePost" style="display: flex; flex-direction: column; gap: 15px;">
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
      <button type="submit" style="padding: 10px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
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
  async created() {
    const token = localStorage.getItem('token');
    if (!token) {
      this.$router.push('/login');
      return;
    }
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.id}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
      this.judul = response.data.judul;
      this.konten = response.data.konten;
      this.tanggal_post = response.data.tanggal_post;
    } catch (error) {
      console.error('Error fetching post:', error);
    }
  },
  methods: {
    async updatePost() {
      const token = localStorage.getItem('token');
      try {
        await axios.put(`http://127.0.0.1:8000/api/posts/${this.$route.params.id}`, {
          judul: this.judul,
          konten: this.konten,
          tanggal_post: this.tanggal_post
        }, {
          headers: { Authorization: `Bearer ${token}` }
        });
        this.$router.push('/dashboard');
      } catch (error) {
        console.error('Error updating post:', error);
      }
    }
  }
};
</script>