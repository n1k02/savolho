
<template>
 <router-view />
</template>

<script setup>

</script>

<style lang="scss">


@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600&family=Titillium+Web:ital,wght@0,400;0,600;1,400&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Montserrat, Inter, system-ui, Avenir, Helvetica, sans-serif;

}
:root {
  line-height: 1.5;
  font-weight: 400;
  font-size: 14px;

  color: var(--gray);
  background: linear-gradient(180deg, #E4E4E4 0%, #EAEAEA 25.04%);

  --gray: #2E2F31;
  --white: #fff;

}
ul {
  list-style: none;
}
img {
  display: block;
  max-width: 100%;
}
a {
  text-decoration: inherit;
}

body {
  margin: 0;
  display: flex;
  min-width: 320px;
  min-height: 100vh;
}

h1 {
  font-size: 3.2em;
  line-height: 1.1;
}

#app {
  max-width: 1440px;
  width: 100%;
  margin: 0 auto;
  padding: 1rem;
}



.row {
  width: 100%;
  display: flex;

  justify-content: space-between;
}
.right-side{
  flex: 0 0  192.8px;
}

.btn_white {
  cursor: pointer;
    transition: 0.3s ease;
    &:hover {
      color: var(--white);
      background: var(--gray);
    }
}

</style>
