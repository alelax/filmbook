<template>
  <div id="login" class="container is-widescreen">
      <div class="column is-vcentered is-6 is-offset-one-quarter">
        <div>
          <p class="title is-2">
            <router-link to="/">Filmbook</router-link>
          </p>
          <p class="subtitle is-4">Login</p>
          <div class="alert alert-danger" v-if="has_error && !success">
            <p v-if="error == 'login_error'">Validation Errors.</p>
            <p v-else>Error, unable to connect with these credentials.</p>
          </div>
          <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
              <input 
                id="email"
                type="email"  
                class="form-control input is-medium is-rounded" 
                placeholder="email" 
                v-model="email" 
                required>
            </div>
            <div class="form-group">
              <input
                id="password"
                type="password" 
                class="form-control input is-medium is-rounded" 
                placeholder="password" 
                v-model="password" 
                required>
            </div>
            <button type="submit" class="button is-medium is-fullwidth is-rounded">Signin</button>
          </form>
        </div>
      </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: ''
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // get the redirect object
        console.log('THIS', this.$auth)
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            app.success = true
            const redirectTo = 'dashboard'
            this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true
            app.error = res.response.data.error
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>

<style scoped>
  #login {
    
    position: absolute;
    left: 50%;
    top: 50%;
    width: 100%;
    transform: translate(-50%, 30%);
  
  }
  input {
    margin-bottom: 35px;
  }
</style>