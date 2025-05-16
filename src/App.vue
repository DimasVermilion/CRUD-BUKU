<!-- src/App.vue -->
<template>
  <div>
    <Navbar />
    <router-view />
  </div>
</template>

<script>
import Navbar from './components/Navbar/Navbar.vue'

export default {
  components: {
    Navbar
  }
}
</script>

<style>
body {
  background-color: #f8f9fa;
}
</style>
  