<template>
  <div class="category_card" :style="{ backgroundColor: bg || '#f7f7f7' }">
    <img :src="getImage()" :alt="title" />
    <h4>{{ title }}</h4>
    <p>{{ count }} items</p>
  </div>
</template>
<script>
export default {
  name: 'Category',
  props: {
    title: String,
    image: String,
    count: Number,
    bg: String,
    group: String,
  },
  data() {
    return {
      APIURL: 'http://localhost:3000/',
    }
  },
  methods: {
    getImage() {
      if (!this.image) return ''
      return this.APIURL + this.image
    },
  },
}
</script>

<style scoped>
.category_card {
  width: 120px;
  text-align: center;
  background-color: #f9f9f9;
  border-radius: 10px;
  padding: 10px;
}

.category_card img {
  width: 60px;
  height: 60px;
  object-fit: cover;
}

.category_card p {
  opacity: 0.3;
}
</style>
