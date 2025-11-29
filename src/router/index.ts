

import HomeView from '@/views/HomeView.vue';
// import categoryView from '@/views/CategoryView.vue';
// import productView from '@/views/ProductView.vue';
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  {
    path: '/',  // Root path
    name: 'Home',
    component: HomeView  
  }, 
  // {
  //   path: "/categories/:categoryId",  
  //   name: "category",
  //   component: categoryView 
  // },
  // {
  //   path : "/products/:productId",
  //   name: "product",
  //   component : productView
  // },
  
]

const router = createRouter({
  history: createWebHistory(),  // Use HTML5 history mode (clean URLs)
  routes
});

export default router