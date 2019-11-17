<template>
  <div class="columns is-multiline">
    <div class="column is-3" v-for="item in myWatchedListItems" :key="item.id">
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
        myWatchedListItems: [],
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
      const savedItems = await apiService.getMyWatchedList()
      this.myWatchedListItems = savedItems.data.map( ele => {
        return {
          externalId: ele.externalId,
          poster_path: ele.posterPath,
          title: ele.title,
          id: ele.id
        }
      })  
      console.log('this my list', this.myListItems);
        
      
    }

  }
</script>