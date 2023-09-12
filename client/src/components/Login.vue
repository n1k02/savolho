<template>
  <div class="login">
    <div>
      <form @submit.prevent="submit">
        <div>
          <label for="email">Email:</label>
          <input type="text" name="enail" v-model="form.enail" />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" v-model="form.password" />
        </div>
        <div class="register-link">
          <router-link to="/register"> Register </router-link>
        </div>
        <button type="submit">Submit</button>
      </form>
      <p v-if="showError" id="error">Username or Password is incorrect</p>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex"
export default {
  name: "Login",
  components: {},
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      showError: false,
    }
  },
  methods: {
    
  },
}
</script>
<style scoped lang="scss">
* {
  box-sizing: border-box;
}
.login {
  display: flex;
  place-content: center;
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}
label[for="email"] {
  padding-right: 40px;
}
button[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 30px;
  background-color: var(--gray);
}
.register-link {
  float: right;
  font-size: 0.9rem;
}
button[type="submit"]:hover {
  background-color: #45a049;
}
input {
  margin: 5px;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  padding: 10px;
  border-radius: 30px;
}
#error {
  color: red;
}
</style>
