<template>
    <page-template>
        <div class="w-10/12 flex flex-col justify-center items-center min-h-[80vh]">
            <h1 class="col-span-12 text-default-gray font-bold text-5xl pb-12">Listing Tasks</h1>

            <table v-if="tasks.length > 0" class="w-full bg-gray-100">
                <tr class="w-full border border-blue-950">
                    <th class="bg-default-blue text-white font-bold py-3 border-r border-blue-950">ID</th>
                    <th class="bg-default-blue text-white font-bold py-3 border-r border-blue-950">Title</th>
                    <th class="bg-default-blue text-white font-bold py-3 border-r border-blue-950">User</th>
                    <th class="bg-default-blue text-white font-bold py-3 border-r border-blue-950">Actions</th>
                </tr>

                <tr v-for="task in tasks" :key="task.id" class="w-full border border-gray-300">
                    <th class="text-default-gray py-2 border-r border-gray-300">{{ task.id }}</th>
                    <th class="text-default-gray py-2 border-r border-gray-300">{{ task.title }}</th>
                    <th class="text-default-gray py-2 border-r border-gray-300">{{ task.user_id }}</th>
                    <th class="text-default-gray py-2 border-r border-gray-300 flex justify-center items-center">
                        <div class="w-5/12 flex flex-row justify-around">
                            <router-link :to="{name: 'taskEdit', params: {id: task.id} }" class="hover:underline">Edit Task</router-link>
                            <button @click="remove(task.id)" class="hover:underline">Delete Task</button>
                        </div>
                    </th>
                </tr>
            </table>

            <p v-else class="break-words text-default-gray text-lg"> 
                Sorry, but we don't have any tasks at database! Try to <router-link :to="{name: 'taskCreate'}" class="underline">Create a new one</router-link>
            </p>
        </div>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from '../components/utils/PageTemplate.vue';

export default {
    name: "ListTasks",

    components: {
        PageTemplate
    },

    beforeMount() {
        if(! localStorage.getItem('jwt_token')) {
            this.$router.push({ name: 'login' });
        }

        axios.get('http://localhost/api/tasks', { headers: this.headers })
            .then(response => this.tasks = response.data)
            .catch(error => console.log(`Error: ${error}`));
    },

    data() {
        return {
            tasks: [],
            headers: {
                "Authorization": 'Bearer ' + localStorage.getItem('jwt_token'),
            },
        }
    },

    methods: {
        remove(taskId) {
            axios.delete(`http://localhost/api/tasks/${taskId}`, { headers: this.headers })
                .then((response) => {
                    if(response) {
                        this.$router.go(this.$router.currentRoute);
                    }
                })
                .catch(error => console.log(`Error: ${error}`));
        }
    }
}
</script>
