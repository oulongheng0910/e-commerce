<template>
  <div class="product-card">
    <!-- Router link should wrap the clickable area, not be a separate element -->
    <router-link :to="{ name: 'product', params: { id: product.id } }" class="product-link">
      <div class="img-wrapper">
        <img :src="imageUrl" :alt="product.name" />

        <!-- Discount Badge (-17%) -->
        <div v-if="product.promotionAsPercentage > 0" class="badge discount1">
          -{{ product.promotionAsPercentage }}%
        </div>
        <div v-else-if="product.promotionAsPercentage === 'Hot'" class="badge discount2">Hot</div>
        <div v-else-if="product.promotionAsPercentage === 'Sale'" class="badge discount3">Sale</div>
      </div>

      <!-- Content -->
      <div class="content">
        <p class="brand">Hodo Foods</p>
        <h4 class="title">{{ product.name }}</h4>

        <!-- Rating -->
        <div class="rating">
          <span class="stars">
            ★★★★☆
            <span class="empty-stars">☆☆☆☆☆</span>
          </span>
          <span class="rating-text">({{ product.rating }})</span>
        </div>

        <p class="size">{{ product.size }}gram</p>
      </div>
    </router-link>

    <div class="footer">
      <div class="price">
        <span v-if="hasDiscount" class="old-price"> ${{ product.price.toFixed(2) }} </span>
        <span class="new-price">${{ finalPrice }}</span>
      </div>

      <div class="actions">
        <select v-model="qty" class="qty">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <button @click="addToCart" class="add-btn">Add +</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: Object,
  },

  data() {
    return {
      qty: 1,
    }
  },

  computed: {
    imageUrl() {
      if (!this.product?.image) return '/placeholder.jpg'

      let path = this.product.image

      // Step 1: If it's a stringified array like "[\"path\"]", fix it
      if (typeof path === 'string') {
        // Remove [ ] and quotes
        path = path.replace(/[\[\]"]/g, '')
        // Fix double backslashes and convert to forward slash
        path = path.replace(/\\\\/g, '/').replace(/\\/g, '/')
      }

      // Final URL
      return 'http://localhost:3000/' + path.trim()
    },
    hasDiscount() {
      return this.product.promotionAsPercentage > 0
    },
    finalPrice() {
      if (this.hasDiscount) {
        const discount = this.product.price * (this.product.promotionAsPercentage / 100)
        return (this.product.price - discount).toFixed(2)
      }
      return this.product.price.toFixed(2)
    },
  },

  methods: {
    addToCart() {
      if (this.product.instock > 0) {
        this.$emit('add-to-cart', { ...this.product, quantity: this.qty })
      }
    },
  },
}
</script>

<style scoped>
.product-card {
  background: white;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  width: 100%;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.product-link {
  text-decoration: none;
  color: inherit;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.img-wrapper {
  position: relative;
  height: 180px;
  overflow: hidden;
}

.img-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.badge {
  position: absolute;
  top: 12px;
  padding: 6px 14px;
  width: 30px;
  height: 15px;
  font-weight: bold;
  border-radius: 0 100px 100px 0;
  font-size: 0.85rem;
  color: white;
  z-index: 2;
}

.discount1 {
  background: #2fb22f;
}

.discount2 {
  background: #ff4757;
}
.discount3 {
  background-color: hsl(60, 71%, 57%);
}

.content {
  padding: 16px;
  flex-grow: 1;
}

.brand {
  color: #888;
  font-size: 0.9rem;
  margin: 0 0 6px 0;
}

.title {
  font-size: 1.05rem;
  margin: 0 0 8px 0;
  line-height: 1.35;
  height: 2.7em;
  overflow: hidden;
  color: #333;
  font-weight: 600;
}

.rating {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 8px;
  position: relative;
}

.stars {
  color: #ffa502;
  font-size: 1.1rem;
  position: relative;
}

.empty-stars {
  color: #e0e0e0;
  position: absolute;
  top: 0;
  left: 0;
}

.rating-text {
  color: #666;
  font-size: 0.9rem;
}

.size {
  color: #555;
  font-size: 0.95rem;
  margin: 8px 0;
}

.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  padding-top: 0;
  border-top: 1px solid #eee;
  margin-top: auto;
}

.price {
  display: flex;
  align-items: center;
  gap: 8px;
}

.old-price {
  text-decoration: line-through;
  color: #999;
  font-size: 1rem;
}

.new-price {
  font-size: 1.5rem;
  font-weight: bold;
  color: #2fb22f;
}

.actions {
  display: flex;
  align-items: center;
  gap: 8px;
}

.qty {
  padding: 8px 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 0.95rem;
}

.add-btn {
  background: #2fb22f;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 10px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.add-btn:hover {
  background: #1e8e1e;
}
</style>