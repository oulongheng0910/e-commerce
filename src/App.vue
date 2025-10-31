<script>
import Category from './components/Category.vue'
import Promotion from './components/Promotion.vue'

export default {
  name: 'App',
  components: {
    Category,
    Promotion,
  },
  data() {
    return {
      categories: [
        { title: 'Cake & Milk', count: 14, image: '/src/assets/burger.png', bg: '#F2FCE4' },
        { title: 'Peach', count: 17, image: '/src/assets/pink.png', bg: '#FFFCEB' },
        { title: 'Kiwi', count: 21, image: '/src/assets/kivi.png', bg: '#ECFFEC' },
        { title: 'Red Apple', count: 15, image: '/src/assets/red_apple.png', bg: '#FEEFEA' },
        { title: 'Snack', count: 34, image: '/src/assets/Tea.png', bg: '#FFF3EB' },
        { title: 'Black Plum', count: 25, image: '/src/assets/grape.png', bg: '#FFF3FF' },
        { title: 'Vegetables', count: 65, image: '/src/assets/lettue.png', bg: '#F2FCE4' },
        { title: 'Headphone', count: 33, image: '/src/assets/headphone.png', bg: '#FFFCEB' },
        { title: 'Cake & Milk', count: 54, image: '/src/assets/pink.png', bg: '#F2FCE4' },
        { title: 'Orange', count: 63, image: '/src/assets/Tea_apple.png', bg: '#FFF3FF' },
      ],

      promos: [
        {
          title: 'Everyday Fresh & Clean with our Products',
          image: '/src/assets/Onion.jpg',
          buttontext: 'Shop Now',
          buttoncolor : '#2fb22f;'
        },
        {
          title: 'Make your Breakfast Healthy and Easy',
          image: '/src/assets/strawberry.webp',
          buttontext: 'Shop Now',
          buttoncolor: '#2fb22f'
        },
        {
          title: 'The Best Organic Products Online',
          image: '/src/assets/vegetable.jpg',
          buttontext: 'Shop Now',
          buttoncolor: ' #ffd700'
        },
      ],
    }
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
        :title="item.title"
        :count="item.count"
        :image="item.image"
        :bg="item.bg"
    
      />
    </div>
    <h2>Promotions</h2>
    <div class="rows">
      <Promotion
        v-for="(item, i) in promos"
        :key="i"
        :title="item.title"
        :image="item.image"
        :buttontext="item.buttontext"
        :buttoncolor="item.buttoncolor"
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
