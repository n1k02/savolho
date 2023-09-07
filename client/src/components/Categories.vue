<template>
  <div class="category">
    <h3 class="category__header">Выберите тему:</h3>
    <div v-for="ctg in $store.state.categories" :key="ctg" @click="$store.commit('setFilterCtg', {filterCtg: ctg}); $store.commit('setActivePage', {activePage: 'main'})">
      <div class="category__item btn_white">{{ ctg.name }}</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  methods: {
    async getCategories() {
      await axios.get('https://savolho/api/categories/')
        .then(res => {
          this.$store.commit('setCategories', {categories: res.data})
        })
    }
  },
  mounted() {
    if(this.$store.state.categories.length === 0) {
      this.getCategories()
    }
  }
}
</script>

<style lang="scss" scoped>
.category {
  width: 50%;
  margin-top: 33px;
  &__header {
    margin-top: -20px;
  }
  &__item {
    margin-top: 10px;
    padding: 10px;
    text-align: center;
    border: 1px solid var(--gray);
    border-radius: 12px;
  }
}
</style>