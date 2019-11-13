<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      
      <router-link :to="{name: 'home'}" class="navbar-item"> <strong>Filmbook</strong> </router-link>
      

      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <!-- <a class="navbar-item">
          Home
        </a>

        <a class="navbar-item">
          Documentation
        </a> -->
      </div>

      <div class="navbar-end">
        <div class="navbar-item" v-if="!$auth.check()">
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

        <div class="navbar-item" v-if="$auth.check()">
          <div class="buttons">
            <div v-for="(route, key) in routes.admin" v-bind:key="route.path">
              <router-link 
                :to="{ name : route.path }" 
                :key="key" 
                class="button is-primary">{{route.name}}
              </router-link>
            </div>
            <div>
              <button 
                
                class="button is-danger"
                @click.prevent="logout()">Logout
              </button>
            </div>
          </div>
        </div> 
          
      </div>
    </div>
  </nav>
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
            { name: 'home', path: '/' },
            { name: 'Dashboard', path: '/dashboard' }
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
          this.$auth.logout()
        }
      
    }
  }
</script>
<style>
.navbar {
  margin-bottom: 30px;
  
}

.buttons > * {
  margin-left: 15px;
}
</style>


