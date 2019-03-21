<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="/">
        <nuxt-link to="/" class="nav-link">
          Blog
        </nuxt-link>
      </b-navbar-brand>

      <b-navbar-toggle target="nav_collapse"/>

      <b-collapse is-nav id="nav_collapse">
        <b-navbar-nav v-if="loggedIn">
          <b-nav-item href="#">
            <nuxt-link :to="{ name: 'article' }" class="nav-link">
              Article
            </nuxt-link>
          </b-nav-item>
          <b-nav-item href="#" v-if="user.role === 'administrator'">
            <nuxt-link :to="{ name: 'user' }" class="nav-link">
              Users
            </nuxt-link>
          </b-nav-item>
          <b-nav-item href="#" v-if="user.role === 'administrator'">
            <nuxt-link :to="{ name: 'category' }" class="nav-link">
              Categories
            </nuxt-link>
          </b-nav-item>
          <b-nav-item href="#" v-if="user.role === 'administrator'">
            <nuxt-link :to="{ name: 'comment' }" class="nav-link">
              Comments
            </nuxt-link>
          </b-nav-item>
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto">
          <b-nav-item href="#" v-if="!loggedIn">
            <nuxt-link :to="{ name: 'login' }" class="nav-link">
              Login
            </nuxt-link>
          </b-nav-item>

          <b-nav-item href="#" v-if="!loggedIn">
            <nuxt-link :to="{ name: 'register' }" class="nav-link">
              Register
            </nuxt-link>
          </b-nav-item>
          <b-nav-item-dropdown right v-if="loggedIn">

            <template slot="button-content"><em>User</em></template>
            <b-dropdown-item @click.prevent="logout">Signout</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
  export default {
    name: "Navbar",
    methods: {
      logout() {
        this.$auth.logout();
      }
    }
  }
</script>

<style scoped>

</style>
