<template>
  <div class="container top">
    <b-card title="Login">
      <b-form @submit.prevent="login" @reset="onReset">
        <b-form-group
          id="emailGroup"
          label="Email address:"
          label-for="email"
        >
          <b-form-input
            id="email"
            type="email"
            v-model="form.email"
            required
            placeholder="Enter email"/>
        </b-form-group>

        <b-form-group id="passwordGroup" label="Password:" label-for="password">
          <b-form-input
            id="password"
            type="password"
            v-model="form.password"
            required
            placeholder="Enter password"/>
        </b-form-group>

        <b-form-checkbox class="mb-2 mr-sm-2 mb-sm-0">Remember me</b-form-checkbox>

        <b-button type="submit" variant="primary">Login</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
    </b-card>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          email: '',
          password: '',
        },
        remember: false
      }
    },
    methods: {
      async login() {
        try {

          await this.$auth.login({
            data: this.form
          });
          this.$toast.success('Logging In');
          this.$router.push({
            path: '/'
          });
        } catch (e) {
          this.$toast.error('Failed Logging In');
          return false;
        }

      },
      onReset(evt) {
        evt.preventDefault()
        this.form.email = '';
        this.form.password = '';
        this.remember = false;
      }
    }
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
