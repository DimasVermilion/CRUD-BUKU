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
import api from '@api/api.js'

export default {
  props: ['editData'],
  data() {
    return {
      form: {
        category: '',
        id: null
      }
    }
  },
  watch: {
    editData(newVal) {
      if (newVal) {
        this.form = { ...newVal }
      } else {
        this.resetForm()
      }
    }
  },
  methods: {
    async handleSubmit() {
      try {
        if (this.form.id) {
          await api.put(`/update-category/${this.form.id}`, this.form)
        } else {
          await api.post('/store-category', this.form)
        }
        this.$emit('refresh')
        this.resetForm()
      } catch (error) {
        console.error('Error saat submit kategori:', error)
      }
    },
    resetForm() {
      this.form = { category: '', id: null }
      this.$emit('clear-edit')
    }
  }
}
</script>
