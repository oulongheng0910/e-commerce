<template>
  <button class="btn" :style="{backgroundColor: color || '#f7f7f7'}" > {{ text }} &#x2192;</button>
</template>

<script>
import Promotion from './Promotion.vue';

export default {
  name: 'Button1',
  props: {
    text: String,
    color: String,
  },
   
}
</script>

<style scoped>
.btn {
  background-color: #2fb22f;
  color: white;
  padding: 8px 14px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: red;
  transform: scale(1.1); /* Scale up on hover */
  
}
</style>
