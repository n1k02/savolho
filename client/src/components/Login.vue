<template>
  <div class="login">
    <div>
      <form @submit.prevent="submit"  @submit="checkForm">
        <div>
          <label for="email">Email:</label>
          <input type="text" name="email" v-model="form.email" />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" v-model="form.password" />
        </div>
        <div class="register-link">
          <router-link to="/register"> Register </router-link>
        </div>
        <button type="submit" @click="login()">Submit</button>
        <br/>
          <p v-if="showError" id="error">Username already exists</p>
    <p v-if="errors.length">
    <b id="error">Пожалуйста исправьте указанные ошибки:</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
      </form>
      <p v-if="showError" id="error">Username or Password is incorrect</p>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  name: "Login",
  components: {},
  data() {
    return {
      errors: [],
      form: {
        email: "",
        password: "",
      },
      showError: false,
    }
  },
  methods: {
    checkForm: function (e) {
      this.errors = [];
      if(!this.form.password) {
        this.errors.push('Укажите пароль');
      }
      if (!this.form.email) {
        this.errors.push('Укажите электронную почту.');
      } else if (!this.validEmail(this.form.email)) {
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
    async login () {
      const data = new FormData()
      data.append('email', this.form.email)
      data.append('password', this.form.password)
      try {
          await axios.post('users/login/', data)
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
