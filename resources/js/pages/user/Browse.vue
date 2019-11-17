<template>
  <div class="columns is-multiline">
    <div class="column is-3" v-for="item in results" :key="item.id">
      <Card
        :externalId="item.externalId"
        :title="item.title"
        :poster_path="item.poster_path"
        :rating="item.vote_average"
        :overview="item.overview">
      </Card>
    </div>
  </div>
</template>

<script>
  
  import { eventBus } from '../../app' 
  import { APIService } from '../../apiService'   
  
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
      Card
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

      eventBus.$on('newPage', (data) => {
        instance.page = data.page,
        instance.total_pages = data.total_pages,
        instance.total_results = data.total_results
        instance.results = data.results.map( ele => {
          return {
            ...ele,
            externalId: ele.id
          }
        })
        console.log('objiecte dashboardRefresh', instance.results)
      })

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
      }),

      

      eventBus.$on('dashboardRefresh', (data) => {
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