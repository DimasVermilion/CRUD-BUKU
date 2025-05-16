<template>
  <div class="container mt-4">
    <h3>Daftar Buku</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Penulis</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.category_name }}</td> <!-- ini sudah diganti -->
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
import axios from 'axios'

export default {
  data() {
    return {
      books: [],
      categories: []
    }
  },
  methods: {
    async fetchBooksAndCategories() {
      const [booksRes, categoriesRes] = await Promise.all([
        axios.get('http://localhost:8000/books'),
        axios.get('http://localhost:8000/categories')
      ])

      this.categories = categoriesRes.data

      this.books = booksRes.data.map(book => {
        const category = this.categories.find(cat => cat.id == book.id_category)
        return {
          ...book,
          category_name: category ? category.category : 'Tidak diketahui'
        }
      })
    },
    deleteBook(id) {
      axios.delete(`http://localhost:8000/books/${id}`).then(() => {
        this.fetchBooksAndCategories()
      })
    }
  },
  mounted() {
    this.fetchBooksAndCategories()
  }
}
</script>
