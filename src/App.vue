<template>
  <div id="app">
    <search-box />
    <router-view />
  </div>
</template>

<script>
import SearchBox from './components/SearchBox.vue';

export default {
  components: {
SearchBox
  },
}
</script>

<style scoped>
#app {
  background: #f8f9fa;
  min-height: 100vh;
  padding-bottom: 50px;
}
</style>