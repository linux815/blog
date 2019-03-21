<template>
  <div class="container top">
    <template v-if="data">
      <b-card :title="data.name" :sub-title="data.user.name + ' ' + data.created_at">
        <b-card-text>
          {{ data.content }}
        </b-card-text>

      </b-card>

      <hr/>

      <p>Comments:</p>
      <div v-for="(element, index) in data.comments"
           :key="index"
           class="item">
        <b-card :title="element.name" :sub-title="data.user.name + ' ' + element.created_at">
          <b-card-text>
            {{ element.comment }}
          </b-card-text>


        </b-card>

        <br/>
      </div>
    </template>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        data: null
      }
    },

    created() {
      if (!this.loggedIn) {
        this.$router.push({
          path: '/login'
        });
      }
      this.fetchArticle();
    },
    methods: {
      async fetchArticle() {
        let response = await this.$store.dispatch('article/fetchArticle', {id: this.$router.history.current.params.id});

        if (typeof response.status !== "undefined" && response.status === 200 && response.data.id) {
          this.data = response.data;
        } else {
          this.$toast.error(response.data.message);
          this.$router.push({
            path: '/article'
          });
        }
      },
    },
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
