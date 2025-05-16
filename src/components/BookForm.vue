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
        <select v-model="form.id_category" class="form-control" required>
          <option disabled value="">Pilih Kategori</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.category }}
          </option>
        </select>
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
        id: null,
        title: '',
        author: '',
        id_category: ''
      },
      categories: []
    }
  },
  watch: {
    editData(newVal) {
      if (newVal) {
        this.form = { ...newVal }
      }
    }
  },
  mounted() {
    // Ambil daftar kategori dari backend saat komponen dimount
    axios.get('http://localhost:8000/categories')
      .then(res => {
        this.categories = res.data
      })
      .catch(err => {
        console.error('Gagal memuat kategori:', err)
      })
  },
  methods: {
    handleSubmit() {
      const url = `http://localhost:8000/books${this.form.id ? '/' + this.form.id : ''}`
      const method = this.form.id ? 'put' : 'post'

      axios[method](url, this.form)
        .then(() => {
          this.$emit('refresh')
          this.resetForm()
        })
        .catch(err => {
          console.error('Gagal menyimpan data buku:', err)
        })
    },
    resetForm() {
      this.form = { id: null, title: '', author: '', id_category: '' }
      this.$emit('clear-edit')
    }
  }
}
</script>
