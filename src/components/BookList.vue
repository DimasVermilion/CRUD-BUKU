<template>
  <div class="container mt-4">
    <h3>Daftar Buku</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Penulis</th>
          <th>Halaman</th>
          <th>Tanggal Terbit</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.page }}</td>
          <td>{{ book.publish_date }}</td>
          <td>
              <router-link :to="`/filter-category/${book.category}`" class="btn btn-sm btn-outline-secondary" >{{ book.category }}</router-link>
          </td>

          <td>
            <button class="btn btn-sm btn-primary me-2" @click="$emit('edit-book', book)">Edit</button>
            <button class="btn btn-sm btn-danger" @click="deleteBook(book.id)">Hapus</button>
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
      books: []
    }
  },
 methods: {
  async fetchBooks() {
    const res = await api.get('/list-buku')
    this.books = res.data.data
  },
  deleteBook(id) {
    api.delete(`/delete-buku/${id}`).then(() => {
      this.fetchBooks()
    })
  },
  async filterByCategory(category) {
    const res = await api.get(`/buku-kategori/${category_id}`)
    this.books = res.data.data
  }
},

  mounted() {
    this.fetchBooks()
  }
}
</script>
