<template>
    <button :class="`button ${style === 2 ? 'fill' : ''}`">{{text}}</button>
</template>

<script>
export default {
  props: {
    text: {
      type: String,
      required: true,
    },
    style: {
      type:Number,
      default: 1
    }
  },
  data() {
  }
}
</script>

<style lang="scss" scoped>

  .button {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border-radius: 6px;
    border: 1px  solid var(--gray);
    &.fill {
      background: var(--gray);
      color: var(--white);
    }
  }
</style>