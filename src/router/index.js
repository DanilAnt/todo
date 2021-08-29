import { createRouter, createWebHashHistory } from 'vue-router';
import MainPage from '../views/MainPage.vue';
import EditTodo from '../views/EditTodo.vue';
import AddTodo from '../views/AddTodo.vue';



const routes = [
  {
    path : '/',
    name : 'main',
    component : MainPage
  },
  {
    path : '/add',
    name : 'add',
    component : AddTodo
  },
  {
    path : '/edit/:id',
    name : 'edit',
    component : EditTodo
  }
]

const router = createRouter({
  mode : 'history',
  history: createWebHashHistory(),
  routes
})

export default router
