<template>
  <div class="container top">
    <div v-for="(element, index) in data"
         :key="index"
         class="item">
      <b-card :sub-title="element.user.name + ' ' + element.created_at">
        <b-link :to="'/article/' + element.id">
          <h4>{{ element.name }}</h4>
        </b-link>
        <b-card-text>
          {{ element.content.length > 300 ? element.content.slice(0, 300) + ' ...' : element.content }}
        </b-card-text>

        <p>Comments: {{ element.comments.length }}</p>

        Category: <a href="#" class="card-link">#{{element.category.name}}</a>
      </b-card>

      <hr/>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        data: {}
      }
    },

    created() {
      if (!this.loggedIn) {
        this.$router.push({
          path: '/login'
        });
      }
      this.fetchArticles();
    },
    methods: {
      async fetchArticles() {
        let data = await this.$store.dispatch('article/fetchArticles');
        this.data = data;
      },
    },
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
