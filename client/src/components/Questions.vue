<template>
  <div class="grid">
    <div class="grid__filterCtg" v-if="$store.state.filterCtg">{{$store.state.filterCtg}} <span class="grid__removeCtg" @click="$store.commit('setFilterCtg', {filterCtg: ''})">X</span></div>
    <Card v-for="question in questions" :key='question.id'
            :id='question.id'
            :title="question.title"
            :description="question.description"
            :author="question.author"
            :date_added="question.date_added"
            :categories="question.categories"
            :image_url='question.image_url'
            :answers='question.answers'
            :likes='question.likes'
      >
    </Card>
  </div>
</template>

<script>
import Card from "./Card.vue";
// import {questions} from "../questions.json"
import axios from 'axios'

export default {
  components: {Card},
  data(){
    return {
      questions: [],
    }
  },
  methods: {
    async getQuestions() {
      await axios.get('https://savolho/api/')
        .then(response => {
          // let data = response.data
          this.questions = response.data
          this.questions.forEach(element => {
            // questions: [categories: {categories: [ctg, ctg...]}]]
            element.categories = JSON.parse(element.categories).categories
          });
          console.log(this.questions);
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  mounted() {
    this.getQuestions()
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
    }
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