module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: 'client',
    meta: [
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1'},
      {hid: 'description', name: 'description', content: 'Nuxt.js project'}
    ],
    link: [
      {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
    ]
  },
  /*
  ** Customize the progress bar color
  */
  css: ['./node_modules/bootstrap/dist/css/bootstrap.css', './node_modules/bootstrap-vue/dist/bootstrap-vue.css'],

  loading: {color: '#3B8070'},
  axios: {
    baseURL: 'http://localhost:8089/api',
  },
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: { url: 'login', method: 'post', propertyName: 'token' },
          user: { url: 'user', method: 'get', propertyName: 'data' },
          logout: { url: 'logout', method: 'post' },
        }
      }
    }
  },
  modules: ['bootstrap-vue/nuxt', '@nuxtjs/auth', '@nuxtjs/axios', '@nuxtjs/toast'],
  plugins: [ '~plugins/mixins/user.js'],


  toast: {
    position: 'top-right',
    duration: 2000
  },

  /*
  ** Build configuration
  */
  build: {
    vendor: ['bootstrap', 'bootstrap-vue'],

    /*
    ** Run ESLint on save
    */
    extend(config, {isDev, isClient}) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  }
}

