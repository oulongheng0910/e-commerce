<template>
  <HeaderComponent />
  <NavComponent />
 
  <div id="app">
    <RouterView />
  </div>
</template>

<script setup>
import HeaderComponent from './components/SearchBox.vue';
import NavComponent from './components/Navbar.vue';

// App.vue is now just a container for router views
</script>

<style>
#app {
  min-height: 100vh;
  background: white;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>


<!-- <style scoped>
#app {
  background: #f8f9fa;
  min-height: 100vh;
  padding-bottom: 50px;
}
</style> -->