<template>
  <div class="container mt-4">
    <h3>Filter Buku: Kategori "{{ $route.params.name }}"</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Penulis</th>
          <th>Halaman</th>
          <th>Tanggal Terbit</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in filteredBooks" :key="book.id">
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.page }}</td>
          <td>{{ book.publish_date }}</td>
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
      allBooks: [],
      filteredBooks: []
    }
  },
  methods: {
    async fetchBooks() {
      const res = await api.get('/list-buku')
      this.allBooks = res.data.data
      this.filterBooks()
    },
    filterBooks() {
      const selectedCategory = this.$route.params.name
      this.filteredBooks = this.allBooks.filter(book => book.category === selectedCategory)
    }
  },
  watch: {
    '$route.params.name'() {
      this.filterBooks()
    }
  },
  mounted() {
    this.fetchBooks()
  }
}
</script>
