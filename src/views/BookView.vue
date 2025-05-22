<!-- src/views/BookView.vue -->
<template>
  <div>
    <BookForm :editBook="selectedBook" @refresh="loadBooks" @clear-edit="selectedBook = null" />
    <BookList ref="bookList" @edit-book="selectedBook = $event" />

  </div>
</template>

<script>
import BookForm from '../components/BookForm.vue'
import BookList from '../components/BookList.vue'
import Filtercategory from '../components/Filtercategory.vue' 

export default {
  components: { BookForm, BookList, Filtercategory },
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
