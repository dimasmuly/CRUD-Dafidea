<template>
  <div style="padding: 20px;">
    <h1 style="color: #333;">Admin Dashboard</h1>
    <p style="font-size: 18px;">Jumlah Post: {{ postCount }}</p>
    <p style="font-size: 18px;">Jumlah Komentar: {{ commentCount }}</p>
    <router-link to="/posts/create" style="background: #a9a9a9; color: white; padding: 10px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 20px;">Create New Post</router-link>
    <table style="width: 100%; border-collapse: collapse;">
      <thead>
        <tr style="background: #ddd;">
          <th style="padding: 10px; text-align: left;">Judul</th>
          <th style="padding: 10px; text-align: left;">Konten</th>
          <th style="padding: 10px; text-align: left;">Tanggal Post</th>
          <th style="padding: 10px; text-align: left;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts" :key="post.id" style="border-bottom: 1px solid #eee;">
          <td style="padding: 10px;">{{ post.judul }}</td>
          <td style="padding: 10px;">{{ post.konten ? post.konten.substring(0, 50) + '...' : 'Tidak ada konten' }}</td>
          <td style="padding: 10px;">{{ post.tanggal_post }}</td>
          <td style="padding: 10px;">
            <router-link :to="`/posts/edit/${post.id}`" style="color: blue; text-decoration: none; margin-right: 10px;">Edit</router-link>
            <button @click="deletePost(post.id)" style="color: red; border: none; background: none; cursor: pointer;">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: [],
      postCount: 0,
      commentCount: 0
    };
  },
  methods: {
    async fetchPosts() {
      const token = localStorage.getItem('token');
      if (!token) {
        this.$router.push('/login');
        return;
      }
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/posts', {
          headers: { Authorization: `Bearer ${token}` }
        });
        this.posts = response.data.data; // Sesuaikan jika respons wrapped di 'data'
        this.postCount = this.posts.length;
        this.commentCount = this.posts.reduce((total, post) => total + (post.comments ? post.comments.length : 0), 0);
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    },
    async deletePost(id) {
      if (confirm('Apakah Anda yakin ingin menghapus post ini?')) {
        const token = localStorage.getItem('token');
        try {
          await axios.delete(`http://127.0.0.1:8000/api/posts/${id}`, {
            headers: { Authorization: `Bearer ${token}` }
          });
          this.posts = this.posts.filter(post => post.id !== id);
          this.postCount = this.posts.length;
        } catch (error) {
          console.error('Error deleting post:', error);
        }
      }
    },
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.fetchPosts();
    });
  }
};
</script>