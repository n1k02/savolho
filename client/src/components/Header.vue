<template>
  <div class="header">
    <img class="header__logo" src="../assets/logo.svg" alt="SAVOLHO">
    <Search />
    <div class="header__buttons-block">
      <router-link to="/add-question">
        <GreyBtn class="header__btn btn_white" text="Задать вопрос" />
      </router-link>
      <router-link to="/login">
        <GreyBtn class="header__btn" text="Войти" :style="2" />
      </router-link>
    </div>
  </div>
</template>

<script>
import Search from "../UI/Search.vue";
import GreyBtn from "../UI/Grey-btn.vue";

export default {
  components: { GreyBtn, Search }

}
</script>

<style lang="scss" scoped>
.header {
  display: flex;
  justify-content: space-between;

  &__logo {
    flex: 0 0 174px;
  }

  &__buttons-block {
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;

    & :nth-child(2) {
      margin-left: 5px;
    }
  }

  &__btn {
    height: 100%;
  }
}</style>