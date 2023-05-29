<template>
  <div class="grid">
    <div class="grid__filterCtg" v-if="$store.state.filterCtg">{{$store.state.filterCtg}} <span class="grid__removeCtg" @click="$store.commit('setFilterCtg', {filterCtg: ''})">X</span></div>
    <div v-for="question in questions" :key="question.id">
      <Card v-if="question.title.includes(getSearchKeyWord) && (!getFilterCtg || question.category.includes(getFilterCtg))" :img='question.img'
            :title="question.title"
            :author="question.author"
            :date="question.date"
            :category="question.category"
            :answers="question.answers"
            :text="question.text.length < 50 ? question.text : question.text.substring(0, 50) + '...' "
      />
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";
import {questions} from "../questions.json"
export default {
  components: {Card},
  data(){
    return {
      questions
    }
  },
  computed: {
    getSearchKeyWord() {
      return this.$store.state.searchKeyWord
    },
    getFilterCtg() {
      return this.$store.state.filterCtg
    },
  }
}
</script>

<style lang="scss" scoped>
.grid {
  position: relative;
  width: 50%;
  margin-top: 33px;
  display: grid;
  gap: 20px;
  grid-template-columns: 1fr 1fr;
  &__filterCtg {
    font-size: 13px;
    position: absolute;
    top: -28px;
    left: 0;
    border-radius: 8px;
    border:1px solid var(--gray);
    padding: 1px 8px;
  }
  &__removeCtg {
    cursor: pointer;
    color: red;
    display: inline-block;
    padding-top: 1px;
  }
}
</style>