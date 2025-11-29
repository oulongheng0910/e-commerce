<template>
  <div id="app">
    <section class="featured-categories">
      <div class="Navigation">
        <h2>Featured Categories</h2>
        <div><Menu @group-changed="currentGroup = $event" /></div>
      </div>

      <div class="categories-row">
        <Category
          v-for="cat in filteredCategories"
          :key="cat.id"
          :title="cat.name"
          :count="cat.productCount"
          :image="cat.image"
          :bg="cat.color"
        />
      </div>
    </section>

    <!-- Promotion Banners -->
    <section class="promotions">
      <div class="promotions-grid">
        <Promotion
          v-for="promo in promotions"
          :key="promo.id"
          :title="promo.title"
          :image="promo.image"
          :buttoncolor="promo.buttonColor"
        />
      </div>
    </section>

    <!-- Popular Products Title + Menu Tabs + Product Grid -->
    <section class="popular-products">
      <div class="Navigation">
        <h2>Popular Products</h2>
        <Menu @group-changed="currentGroup = $event" />
      </div>

      <!-- Product Grid (directly here) -->
      <div class="products-grid">
        <Product v-for="product in filteredProducts" :key="product.id" :product="product" />
      </div>
    </section>
  </div>
</template>

<script>
import Category from '../components/Category.vue'
import Promotion from '../components/Promotion.vue'
import Menu from '../components/Menu.vue'
import Product from '../components/Product.vue'
import { useProductStore } from '@/stores/product_store'

export default {
  components: {
    Category,
    Promotion,
    Menu,
    Product,
  },

  data() {
    return {
      store: useProductStore(),
      currentGroup: 'All',
    }
  },

  computed: {
    promotions() {
      return this.store.promotions || []
    },

    // ADD THIS NEW COMPUTED: Filters categories by currentGroup
    filteredCategories() {
      const categories = this.store.categories || []
      if (this.currentGroup === 'All') {
        return categories
      }
      return categories.filter((c) => c && c.group === this.currentGroup)
    },

    filteredProducts() {
      const products = this.store.products || []
      if (this.currentGroup === 'All') {
        return products
      }
      return products.filter((p) => p && p.group === this.currentGroup)
    },
  },

  mounted() {
    if (this.store.products.length === 0) {
      this.store.initStore()
    }
  },
}
</script>

<style scoped>
#app {
  background: #f8f9fa;
  min-height: 100vh;
  padding-bottom: 50px;
}

.featured-categories,
.popular-products {
  padding: 50px 40px;
}

.Navigation {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.featured-categories h2,
.popular-products h2 {
  font-size: 2rem;
  margin-bottom: 30px;
  color: #333;
}

.categories-row {
  display: flex;
  gap: 25px;
}

.promotions {
  padding: 0 40px 60px;
}

.promotions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
  gap: 30px;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
  gap: 30px;
  padding: 0 40px;
  margin-top: 40px;
}

@media (max-width: 768px) {
  .products-grid {
    padding: 0 20px;
  }
}
</style>
