import { createRouter, createWebHistory } from 'vue-router';
import Popular from '../views/Popular.vue';
import AppVue from '../App.vue';
import Categories from '../views/Categories.vue'
import AddQuestion from '../views/AddQuestion.vue'

const routes = [
  {path: '/', redirect: '/popular', component: AppVue, children: [
    { path: 'popular', component: Popular },
    { path: 'categories', component: Categories },
    { path: 'add-question', component: AddQuestion },
  ]},
 ,
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router