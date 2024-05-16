<template>
    <div>
        <form @submit.prevent="login()">
            <div>
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" v-model="email" placeholder="Enter with your email">
            </div>

            <div>
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" v-model="password" placeholder="Enter with your password">
            </div>
            
            <div v-show="errors.length > 0">
                <span v-for="(index, error) in errors" :key="index">{{ error }}</span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Login",

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
                        this.$router.push({ name: "taskList" })
                    }

                    this.error.push("An error occurred trying to LOGIN. Please reload the page and verify your credentials!");
                })
                .catch(error => console.log(error));
            }
        },

    validation() {
      let validator = 0;

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
