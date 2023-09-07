<template>
  <div class="category">
    <h3 class="category__header">Выберите тему:</h3>
    <div v-for="ctg in $store.state.categories" :key="ctg" @click="$store.commit('setFilterCtg', {filterCtg: ctg})">
      <div class="category__item btn_white">{{ ctg.name }}</div>
    </div>
  </div>
</template>

<script>

export default {
  methods: {
   
  },
  mounted() {
    if(!this.$store.state.categories.length) {
        this.$store.dispatch('fetchCategories')
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