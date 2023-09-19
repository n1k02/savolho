<template>
  <div class="grid">
    <div class="grid__filterCtg" v-if="$store.state.searchCategory.name">{{$store.state.searchCategory.name}} <span class="grid__removeCtg" @click="$store.commit('setSearchCategory', ''); $store.dispatch('fetchQuestions')">X</span></div>
    <Card v-if="$store.state.questions.length" v-for="question in $store.state.questions" :key='question.id'
            :id='question.id'
            :title="question.title"
            :description="question.description"
            :author="question.author"
            :date_added="question.date_added"
            :categories="question.categories"
            :image_url='question.image_url'
            :answers='question.answers'
            :likes='question.likes'
            @click="$router.push('/question/' + question.id)"
      >
    </Card>
    <div v-else>
        No questions
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";
// import {questions} from "../questions.json"

export default {
  components: {Card},
  mounted() {
    this.$store.dispatch('fetchQuestions')
  },
  computed: {
    getSearchKeyWord() {
      return this.$store.state.searchKeyWord
    },
    getFilterCtg() {
      return this.$store.state.filterCtg
    },
    getFilteredQuestions() {
      // return this.questions.filter(question => {
      //   if((question.title.toLowerCase().includes(this.getSearchKeyWord) || question.description.toLowerCase().includes(this.getSearchKeyWord)) && (!this.getFilterCtg || question.categories.includes(this.getFilterCtg))) {
      //     return question
      //   }
      // })
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