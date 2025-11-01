<script>
import Category from './components/Category.vue'
import Promotion from './components/Promotion.vue'
import axios from 'axios'

export default {
  name: 'App',
  components: {
    Category,
    Promotion,
  },
  data() {
    return {
      categories: [],
      promotions: [],
      // promos: [
      //   {
      //     title: 'Everyday Fresh & Clean with our Products',
      //     image: '/src/assets/Onion.jpg',
      //     buttoncolor: '#2fb22f',
      //   },
      //   {
      //     title: 'Make your Breakfast Healthy and Easy',
      //     image: '/src/assets/strawberry.webp',
      //     buttoncolor: '#2fb22f',
      //   },
      //   {
      //     title: 'The Best Organic Products Online',
      //     image: '/src/assets/vegetable.jpg',
      //     buttoncolor: '#ffd700',
      //   },
      // ],
    }
  },

  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:3000/api/categories')
        console.log('✅ Data from API:', response.data)

        // ✅ Update Vue data with backend response
        this.categories = response.data
      } catch (error) {
        console.error('❌ Error fetching categories:', error)
      }
    },

    async fetchProMotion() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions')
        console.log('✅ Data from API:', response.data)

        // ✅ Update Vue data with backend response
        this.promotions = response.data
      } catch (error) {
        console.error('❌ Error fetching categories:', error)
      }
    },
  },

  mounted() {
    this.fetchCategories()
    this.fetchProMotion()
  },
}
</script>

<template>
  <div>
    <h2>Categories</h2>
    <div class="rows">
      <Category
        v-for="(item, i) in categories"
        :key="i"
        :title="item.name"
        :count="item.productCount"
        :image="item.image"
        :bg="item.color"
      />
    </div>
    <h2>Promotions</h2>
    <div class="rows">
      <Promotion
        v-for="(item, i) in promotions"
        :key="i"
        :title="item.title"
        :image="item.image"
        :buttoncolor="item.buttonColor"
      />
    </div>
  </div>
</template>

<style scoped>
.rows {
  display: flex;
  /* flex-wrap: wrap; */
  gap: 20px;
}
</style>

<!-- <script>

import Category from './components/Category.vue'
import Promotion from './components/Promotion.vue'
import axios from 'axios';

export default {
  name: 'App',
  components: {
    Category,
    Promotion,
  },
  data() {
    return {
      categories: [],
      // categories: [
      //   { title: 'Cake & Milk', count: 14, image: '/src/assets/burger.png', bg: '#F2FCE4' },
      //   { title: 'Peach', count: 17, image: '/src/assets/pink.png', bg: '#FFFCEB' },
      //   { title: 'Oganic Kiwi', count: 21, image: '/src/assets/kivi.png', bg: '#ECFFEC' },
      //   { title: 'Red Apple', count: 68, image: '/src/assets/red_apple.png', bg: '#FEEFEA' },
      //   { title: 'Snack', count: 34, image: '/src/assets/Tea.png', bg: '#FFF3EB' },
      //   { title: 'Black Plum', count: 25, image: '/src/assets/grape.png', bg: '#FFF3FF' },
      //   { title: 'Vegetables', count: 65, image: '/src/assets/lettue.png', bg: '#F2FCE4' },
      //   { title: 'Headphone', count: 33, image: '/src/assets/headphone.png', bg: '#FFFCEB' },
      //   { title: 'Cake & Milk', count: 54, image: '/src/assets/pink.png', bg: '#F2FCE4' },
      //   { title: 'Orange', count: 63, image: '/src/assets/Tea_apple.png', bg: '#FFF3FF' },
      // ],

      promos: [
        {
          title: 'Everyday Fresh & Clean with our Products',
          image: '/src/assets/Onion.jpg',
          buttoncolor: '#2fb22f;',
        },
        {
          title: 'Make your Breakfast Healthy and Easy',
          image: '/src/assets/strawberry.webp',
          buttoncolor: '#2fb22f',
        },
        {
          title: 'The Best Organic Products Online',
          image: '/src/assets/vegetable.jpg',
          buttoncolor: ' #ffd700',
        },
      ],
    }
  },

  methods: {
    async fetchCategories() {
    
     axios.get('http://localhost:3000/api/categories')
  .then(response => {
    console.log(response.data); 
   // Access the data
    
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });
  },

    
  },
  mounted() {
    this.fetchCategories();
  },
}
</script> -->
