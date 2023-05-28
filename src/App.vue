
<template>
  <Header/>
  <div class="row">
    <Sidebar/>
    <Grid/>
    <div class="right-side"></div>
  </div>
</template>

<script setup>

import Header from "./components/Header.vue";
import Sidebar from "./components/Sidebar.vue";
import Grid from "./components/Grid.vue";
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
