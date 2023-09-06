
<template>
  <div>
    <Header/>
  <div class="row">
    <Sidebar/>
    <slot />
    <div class="right-side"></div>
  </div>
  </div>
</template>

<script setup>

import Header from "../components/Header.vue";
import Sidebar from "../components/Sidebar.vue";


</script>

<style lang="scss">


</style>
