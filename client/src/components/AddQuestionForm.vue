<template>
  <div class="add-question">
    <h2 class="add-question__title">Создать вопрос</h2>
    <form action="" class="add-question__form form">
      <div class="form__row">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title" v-model="question.title">
      </div>
      <div class="form__row">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="description" v-model="question.description">
      </div>
      <div class="form__row">
        <label for="categories">Categories</label>
        <option disabled value="">Select category</option>
        <select name="categories" class="form" multiple v-model="question.categories.categories">
          <option v-for="ctg in $store.state.categories" :value="ctg.id" :key="ctg.id">{{ ctg.name }}</option>
        </select>
        
      </div>
      <div class="form__row">
        <label for="image">image</label>
        <input type="file" name="image" id="imageInput" ref="imageInput">
      </div>
      
      <div class="form__row">
        <input type="button" name="button" value="Создать" @click="addQuestion"/>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

  export default {
    data() {
      return {
        question: {
          title: '',
          description: '',
          author: this.$store.state.user.id,
          categories: {
            categories: []
          },
        }
      }
    },
    mounted() {
      if(this.$store.state.categories.length <= 0) {
        this.$store.dispatch('fetchCategories')
      }
    },
    methods: {
      async addQuestion() {
        const imageInput = this.$refs.imageInput
        const formData = new FormData();
        formData.append('title', this.question.title)
        formData.append('description', this.question.description)
        formData.append('author', this.question.author)
        formData.append('categories', JSON.stringify(this.question.categories))
        formData.append('image', imageInput.files[0]);
        await axios.post('questions/', formData)
          .then(res => {
            console.log(res.data);
          })  
          .catch(err => {
            console.log(err);
          })
      }
    }
  }
</script>

<style lang="scss" scoped>
.add-question {

  &__title {
    text-align: center;
    margin-top: 20px;
  }

  &__form {
    
  }
}
.form {

  &__row {
    margin: 10px 0px 0px 0px;
    display: flex;
    flex-wrap: wrap;
  }
  & input {
    width: 100%;
    font-size: 20px;
    padding: 3px 5px;
  }
  & label {
    font-size: large;
    padding-right: 15px;
  }
  & select {
    width: 100%;
  }
}
</style>