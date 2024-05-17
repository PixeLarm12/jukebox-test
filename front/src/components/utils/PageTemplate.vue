<template>
    <div>
        <nav-bar></nav-bar>
        
        <div class="w-screen flex justify-around items-center bg-text-white-50">

            <slot class="min-h-[100vh] flex flex-col justify-center items-center"></slot>
        </div>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue"

export default {
    name: "PageTemplate",

    components: {
        NavBar
    }
}
</script>