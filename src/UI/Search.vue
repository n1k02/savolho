<template>
  <div class="search">
    <input type="search" name="search" id="search" placeholder="Поиск по сайту">
    <div class="search__icon">
      <img src="../assets/find.svg" class="find" alt="find">
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style lang="scss" scoped>
  .search {
    flex: 0 0 50%;
    display: flex;
    position: relative;
    align-items: center;
    input {
      font-family: Montserrat, Inter, system-ui, Avenir, Helvetica, sans-serif;
      border: none;
      border-radius: 6px;
      width: 100%;
      padding: 1rem;
    }
    &__icon {
      height: 20px;
      width: 20px;
      position: absolute;
      right: 10px;
      img {
        object-fit: cover;
      }
    }
}
</style>