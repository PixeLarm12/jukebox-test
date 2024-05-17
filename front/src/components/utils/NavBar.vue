<template>
    <nav class="h-14 w-screen bg-blue-400 flex flex-row justify-around items-center">
        <router-link class="nav-item" :to="{ name: 'home' }">Home</router-link>
        
        <router-link class="nav-item" :to="{ name: 'taskCreate' }">Create</router-link>
        
        <router-link class="nav-item" :to="{ name: 'taskList' }">List</router-link>
        
        <router-link class="nav-item" :to="{ name: 'login' }">Login / Logout</router-link>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>