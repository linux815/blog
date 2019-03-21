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
      this.fetchCategories();
    },
    methods: {
      async fetchCategories() {
        this.items = await this.$store.dispatch('category/fetchCategories');
      },
    },
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
