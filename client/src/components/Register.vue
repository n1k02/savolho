<template>
  <div class="register">
    <div>
      <form @submit.prevent="submit">
        <div>
          <label for="full_name">Full Name:</label>
          <input type="text" name="full_name" v-model="form.full_name" />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" v-model="form.password" />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="text" name="email" v-model="form.email" />
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
    <p v-if="showError" id="error">Username already exists</p>
  </div>
</template>

<script>
import { mapActions } from "vuex"
export default {
  name: "Register",
  components: {},
  data() {
    return {
      form: {
        email: "",
        full_name: "",
        password: "",
      },
      showError: false,
    }
  },
  methods: {
    ...mapActions(["Register"]),
    async submit() {
      try {
        await this.Register(this.form)
        this.$router.push("/posts")
        this.showError = false
      } catch (error) {
        this.showError = true
      }
    },
  },
}
</script>

<style scoped lang="scss">
* {
  box-sizing: border-box;
}
.register {
  display: flex;
  place-content: center;
}
form {
  display: flex;
  flex-direction: column;
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
  background-color: var(--gray);
  color: white;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 30px;
  max-width: 100px;
  margin-left: 60px;
  align-self: center;
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
