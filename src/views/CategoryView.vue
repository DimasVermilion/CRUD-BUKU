<!-- src/views/CategoryView.vue -->
<template>
  <div>
    <CategoryForm :editData="selectedCategory" @refresh="loadCategories" @clear-edit="selectedCategory = null" />
    <CategoryList ref="categoryList" @edit-category="selectedCategory = $event" />
  </div>
</template>

<script>
import CategoryForm from '../components/CategoryForm.vue'
import CategoryList from '../components/CategoryList.vue'

export default {
  components: { CategoryForm, CategoryList },
  data() {
    return {
      selectedCategory: null,
    }
  },
  methods: {
    loadCategories() {
      this.$refs.categoryList.fetchCategories()
    }
  }
}
</script>
