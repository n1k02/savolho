<template>
  <div class="category">
    <h3 class="category__header">Выберите тему:</h3>
    <div v-for="ctg in $store.state.category" :key="ctg" @click="$store.commit('setFilterCtg', {filterCtg: ctg}); $store.commit('setActivePage', {activePage: 1})">
      <div class="category__item">{{ ctg }}</div>
    </div>
  </div>
</template>

<script>
export default {

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
    cursor: pointer;
    transition: 0.3s ease;
    &:hover {
      color: var(--white);
      background: var(--gray);
    }
  }
}
</style>