<template>
  <div class="columns">
    <div class="column is-2">
      <Menu></Menu>      
    </div>
    <div class="column is-9">
      <div class="columns is-multiline ">
        <div class="column is-3" v-for="item in results">
          <Card
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
  import { APIService } from '../../apiService' 
  import Menu from '../../components/Menu.vue'
  import Card from '../../components/Card.vue'
  export default {
    data() {
      return {
        page: Number,
        results: [],
        total_pages: Number,
        total_results: Number
      }
    },
    components: {
      Menu,
      Card
    },
    created: async function () {
      const apiService = new APIService()
      const { page, results, total_pages, total_results } = await apiService.getPopulars()
      this.page = page,
      this.results = results,
      this.total_pages = total_pages,
      this.total_results = total_results
      console.log('resss', results)      
    }

  }
</script>

<style scoped>
  
</style>