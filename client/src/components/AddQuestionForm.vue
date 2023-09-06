<template>
  <div class="add-question">
    <h3 class="add-question">Add question</h3>
    <form action="" class="add-question__form form">
      <div class="form__row">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="title">
      </div>
      <div class="form__row">
        <label for="description">description</label>
        <input type="text" name="description" placeholder="description">
      </div>
      <div class="form__row">
        <label for="categories">categories</label>
        <select name="categories" class="form" multiple>
          <option value="1">ctg 1</option>
          <option value="2">ctg 2</option>
          <option value="3">ctg 3</option>
          <option value="4">ctg 4</option>
        </select>
        
      </div>
      <div class="form__row">
        <label for="image">image</label>
        <input type="file" name="image">
      </div>
      
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        question: {
          title: '',
          description: '',
          author: 'Jason Statham',
          categories: [],
          image_url: ''
        }
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>