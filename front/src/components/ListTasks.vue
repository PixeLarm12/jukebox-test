<template>
    <div>
        <h1>Listing Tasks</h1>
        <p>
            {{ tasks }}
        </p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ListTasks",

    beforeMount() {
        axios.get('http://localhost/api/tasks')
            .then(response => this.tasks = response.data)
            .catch(error => console.log(`Error: ${error}`));
    },

    data() {
        return {
            tasks: []
        }
    }
}
</script>
