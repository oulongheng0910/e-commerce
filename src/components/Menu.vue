<!-- components/Menu.vue -->
<template>
  <div class="menu-tabs">
    <button
      v-for="group in allGroups"
      :key="group"
      @click="selectGroup(group)"
      :class="{ active: selectedGroup === group }"
      class="tab-button"
    >
      {{ group }}
    </button>
  </div>
</template>

<script>
import { useProductStore } from '@/stores/product_store'

export default {
  data() {
    return {
      store: useProductStore(),
      selectedGroup: 'All',
    }
  },

  computed: {
    allGroups() {
      const groups = new Set()
      this.store.products.forEach((p) => p.group && groups.add(p.group))
      this.store.categories.forEach((c) => c.group && groups.add(c.group))
      return ['All', ...Array.from(groups)]
    },
  },

  methods: {
    selectGroup(group) {
      this.selectedGroup = group
      // Send selected group to App.vue
      this.$emit('group-changed', group)
    },
  },

  mounted() {
    if (this.store.products.length === 0) {
      this.store.initStore()
    }
    // Start with "All" selected
    this.$emit('group-changed', 'All')
  },
}
</script>

<style scoped>
.menu-tabs {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 30px;
  padding: 40px 20px;
  background-color: #f8f9fa;
}

.tab-button {
  background: none;
  border: none;
  font-size: 1rem;
  color: #666;
  cursor: pointer;
  padding: 8px 0;
  position: relative;
  font-weight: 500;
  transition: color 0.3s;
}

.tab-button:hover {
  color: #2fb22f;
}

.tab-button.active {
  color: #2fb22f;
  font-weight: 600;
}

.tab-button.active::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  right: 0;
  height: 3px;
  background-color: #2fb22f;
  border-radius: 2px;
}
</style>
