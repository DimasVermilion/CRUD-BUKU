<!-- src/views/BookView.vue -->
<template>
  <div>
    <BookForm :editData="selectedBook" @refresh="loadBooks" @clear-edit="selectedBook = null" />
    <BookList ref="bookList" @edit-book="selectedBook = $event" />
  </div>
</template>

<script>
import BookForm from '../components/BookForm.vue'
import BookList from '../components/BookList.vue'

export default {
  components: { BookForm, BookList },
  data() {
    return {
      selectedBook: null,
    }
  },
  methods: {
    loadBooks() {
      this.$refs.bookList.fetchBooks()
    }
  }
}
</script>
