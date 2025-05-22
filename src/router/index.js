// src/router.js
import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import BookView from '../views/BookView.vue'
import CategoryView from '../views/CategoryView.vue'
import LoginView from '../views/Login.vue'
import Filtercategory from '../components/Filtercategory.vue'

const routes  = [
    // {
    //     path : '/',
    //     name : 'home',
    //     component : Home
    // },
    {
        path : '/Home',
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
    {
        path : '/filter-category/:name',
        name : 'filtercategory',
        component : Filtercategory
    },

    // login
      {
        path : '/',
        name : 'login',
        component : LoginView
    },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
