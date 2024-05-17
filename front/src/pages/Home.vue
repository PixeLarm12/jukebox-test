<template>
    <page-template>
        <div class="w-full min-h-[80vh] flex flex-col justify-center items-center">
            <h1 class="text-default-gray uppercase text-4xl">Welcome Home!</h1>

            <p class="text-default-gray text-2xl py-6">Welcome to our system of Tasks!</p>

            <div v-if="isUserAuth" class="w-6/12 h-full flex flex-row justify-center items-center gap-x-12">
                <router-link :to="{ name: 'taskList' }" class="btn-primary">See tasks</router-link>

                <router-link :to="{ name: 'taskCreate' }" class="btn-primary">Create tasks</router-link>
            </div>

            <router-link v-else class="btn-primary" :to="{ name: 'login' }">Login</router-link>
        </div> 
    </page-template>
</template>

<script>
import PageTemplate from '../components/utils/PageTemplate.vue'

export default {
    name: "Home",

    beforeMount() {
        if(localStorage.getItem('jwt_token')) {
            this.isUserAuth = true;
        }
    },

    components: {
        PageTemplate
    },

    data() {
        return {
            isUserAuth: false,
        }
    }
}
</script>
