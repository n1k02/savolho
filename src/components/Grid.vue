<template>
  <div class="grid">
    <div v-for="question in questions" :key="question.id">
      <Card :img='question.img'
            :title="question.title"
            :author="question.author"
            :date="question.date"
            :category="question.category"
            :answers="question.answers"
            :text="question.text"
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
  }
}
</script>

<style lang="scss" scoped>
.grid {
  width: 50%;
  margin-top: 33px;
  display: grid;
  gap: 20px;
  grid-template-columns: 1fr 1fr;
}
</style>