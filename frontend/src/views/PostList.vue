<template>
  <div style="text-align: center;">
    <h1>Daftar Artikel</h1>
    <div style="display: flex; justify-content: center; flex-wrap: wrap;">
      <div v-for="post in posts" :key="post.id" style="width: 200px; margin: 10px; background: #eee; padding: 10px;">
        <div style="height: 100px; background: #ddd; margin-bottom: 10px;"></div>
        <h3>{{ post.judul || 'No content available' }}</h3>
        <p>{{ post.tanggal_post }}<br>{{ post.konten ? post.konten.substring(0, 50) + '...' : 'No detail available' }}</p>
        <router-link v-if="post.id" :to="{ name: 'PostDetail', params: { id: post.id } }">More</router-link>
        <span v-else>No detail available</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { posts: [] };
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    async fetchPosts() {
      try {
        const response = await axios.get('http://localhost:8000/api/posts');
        this.posts = response.data.data;  
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    },
  },
};
</script>