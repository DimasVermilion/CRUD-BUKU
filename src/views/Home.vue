<!-- src/views/Home.vue -->
<template>
  <div class="container mt-4">
    <h1 class="mb-4">Selamat datang di Aplikasi Perpustakaan</h1>
    <p class="lead">
      Kelola data buku dan kategori dengan mudah.
    </p>
    <div class="d-flex gap-3 mt-4">
      <router-link to="/books" class="btn btn-primary">Daftar Buku</router-link>
      <router-link to="/categories" class="btn btn-secondary">Kelola Kategori</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>
