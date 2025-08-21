import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'PostList', component: () => import('../views/PostList.vue') },
    { path: '/post/:id', name: 'PostDetail', component: () => import('../views/PostDetail.vue') },
    { path: '/login', name: 'Login', component: () => import('../views/Login.vue') },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: () => import('../views/Dashboard.vue')
    },
    {
      path: '/posts/create',
      name: 'CreatePost',
      component: () => import('../views/CreatePost.vue')
    },
    {
      path: '/posts/edit/:id',
      name: 'EditPost',
      component: () => import('../views/EditPost.vue')
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.name === 'PostDetail' && !to.params.id) {
    next({ name: 'PostList' });  // Redirect ke list jika id hilang
  } else {
    next();
  }
});

export default router
