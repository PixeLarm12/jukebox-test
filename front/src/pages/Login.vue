<template>
    <page-template>
        <form @submit.prevent="login()" class="w-full min-h-[100vh] flex flex-col justify-center items-center">
            <div class="w-4/12 min-h-[50vh] grid grid-cols-12 gap-8 place-content-center place-items-center bg-blue-100 rounded-lg">
                <h1 class="col-span-12 text-default-gray font-bold text-5xl pb-12">Login</h1>
                
                <div class="col-span-12 w-5/12 flex flex-col justify-start items-start text-left">
                    <label for="email" class="input-label">Email <span class="font-bold text-red-500 text-lg">*</span></label>
                    <input type="email" id="email" name="email" v-model="email" placeholder="Enter with your email" class="input-field">
                </div>

                <div class="col-span-12 w-5/12 flex flex-col justify-start items-start text-left">
                    <label for="password" class="input-label">Password <span class="font-bold text-red-500 text-lg">*</span></label>
                    <input type="password" id="password" name="password" v-model="password" placeholder="Enter with your password" class="input-field">
                </div>
                
                <div v-show="errors.length > 0" class="col-span-12 flex flex-col justify-start items-start text-left">
                    <span v-for="(error, index) in errors" :key="index" class="text-red-500 font-semibold">{{ error }}</span>
                </div>

                <button type="submit" class="col-span-12 flex justify-start items-start text-left btn-primary">Login</button>
            </div>
        </form>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from '../components/utils/PageTemplate.vue';

export default {
    name: "Login",

    components: {
        PageTemplate
    },

    data() {
        return {
            errors: [],
            email: "",
            password: "",
        }
    },

    methods: {
        login() {
            if(this.validation()) {
                axios.post("http://localhost/api/login", {
                    "email": this.email,
                    "password": this.password,
                })
                .then(response => {
                    if(response) {
                        localStorage.setItem('jwt_token', response.data.access_token);
                        
                        this.$router.push({ name: "taskList" })
                    }

                    this.error.push("An error occurred trying to LOGIN. Please reload the page and verify your credentials!");
                })
                .catch(error => console.log(error));
            }
        },

    validation() {
      let validator = 0;
      this.errors = [];

      if(this.email === "") {
        this.errors.push("The EMAIL field are required and must be a valid email.");
        validator++;
      }

      if(this.password === "" || !(this.password.length >= 3 && this.password.length <= 300)) {
        this.errors.push("The DESCRIPTION field are required and must be at least 3 characters.");
        validator++;
      }

      return validator == 0 ?? false;
    },
  }
}
</script>
