<template>
  <nav class="level">
    <!-- Left side -->
    <div class="level-left">        
      <div class="level-item">
        <div class="field has-addons">
          <p class="control">
            <input class="input" type="text" placeholder="Cerca film o serie tv">
          </p>
          <p class="control">
            <button class="button">
              Search
            </button>
          </p>
        </div>
      </div>
      <div class="level-item">
        <div class="field has-addons">
          <p class="control">
            <button class="button" @click="newPage(page,'-')">
              previousPage
            </button>
          </p>
          <p class="control">
            <button class="button" @click="newPage(page,'+')">
              nextPage
            </button>
          </p>
        </div>
      </div>
    </div>

    <!-- Right side -->
    <div class="level-right">
      <p class="level-item"><strong>All</strong></p>
      <p class="level-item"><a>Film</a></p>
      <p class="level-item"><a>Serie Tv</a></p>
      <p class="level-item"><a>Categories</a></p>
    </div>
  </nav>
</template>

<script>

  import { eventBus } from '../app' 
  import { APIService } from '../apiService' 
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
            { name: 'home', path: 'home' },
            { name: 'Dashboard', path: 'dashboard' }
          ]
        }
      }
    },
    props: {
      page: Number
    },
    mounted() {
    },
    methods: {  
      newPage: async function(page, sign) {
        sign === '+' ? this.page++ : this.page--
        if (this.page <= 0) this.page = 1
        console.log('page number', this.page)
        const apiService = new APIService()
        const newPageObj = await apiService.getPopulars(this.page)
        eventBus.$emit('newPage', newPageObj)        
      },    
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
<style lang="scss" scoped>
  .level {
    margin-top: 20px;
    z-index: 50;   
  }
</style>


