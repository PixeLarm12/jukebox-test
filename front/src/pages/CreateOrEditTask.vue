<template>
    <page-template>
        <form @submit.prevent="submit()" class="w-full min-h-[100vh] flex flex-col justify-center items-center">
          <div class="w-4/12 min-h-[50vh] grid grid-cols-12 gap-8 place-content-center place-items-center bg-blue-100 rounded-lg">
            <h1 class="col-span-12 text-default-gray font-bold text-5xl pb-12">{{ title }} Tasks</h1>

            <div class="col-span-12 w-5/12 flex flex-col justify-start items-start text-left">
              <label for="title" class="input-label">Title *</label>
              <input type="text" id="title" name="title" v-model="task.title" placeholder="Enter with Task Title" class="input-field">
            </div>
            
            <div class="col-span-12 w-5/12 flex flex-col justify-start items-start text-left">
              <label for="description" class="input-label">Description *</label>
              <textarea id="description" name="description" v-model="task.description" placeholder="Enter with Task Description" class="input-field resize-none" cols="30" rows="10"></textarea>
            </div>

            <div v-show="errors.length > 0" class="col-span-12 flex flex-col justify-start items-start text-left">
                <span v-for="(error, index) in errors" :key="index" class="text-red-500 font-semibold">{{ error }}</span>
            </div>

            <button type="submit" class="col-span-12 flex justify-start items-start text-left btn-primary">{{ title }} Task</button>
          </div>
        </form>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from '../components/utils/PageTemplate.vue';

export default {
  name: "CreateOrEditTasks",
  
  components: { 
    PageTemplate 
  },
  
  beforeMount() {
    if(! localStorage.getItem('jwt_token')) {
        this.$router.push({ name: 'login' });
    }

    this.title = 'Create';

    if(this.$route.params.id) {
      this.title = 'Edit';
      
      this.getTask();
    }
  },

  data() {
    return {
      title: "",
      errors: [],
      headers: {
          "Authorization": 'Bearer ' + localStorage.getItem('jwt_token'),
          'Content-Type': "multipart/form-data;"
      },
      task: {
        user_id: 1,
        title: '',
        description: '',
      }
    }
  },

  methods: {
    getTask() {
      axios.get(`http://localhost/api/tasks/${this.$route.params.id}`, { headers: {"Authorization": 'Bearer ' + localStorage.getItem('jwt_token')} })
      .then((response) => {
          this.task.id = response.data.id;
          this.task.title = response.data.title;
          this.task.description = response.data.description;
      })
      .catch(error => console.log(error));
    },

    update() {
      axios.put(`http://localhost/api/tasks/${this.task.id}`, {
        "id": this.task.id,
        "title": this.task.title,
        "description": this.task.description,
        "user_id": this.task.user_id,
      }, { headers: this.headers })
      .then(response => {
        if(response) {
          this.$router.push({ name: "taskList" })
        }

        this.error.push("An error occurred trying to UPDATE Task. Please reload the page!");
      })
      .catch(error => console.log(error));
    },

    save() {
      axios.post("http://localhost/api/tasks/", {
        "title": this.task.title,
        "description": this.task.description,
        "user_id": this.task.user_id,
      }, { headers: this.headers })
      .then(response => {
        if(response) {
          this.$router.push({ name: "taskList" })
        }

        this.error.push("An error occurred trying to SAVE new Task. Please reload the page!");
      })
      .catch(error => console.log(error));
    },

    validation() {
      let validator = 0;
      this.errors = [];
      
      if(this.task.title === "" || !(this.task.title.length >= 3 && this.task.title.length <= 50)) {
        this.errors.push("The TITLE field are required and must be at least 3 characters and max of 50.");
        validator++;
      }

      if(this.task.description === "" || !(this.task.description.length >= 3 && this.task.description.length <= 200)) {
        this.errors.push("The DESCRIPTION field are required and must be at least 3 characters and max of 200.");
        validator++;
      }

      return validator == 0 ?? false;
    },

    submit() {
      if(this.validation()) {
        if(this.$route.params.task) {
            this.update();
        }
        this.save();
      }
    },
  }
}
</script>
