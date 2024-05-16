import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'

import App from './App.vue'
import CreateOrEditTask from './components/CreateOrEditTask.vue'
import ListTasks from './components/ListTasks.vue'
import Home from './components/Home.vue'

const routes = [
    { path: '/', name: "home", component: Home },
    { path: '/tasks/create', name: "taskCreate", component: CreateOrEditTask },
    { path: '/tasks/edit/:id', name: "taskEdit", component: CreateOrEditTask },
    { path: '/tasks', name: "taskList", component: ListTasks },
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