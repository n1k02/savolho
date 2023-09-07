import axios from "axios";
import store from "../store";

export const getCategories = async () => {
  await axios.get('https://savolho/api/categories/')
    .then(res => {
      store.commit('setCategories', {categories: res.data})
    })
    .catch(err => {
      console.log(err);
    })
}

