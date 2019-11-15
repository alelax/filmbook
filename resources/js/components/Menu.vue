<template>
  <div id="menu" class="menu-cnt">
    <aside class="menu">
      <p class="menu-label subtitle is-4">
        Filmbook
      </p>
      <ul class="menu-list">
        <router-link to="/">Home</router-link>
        <router-link to="dashboard">Dashboard</router-link>        
        <hr>
        <li><a>MyList</a></li>
        <li><a>Watched</a></li>
        <div class="buttons">
          <button class="button is-danger" @click.prevent="logout()">Logout</button>
        </div>
      </ul>      
    </aside>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
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
#menu {
  position: fixed;
  padding-top: 20px;
  background: rgb(24,24,27);
  background: linear-gradient(200deg, rgba(24,24,27,1) 0%, rgba(36,36,42,1) 75%, rgba(56,56,60,1) 100%);
  
}
.navbar {
  margin-bottom: 30px;
}
.menu-cnt {
  padding: 0 15px;
  position: relative;
  height: 100%;
}
.menu {
  width: 180px;
}

.menu, .menu-label, .menu-list, .menu-list > a {
  color: #fff;
}
</style>