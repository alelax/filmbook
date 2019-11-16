<template>
  <div class="columns">
    <div class="column is-2">
      <Menu></Menu>      
    </div>
    <div class="column is-9">
      <Header></Header>
      <div class="columns is-multiline ">
        <div class="column is-3" v-for="item in results" :key="item.id">
          <Card
            :id="item.id"
            :title="item.title"
            :poster_path="item.poster_path"
            :rating="item.vote_average"
            :overview="item.overview">
          </Card>
        </div>
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
      this.results = results,
      this.total_pages = total_pages,
      this.total_results = total_results
    },

    beforeUpdate: function () {
      const instance = this

      eventBus.$on('showToWatchItem', (data) => {
        instance.page = 0,
        instance.total_pages = 0,
        instance.total_results = 0
        instance.results = data.map( ele => {
          return {
            id: ele.id,
            title: ele.title,
            poster_path: ele.posterPath,
          }
        })
      }),

      eventBus.$on('showToWatchedItem', (data) => {
        instance.page = 0,
        instance.total_pages = 0,
        instance.total_results = 0
        instance.results = data.map( ele => {
          return {
            id: ele.id,
            title: ele.title,
            poster_path: ele.posterPath,
          }
        })
      }),

      

      eventBus.$on('dashboardRefresh', (data) => {
        instance.page = data.page,
        instance.total_pages = data.total_pages,
        instance.total_results = data.total_results
        instance.results = data.results
      })
      
    }

  }
</script>

<style>
  
</style>