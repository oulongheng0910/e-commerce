<template>
    <div class = "navigationbar">
        <div class = "img">
            <img src="../assets/logo.png" alt="melon">
        </div>
        <div class="search-container">
    <select class="category-select">
      <option>All Categories</option>
    </select>
    <input type="text" placeholder="Search for items..." class="search-input" />
    <button class="search-btn">Search</button>
  </div>
  <div class = "icon">
    <User  /> Account
    <refresh-cw /> Compare
    <Heart /> Wishlist
    <shopping-cart /> Cart
  </div>
    </div>
  
</template>

<style scoped>
.navigationbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.search-container {
  display: flex;
  border: 2px solid #2fb22f;
  border-radius: 8px;
 justify-content: center;
 align-items: center;;
  width : 500px;
  background: white;
}
.category-select {
  padding: 12px;
  border: none;
  background: #f0f0f0;
  font-size: 0.95rem;
}
.search-input {
  flex: 1;
  padding: 12px;
  border: none;
  outline: none;
  font-size: 1rem;
}
.search-btn {
  background: #2fb22f;
  color: white;
  border: none;
  padding: 0 24px;
  cursor: pointer;
  font-weight: bold;
  height: 50px;
}
</style>
<script setup>
import { User } from 'lucide-vue-next';
import { Heart } from 'lucide-vue-next';
import { RefreshCw } from 'lucide-vue-next';
import { ShoppingCart } from 'lucide-vue-next';
// export default {
//   name: "SearchBox",
// };

</script>