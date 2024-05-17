<template>
    <div>
        <h1>Listing Tasks</h1>

        <table v-if="tasks.length > 0">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Actions</th>
            </tr>

            <tr v-for="task in tasks" :key="task.id">
                <th>{{ task.id }}</th>
                <th>{{ task.title }}</th>
                <th>{{ task.user_id }}</th>
                <th>
                    <router-link :to="{name: 'taskEdit', params: {id: task.id} }" >Edit</router-link>
                    <button @click="remove(task.id)">Delete</button>
                </th>
            </tr>
        </table>

        <p v-else> 
            Sorry, but we don't have any tasks at database! Try to <router-link :to="{name: 'taskCreate'}">Create a new one</router-link>
        </p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ListTasks",

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
