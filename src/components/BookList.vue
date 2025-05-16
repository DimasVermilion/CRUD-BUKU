<!-- src/components/BookList.vue -->
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
          <td>{{ book.category }}</td>
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
    }
  },
  methods: {
    fetchBooks() {
      axios.get('http://localhost:8000/books').then(res => {
        this.books = res.data
      })
    },
    deleteBook(id) {
      axios.delete(`http://localhost:8000/books/${id}`).then(() => {
        this.fetchBooks()
      })
    }
  },
  mounted() {
    this.fetchBooks()
  }
}
</script>
