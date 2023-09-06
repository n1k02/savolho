import {createStore} from "vuex";

const store = createStore({
    state () {
        return {
            searchKeyWord: '',
            filterCtg: '',
            // activePage: 'main',
            category: [
                'Игры',
                'Еда',
                'Спорт',
                'Технологии',
                'Туризм',
                'Автомобили',
            ],
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
        }
    }
})
export default store