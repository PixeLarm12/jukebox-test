<template>
    <div>
        <h1>{{ title }} Tasks</h1>
    </div>
</template>

<script>
export default {
  name: "CreateOrEditTasks",
  
  beforeMount() {
    this.title = 'Create'
    
    if(this.$route.params.id) {
      this.title = 'Edit'
    }
  },

  data() {
    return {
      title: ""
    }
  }
}
</script>
