<template>
    <div>
        <h1>Welcome Home!</h1>

        <ul>
            <li>
                <router-link :to="{name: 'taskCreate'}">Create Task</router-link>
            </li>

            <li>
                <router-link :to="{name: 'taskList'}">See all Tasks</router-link>
            </li>
        </ul>
    </div> 
</template>