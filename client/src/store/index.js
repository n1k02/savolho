import {createStore} from "vuex";
import axios from 'axios'

const store = createStore({
    state () {
        return {
            user: {
                name: 'Nik'
            },
            questions: [],
            searchKeyWord: '',
            filterCtg: '',
            // activePage: 'main',
            categories: [],
            activeCtg: ''
        }
    },
    getters: {
        getCategoryById: (state) => (id) => {
            return state.categories.find(ctg => ctg.id === id)
        }
    },
    mutations: {
        setQuestions(state, questions) {
            state.questions = questions
        },
        setCategories(state, categories) {
            state.categories = categories
        },
        setSearchKeyWord (state, payload) {
            state.searchKeyWord = payload.searchKeyWord
        },
        // setActivePage(state, payload) {
        //     state.activePage = payload.activePage
        // },
        setFilterCtg(state, payload) {
            state.filterCtg = payload.filterCtg
        },
        
    },
    actions: {
        async fetchQuestions({state, commit}) {
            await axios.get('https://savolho/api/')
              .then(response => {
                let data = response.data
                data.forEach(element => {
                  element.categories = JSON.parse(element.categories).categories
                });
                commit('setQuestions', data)
              })
              .catch(error => {
                console.log(error);
              })
        },
        async fetchCategories({state, commit}) {
            await axios.get('https://savolho/api/categories/')
              .then(res => {
                commit('setCategories', res.data)
              })
              .catch(err => {
                console.log(err);
              })
          }
          
          
    }
})
export default store