<template>
  <div class="container top">
    <p v-if="loggedIn">
      Hello {{ user.name }}
    </p>
    <p v-if="!loggedIn">
      Please sign in
    </p>
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
