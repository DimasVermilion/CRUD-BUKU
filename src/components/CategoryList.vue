<template>
  <div class="container mt-4">
    <h3>Daftar Kategori</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cat in categories" :key="cat.id">
          <td>{{ cat.category }}</td> 
          <td>
            <button class="btn btn-sm btn-primary me-2" @click="$emit('edit-category', cat)">Edit</button>
            <button class="btn btn-sm btn-danger" @click="deleteCategory(cat.id)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '@api/api.js'

export default {
  data() {
    return {
      categories: []
    }
  },
  methods: {
    async fetchCategories() {
      try {
        const res = await api.get('/list-category')
        this.categories = res.data.data || res.data
      } catch (error) {
        console.error('Gagal mengambil data kategori:', error)
      }
    },
    async deleteCategory(id) {
      try {
        await api.delete(`/delete-category/${id}`)
        this.fetchCategories()
      } catch (error) {
        console.error('Gagal menghapus kategori:', error)
      }
    }
  },
  mounted() {
    this.fetchCategories()
  }
}
</script>
