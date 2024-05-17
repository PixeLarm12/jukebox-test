<template>
    <div>
        <h1>{{ title }} Tasks</h1>

        <form @submit.prevent="submit()">
          <div>
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" v-model="task.title" placeholder="Enter with Task Title">
          </div>
          
          <div>
            <label for="description">Description *</label>
            <textarea id="description" name="description" v-model="task.description" placeholder="Enter with Task Description" cols="30" rows="10"></textarea>
          </div>

          <div v-show="errors.length > 0">
            <span v-for="(index, error) in errors" :key="index">{{ error }}</span>
          </div>

          <button type="submit">{{ title }} Task</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "CreateOrEditTasks",
  
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
