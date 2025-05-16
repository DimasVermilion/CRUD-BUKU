<!-- src/components/BookForm.vue -->
<template>
  <div class="container mt-4">
    <h3>{{ form.id ? 'Edit Buku' : 'Tambah Buku' }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="mb-3">
        <label class="form-label">Judul</label>
        <input v-model="form.title" type="text" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input v-model="form.author" type="text" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input v-model="form.category" type="text" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-success">{{ form.id ? 'Update' : 'Tambah' }}</button>
      <button type="button" class="btn btn-secondary ms-2" @click="resetForm">Reset</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  props: ['editData'],
  data() {
    return {
      form: {
        title: '',
        author: '',
        category: '',
      }
    }
  },
  watch: {
    editData(newVal) {
      if (newVal) {
        this.form = { ...newVal }
      }
    }
  },
  methods: {
    handleSubmit() {
      if (this.form.id) {
        axios.put(`http://localhost:8000/books/${this.form.id}`, this.form).then(() => {
          this.$emit('refresh')
          this.resetForm()
        })
      } else {
        axios.post('http://localhost:8000/books', this.form).then(() => {
          this.$emit('refresh')
          this.resetForm()
        })
      }
    },
    resetForm() {
      this.form = { title: '', author: '', category: '' }
      this.$emit('clear-edit')
    }
  }
}
</script>
