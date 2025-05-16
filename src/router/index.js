// src/router.js
import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import BookView from '../views/BookView.vue'
import CategoryView from '../views/CategoryView.vue'

const routes  = [
    {
        path : '/',
        name : 'home',
        component : Home
    },
    {
        path : '/books',
        name : 'books',
        component : BookView
    },
    {
        path : '/categories',
        name : 'categories',
        component : CategoryView
    },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
