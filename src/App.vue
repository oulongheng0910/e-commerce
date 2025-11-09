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
        console.log(' Data from API:', response.data)

        this.categories = response.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    },

    async fetchProMotion() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions')
        console.log('Data from API:', response.data)
        this.promotions = response.data
      } catch (error) {
        console.error(' Error fetching categories:', error)
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
  /* flex-wrap: wrap;  */
  gap: 20px;
}
</style>
