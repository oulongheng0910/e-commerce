import { createRouter, createMemoryHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';
// import categoryView from '@/views/CategoryView.vue';
// import productView from '@/views/ProductView.vue';



const router = createRouter({
  history: createMemoryHistory(import.meta.env.BASE_URL),
  routes: [{
    path: '/',  // Root path
    name: 'Home',
    component: HomeView  
  }, 

    {
      path: "/categories/:categoryId",
      name: "category",
      component : () => import("../views/CategoryView.vue"),
    },

    {
      path: "/product/:id",
      name: "product",
      component: () => import("../views/productDetail.vue"),
    },
  ],
});

export default router