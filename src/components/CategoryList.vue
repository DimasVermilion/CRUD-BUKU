<!-- src/components/CategoryList.vue -->
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
import axios from 'axios'

export default {
  data() {
    return {
      categories: [],
    }
  },
  methods: {
    fetchCategories() {
      axios.get('http://localhost:8000/categories').then(res => {
        this.categories = res.data
      })
    },
    deleteCategory(id) {
      axios.delete(`http://localhost:8000/categories/${id}`).then(() => {
        this.fetchCategories()
      })
    }
  },
  mounted() {
    this.fetchCategories()
  }
}
</script>
