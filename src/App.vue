
<template>
  <Header/>
  <div class="row">
    <Sidebar/>
    <Questions v-if="$store.state.activePage === 1"/>
    <Category v-if="$store.state.activePage === 2"/>
    <div class="right-side"></div>
  </div>
</template>

<script setup>

import Header from "./components/Header.vue";
import Sidebar from "./components/Sidebar.vue";
import Questions from "./components/Questions.vue";
import Category from "./components/Category.vue";
</script>

<style lang="scss">
.row {
  width: 100%;
  display: flex;

  justify-content: space-between;
}
.right-side{
  flex: 0 0  192.8px;
}

</style>
