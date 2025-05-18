<template>
  <div class="container mt-4">
    <h3>{{ isEdit ? 'Edit Buku' : 'Tambah Buku' }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="mb-3">
        <label>Judul</label>
        <input type="text" class="form-control" v-model="book.title" required>
      </div>
      <div class="mb-3">
        <label>Penulis</label>
        <input type="text" class="form-control" v-model="book.author" required>
      </div>
      <div class="mb-3">
        <label>Jumlah Halaman</label>
        <input type="number" class="form-control" v-model="book.page" required>
      </div>
      <div class="mb-3">
        <label>Tanggal Terbit</label>
        <input type="date" class="form-control" v-model="book.publish_date" required>
      </div>
      <div class="mb-3">
        <label>Kategori</label>
        <select class="form-control" v-model="book.category_id" required>
          <option value="" disabled>Pilih kategori</option>
          <option v-for="cat in categories" :value="cat.id" :key="cat.id">{{ cat.category }}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">{{ isEdit ? 'Update' : 'Tambah' }}</button>
    </form>
  </div>
</template>

<script>
import api from '@api/api.js'

export default {
  props: ['editBook'],
  data() {
    return {
      book: {
        title: '',
        author: '',
        page: '',
        category_id: '',
        publish_date: ''
      },
      isEdit: false,
      categories: []
    }
  },
  watch: {
    editBook(newVal) {
      if (newVal) {
        this.book = { ...newVal }
        this.book.category_id = newVal.category_id
        this.isEdit = true
      }
    }
  },
  mounted() {
    api.get('/list-category').then(res => {
      this.categories = res.data.data  || res.data
    })
  },
  methods: {
    handleSubmit() {
      if (this.isEdit) {
      api.put(`/update-buku/${this.book.id}`, this.book).then(() => {
          this.resetForm()
          this.$emit('refresh')
        })
      } else {
        api.post('/store-buku', this.book).then(() => {
          this.resetForm()
          this.$emit('refresh')
        })
      }
    },
    resetForm() {
      this.book = {
        title: '',
        author: '',
        page: '',
        category_id: '',
        publish_date: ''
      }
      this.isEdit = false
    }
  }
}
</script>
