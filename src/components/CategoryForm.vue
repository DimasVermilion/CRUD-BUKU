<template>
  <div class="container mt-4">
    <h3>{{ form.id ? 'Edit Kategori' : 'Tambah Kategori' }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
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
        axios.put(`http://localhost:8000/categories/${this.form.id}`, this.form).then(() => {
          this.$emit('refresh')
          this.resetForm()
        })
      } else {
        axios.post('http://localhost:8000/categories', this.form).then(() => {
          this.$emit('refresh')
          this.resetForm()
        })
      }
    },
    resetForm() {
      this.form = { category: '' }
      this.$emit('clear-edit')
    }
  }
}
</script>
