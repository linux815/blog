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
      this.fetchUsers();
    },
    methods: {
      async fetchUsers() {
        this.items = await this.$store.dispatch('auth/fetchUsers');
      },
    },
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
