import {createStore} from "vuex";
import axios from 'axios'

const store = createStore({
    state () {
        return {
            user: {
                name: 'Nik'
            },
            questions: [],
            searchKeyword: '',
            searchCategory: {},
            categories: []
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
        setSearchKeyword (state, searchKeyword) {
            state.searchKeyword = searchKeyword
        },
        // setActivePage(state, payload) {
        //     state.activePage = payload.activePage
        // },
        setSearchCategory(state, searchCategory) {
            state.searchCategory = searchCategory
        },
        
    },
    actions: {
        async fetchQuestions({state, commit}) {
            state.questions = []

            await axios.get(`questions/`, {
                params: {
                    searchCategory: state.searchCategory.id || undefined,
                    searchKeyword: state.searchKeyword || undefined
                }
            })
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
            await axios.get('categories/')
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