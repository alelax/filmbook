<template>
  <div class="columns">
    <div class="column is-2">
      <Menu></Menu>      
    </div>
    <div class="column is-9">
      <Header :page="page"></Header>
      <div>
        <router-view></router-view>
      </div>
    </div>  
  </div>
</template>
<script>
  
  import { eventBus } from '../../app' 
  import { APIService } from '../../apiService' 
  
  import Header from '../../components/Header.vue'
  import Menu from '../../components/Menu.vue'
  import Card from '../../components/Card.vue'

  export default {
    data() {
      return {
        page: Number,
        results: [],
        total_pages: Number,
        total_results: Number,
      }
    },
    components: {
      Card,
      Header,
      Menu,
    },

    created: async function () {
      const apiService = new APIService()
      const { page, results, total_pages, total_results } = await apiService.getPopulars()
      this.page = page,
      this.results = results.map( ele => {
        return {
          ...ele,
          externalId: ele.id
        }
      }),
      this.total_pages = total_pages,
      this.total_results = total_results
      console.log('prova extID', this.results);
      
    },

    beforeUpdate: function () {
      const instance = this

      /* eventBus.$on('showToWatchItem', (data) => {
        instance.page = 0,
        instance.total_pages = 0,
        instance.total_results = 0
        instance.results = data.map( ele => {
          return {
            externalId: ele.externalId,
            title: ele.title,
            poster_path: ele.posterPath,
          }
        })
        console.log('objiecte showToWatchItem', instance.results)

      }),

      eventBus.$on('showWatchedItem', (data) => {
        instance.page = 0,
        instance.total_pages = 0,
        instance.total_results = 0
        instance.results = data.map( ele => {
          return {
            externalId: ele.externalId,
            title: ele.title,
            poster_path: ele.posterPath,
          }
        })
        console.log('objiecte showWatchedItem', instance.results)
      }), */

      /* eventBus.$on('dashboardRefresh', (data) => {
        instance.page = data.page,
        instance.total_pages = data.total_pages,
        instance.total_results = data.total_results
        console.log('objiecte PRE dashboardRefresh', instance.results)
        instance.results = data.results.map( ele => {
          return {
            ...ele,
            externalId: ele.id
          }
        })
        console.log('objiecte dashboardRefresh', instance.results)
      }) */

       
      
    }

  }
</script>

<style>
  
</style>