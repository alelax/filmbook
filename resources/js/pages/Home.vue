<template>
  <div class="container is-5">
    <div class="columns">
      <div class="column is-6 is-offset-3">
        <div class="welcome-container">
          <div class="title is-1">Filmbook</div>
          <div class="">
            
            <div v-if="!$auth.check()">
              <div class="is-12">
                Ciao, <br>
                Benvenuto su filmbook!!! <br>
                Accedi o registrati per gestire i tuoi film e serie tv
              </div>
              <div class="buttons">
                <div v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                  <router-link 
                    :to="{ name : route.path }" 
                    :key="key" 
                    class="button" 
                    :class="{'is-light':route.class.light,'is-primary':route.class.primary}">{{route.name}}
                  </router-link>
                </div>
              </div>
            </div> 

            <div v-if="$auth.check()">
              <div class="is-12">
                Ciao Alessandro, <br>
                Ben tornato su filmbook!!! <br>
                Vai alla tua dashboard per gestire i tuoi film e serie tv
              </div>
              <div class="buttons">
                <div v-for="(route, key) in routes.admin" v-bind:key="route.path">
                  <router-link 
                    :to="{ name : route.path }" 
                    :key="key" 
                    class="button is-primary">{{route.name}}
                  </router-link>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Login', path: 'login', class: {'primary':false, 'light':true}},
            { name: 'Register', path: 'register', class: {'primary':true, 'light':false} }
          ],          
          // LOGGED ADMIN
          admin: [
            { name: 'Dashboard', path: 'dashboard' }
          ]
        }
      }
    },
    mounted() {
    },
    methods: {      
        logout: function() {
          var redirect = this.$auth.redirect()
          var app = this
          this.$auth.logout({
            success: function() {
            // handle redirection
            app.success = true
            const redirectTo = 'home'
            this.$router.push({name: redirectTo})
            },
            error: function() {
              app.has_error = true
              app.error = res.response.data.error
            },
          })
        }
      
    }
  }
</script>

<style>
  .welcome-container{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, 50%);
  }
  .buttons {
    margin-top: 40px;
    margin-left: 0;
  }
  .buttons > div {
    margin-left: 0;
    margin-right: 30px;
  }

</style>