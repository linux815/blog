<template>
  <div class="container top">
    <b-table striped hover :items="items"/>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        items: []
      }
    },

    created() {
      if (!this.loggedIn) {
        this.$router.push({
          path: '/login'
        });
      }
      this.fetchComments();
    },
    methods: {
      async fetchComments() {
        this.items = await this.$store.dispatch('comment/fetchComments');
      },
    },
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
