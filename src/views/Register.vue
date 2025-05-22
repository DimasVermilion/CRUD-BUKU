<template>
  <div class="container mt-4">
    <h3>Register</h3>
    <form @submit.prevent="handleRegister">
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" v-model="name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" v-model="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" v-model="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-success">Register</button>
    </form>
  </div>
</template>

<script>
import api from '@api/api.js'

export default {
  data() {
    return {
      name: '',
      email: '',
      password: ''
    }
  },
  methods: {
    async handleRegister() {
      try {
        await api.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password
        })
        alert('Register berhasil, silakan login!')
        this.$router.push('/')
      } catch (err) {
        alert('Gagal daftar: ' + err.response.data.message)
      }
    }
  }
}
</script>
