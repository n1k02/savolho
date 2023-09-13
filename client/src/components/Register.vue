<template>
  <div class="register">
    <div>
      <form @submit.prevent="submit"  @submit="checkForm">
  
        <div class="form__row">
          <label for="full_name">Full Name:</label>
          <input type="text" name="full_name" v-model="form.name" />
        </div>
        <div class="form__row">
          <label for="password">Password:</label>
          <input type="password" name="password" v-model="form.password" />
        </div>
        <div class="form__row">
          <label for="email">Email:</label>
          <input type="text" name="email" v-model="form.email" />
        </div>
          <button type="submit" @click="registration()">Submit</button>
          <br/>
          <p v-if="showError" id="error">Username already exists</p>
    <p v-if="errors.length">
    <b id="error">Пожалуйста исправьте указанные ошибки:</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
        </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "Register",
  components: {},
  data() {
    return {
      errors: [],
      form: {
        email: "",
        name: "",
        password: "",
      },
      showError: false,
    }
  },
  methods: {
    checkForm: function (e) {
      this.errors = [];

      if (!this.form.name) {
        this.errors.push('Укажите имя.');
      }
      if (!this.form.password) {
        this.errors.push('Укажите пароль.');
      }
      if (!this.form.email) {
        this.errors.push('Укажите электронную почту.');
      } else if (!this.validEmail(this.email)) {
        this.errors.push('Укажите корректный адрес электронной почты.');
      }

      if (!this.errors.length) {
        return true;
      }

      e.preventDefault();
    },
    // validEmail: function (email) {
    //   var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //   return re.test(email);
    // },
    async registration() {
      const data = new FormData()
      data.append('name', this.form.name)
      data.append('email', this.form.email)
      data.append('password', this.form.password)
      try {
          await axios.post('users/registration/', data)
            .then(res => {
              console.log(res.status);
            })
      } catch(e) {
        console.log(e);
      }
    }
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
}
.form__row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
button {
  margin-top: 10px;
  width: 100%;
  background-color: var(--gray);
  color: white;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 30px;
  align-self: center;
  transition: all 0.3s ease;
}
button:hover {
  background-color: rgba(0, 0, 0, 0.6);
}
input {
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  padding: 10px;
  border-radius: 30px;
  margin-top: 10px;
  margin-left: 20px;
}
#error {
  color: red;
}
</style>
