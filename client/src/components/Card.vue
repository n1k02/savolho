<template>
  <div class="card">
    <div class="card__img">
      <img :src="`../src/questions/${image_url}`" alt="">
    </div>
    <div class="card__content">
      <div class="card__title">{{ title }}</div>
      <div class="card__author-info">
        <div class="card__author-img">
          <!-- <img :src="`${author.img}`" alt=""> -->
        </div>
        <!-- от -->
        <div class="card__author-name">{{ author }}</div>
        <div class="card__date"> &nbsp;&nbsp;&nbsp; | &nbsp;{{ date_added.slice(0, 10) }}</div>
      </div>
      <div class="card__category">
        <div v-for="(ctg, index) in categories" :key="ctg">
          <div class="ctg" :class="`${index % 2 ? 'purple' : 'red'}`">
          {{ $store.getters.getCategoryById(ctg)?.name }}
          </div>
        </div>
      </div>
      <div class="card__description">{{ description }}</div>
      <div class="card__menu">
        <div class="card__likes">
          Like | Оценить
        </div>
        <div class="card__answers">{{ answers }} ответ(-ов)</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // props: ['img', 'title', 'description', 'author', 'answers', 'date', 'category']
  data() {
    return {
      counter: 0
    }
  },
  mounted() {
    
  },
  props: {
    image_url: {
      type: String,
    },
    title: {
      type: String,
    },
    description: {
      type: String,
    },
    author: {
      type: String,
    },
    answers: {
      type: Number,
      default: 0
    },
    likes: {
      type: Number,
      default: 0
    },
    date_added: {
      type: String,
    },
    categories: {
      type: Array,
      default: []
    },
  }
}
</script>

<style lang="scss" scoped>
.card {
  display: flex;
  flex-direction: column;
  background: var(--white);
  max-width: 100%;
  border-radius: 6px;
  box-shadow: 0px 4px 24px rgba(0, 0, 0, 0.06);
  transition: 0.3s;
  cursor: pointer;
  
  &:hover {
    transform: scale(1.01);
  }

  &__img {
    height: 222px;
    width: 100%;

    img {
      min-width: 100%;
      height: 100%;
      display: block;
      object-fit: cover;
      object-position: 50% 50%;
    }
  }

  &__content {
    padding: 23px 23px 10px;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
  }

  &__title {
    font-size: 18px;
  }

  &__author-info {
    display: flex;
    font-size: 12px;
    align-items: center;
    padding-top: 5px;
    justify-content: end;
  }

  &__author-img {
    border-radius: 50%;
    overflow: hidden;
    width: 30px;
    height: 30px;
    margin-right: 10px;

    img {
      display: block;
      object-fit: cover;
    }
  }

  &__author-name {
    display: flex;
    margin-left: 10px;
    font-weight: 600;
  }

  &__date {
    margin-left: 10px;
    font-weight: 300;
  }

  &__category {
    display: flex;
    flex-wrap: wrap;
    padding-top: 12px;
    max-width: 100%;
    & .ctg {
      padding: 3px 9px;
      border-radius: 17px;
      margin-right: 7px;
      margin-bottom: 10px;
      &.red {
        background: rgba(234, 84, 85, 0.12);
        color: #EA5455;
      }

      &.purple {
        background: rgba(115, 103, 240, 0.12);
      }
    }
  }

  &__description {
    padding-top: 11px;
    height: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
    flex: 1 1 100%;
  }

  &__menu {
    margin-top: 5px;
    padding-top: 14px;
    border-top: 1px solid #EBE9F1;
    display: flex;
    justify-content: space-between;
  }

  &__likes {
    border: 0.5px solid var(--gray);
    padding: 3px 7px;
    border-radius: 8px;
  }
}</style>