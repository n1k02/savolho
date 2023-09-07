import {createStore} from "vuex";

const store = createStore({
    state () {
        return {
            searchKeyWord: '',
            filterCtg: '',
            // activePage: 'main',
            categories: [],
            activeCtg: ''
        }
    },
    mutations: {
        setSearchKeyWord (state, payload) {
            state.searchKeyWord = payload.searchKeyWord
        },
        // setActivePage(state, payload) {
        //     state.activePage = payload.activePage
        // },
        setFilterCtg(state, payload) {
            state.filterCtg = payload.filterCtg
        },
        setCategories(state, payload) {
            state.categories = payload.categories
        }
    }
})
export default store