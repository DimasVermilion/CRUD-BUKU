<template>
  <div class="container mt-4">
    <h3>Login</h3>
    <form @submit.prevent="handleLogin">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" v-model="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" v-model="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script>
import api from '@api/api.js'

export default {
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    async handleLogin() {
      try {
        const res = await api.post('/login', {
          email: this.email,
          password: this.password
        })
        alert('Login berhasil!')
        localStorage.setItem('token', res.data.token)
        this.$router.push('/home')
      } catch (err) {
        alert('Login gagal: ' + err.response.data.message)
      }
    }
  }
}
</script>
