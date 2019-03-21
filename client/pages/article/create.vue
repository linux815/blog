<template>
  <div class="container top">

  </div>
</template>

<script>

  export default {

    created() {
      if (!this.loggedIn) {
        this.$router.push({
          path: '/login'
        });
      }
    }
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
