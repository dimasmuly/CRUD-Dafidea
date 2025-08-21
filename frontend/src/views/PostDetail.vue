<template>
  <div style="max-width: 600px; margin: auto; padding: 20px;">
    <h1>Detail Artikel</h1>
    <div style="height: 200px; background: #ddd; margin-bottom: 10px; display: flex; justify-content: center; align-items: center;">
      <img src="https://placehold.co/600x200" alt="Placeholder" style="max-width: 100%; max-height: 100%;">
    </div>
    <h2>{{ post.judul }}</h2>
    <p>{{ post.tanggal_post }}</p>
    <p>{{ post.konten }}</p>
    <h3>Komentar</h3>
    <div v-for="comment in comments" :key="comment.id" style="border: 1px solid #ddd; border-radius: 5px; padding: 10px; margin-bottom: 10px; background: #f9f9f9;">
      <p style="margin: 0; font-weight: bold;">{{ comment.content }}</p>
      <small style="color: #666;">{{ formatDate(comment.created_at) }}</small>
    </div>
    <form @submit.prevent="addComment">
      <textarea v-model="newComment" placeholder="Tulis komentar..." style="width: 100%; height: 100px;"></textarea>
      <button type="submit" style="padding: 10px; background: #333; color: white;">Kirim</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { post: {}, comments: [], newComment: '' };
  },
  mounted() {
    this.fetchPost();
    this.fetchComments();
  },
  methods: {
    async fetchPost() {
      try {
        const response = await axios.get(`http://localhost:8000/api/posts/${this.$route.params.id}`);
        this.post = response.data;
      } catch (error) {
        console.error('Error fetching post:', error);
      }
    },
    async fetchComments() {
      try {
        const response = await axios.get(`http://localhost:8000/api/posts/${this.$route.params.id}/comments`);
        this.comments = response.data;
      } catch (error) {
        console.error('Error fetching comments:', error);
      }
    },
    async addComment() {
      try {
        await axios.post(`http://localhost:8000/api/comments`, { post_id: this.$route.params.id, content: this.newComment });
        this.newComment = '';
        this.fetchComments();
      } catch (error) {
        console.error('Error adding comment:', error);
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
    },
  },
};
</script>