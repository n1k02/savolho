<template>
  <div class="card">
    <div class="card__img">
      <img :src="`${img}`" alt="">
    </div>
    <div class="card__content">
      <div class="card__title">{{ title }}</div>
      <div class="card__author-info">
        <div class="card__author-img">
          <img :src="`${author.img}`" alt="">
        </div>
        от
        <div class="card__author-name">{{ author }}</div>
        <div class="card__date"> &nbsp;&nbsp;&nbsp; | &nbsp;{{ date }}</div>
      </div>
      <div class="card__category">
        <div v-for="(c, index) in category" :key="c">
          <div class="ctg" :class="`${index % 2  ? 'purple': 'red'}`">{{ c }}</div>
        </div>
      </div>
      <div class="card__text">{{ description }}</div>
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
  props: {
    img_url: {
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
    date: {
      type: String,
    },
    category: {
      type: Array,
      default: []
    },
  }
}
</script>

<style lang="scss" scoped>
.card {
  background: var(--white);
  border-radius: 6px;
  box-shadow: 0px 4px 24px rgba(0, 0, 0, 0.06);
  overflow: hidden;
  transition: 0.3s;
  cursor: pointer;
  &:hover {
    transform: scale(1.01);
  }
  &__img {
    height: 222px;
    width: 100%;
    img {
      min-height: 100%;
      display: block;
      object-fit: cover;
    }
  }

  &__content {
    padding: 23px 23px 10px;
  }

  &__title {
    font-size: 18px;
  }

  &__author-info {
    display: flex;
    font-size: 12px;
    align-items: center;
    padding-top: 5px;
  }

  &__author-img {
    display: inline-block;
    border-radius: 50%;
    overflow: hidden;
    width: 30px;
    height: 30px;
    margin-right: 10px;

    img {
      min-height: 100%;
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
    padding-top: 12px;

    & .ctg {
      padding: 1px 9px;
      border-radius: 17px;
      margin-right: 7px;

      &.red {
        background: rgba(234, 84, 85, 0.12);
        color: #EA5455;
      }

      &.purple {
        background: rgba(115, 103, 240, 0.12);
      }
    }
  }
  &__text {
    padding-top: 11px;
    height: 50px;
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
}
</style>