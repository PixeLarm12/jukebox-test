import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'

import App from './App.vue'
import CreateOrEditTask from './pages/CreateOrEditTask.vue'
import ListTasks from './pages/ListTasks.vue'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'

const routes = [
    { path: '/', name: "home", component: Home, meta: { title: 'Home'} },
    { path: '/login', name: "login", component: Login, meta: { title: 'Login'} },
    { path: '/tasks/create', name: "taskCreate", component: CreateOrEditTask, meta: { title: 'Create Task'} },
    { path: '/tasks/edit/:id', name: "taskEdit", component: CreateOrEditTask, meta: { title: 'Edit Task'} },
    { path: '/tasks', name: "taskList", component: ListTasks, meta: { title: 'List Tasks'} },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

createApp(App).use(router).mount('#app')