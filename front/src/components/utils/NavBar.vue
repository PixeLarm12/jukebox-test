<template>
    <nav class="h-14 w-screen bg-blue-400 flex flex-row justify-around items-center">
        <router-link class="nav-item" :to="{ name: 'home' }">Home</router-link>
        
        <router-link v-if="isUserAuth" class="nav-item" :to="{ name: 'taskCreate' }">Create</router-link>
        
        <router-link v-if="isUserAuth" class="nav-item" :to="{ name: 'taskList' }">List</router-link>
        
        <button v-if="isUserAuth" class="nav-item" @click="logout()">Logout</button>

        <router-link v-else class="nav-item" :to="{ name: 'login' }">Login</router-link>
    </nav>
</template>

<script>
import axios from 'axios';

export default {
    name: "NavBar",

    beforeMount() {
        if(localStorage.getItem('jwt_token')) {
            this.isUserAuth = true;
        }
    },

    data() {
        return {
            isUserAuth: false,
        }
    },

    methods: {
        async logout() {
            await axios.get("http://localhost/api/logout", { headers: {"Authorization": 'Bearer ' + localStorage.getItem('jwt_token')} })
                .then(response => {
                    if(response) {
                        localStorage.removeItem("jwt_token")

                        this.$router.push({ name: "login" })
                    }
                })
                .catch(error => console.log(error));
        }
    }
}
</script>