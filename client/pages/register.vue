<template>
  <div class="container top">
    <b-card title="Registration">
      <b-form @submit.prevent="registerUser" @reset="onReset">
        <b-form-group
          id="nameGroup"
          label="Name:"
          label-for="name"
        >
          <b-form-input
            id="name"
            type="text"
            v-model="form.name"
            required
            placeholder="Enter name"/>
        </b-form-group>

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

        <b-form-group id="passwordConfirmationGroup" label="Password confirmation:" label-for="password_confirmation">
          <b-form-input
            id="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            required
            placeholder="Enter password confirmation"/>
        </b-form-group>

        <b-button type="submit" variant="primary">Register</b-button>
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
          password_confirmation: '',
          name: '',
        },
      }
    },
    methods: {
      async registerUser() {
        try {
          await this.$axios.post('register', this.form);
          this.$auth.login({
            data: {
              email: this.form.email,
              password: this.form.password
            }
          });
          this.$router.push({
            path: '/'
          });
        } catch (e) {
          this.$toast.error('Failed Registration');
          return false;
        }

      },
      onReset(evt) {
        evt.preventDefault();
        this.form.email = '';
        this.form.password = '';
        this.form.password_confirmation = '';
        this.form.name = '';
      }
    }
  }
</script>

<style scoped>
  .top {
    margin-top: 20px;
  }
</style>
