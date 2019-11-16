<template>
  <div class="card">
    <div class="card-image">
      <figure class="image is-3by4">
        <img :src="'https://image.tmdb.org/t/p/w342/' + poster_path" alt="Placeholder image">
        <!-- <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image"> -->
      </figure>
    </div>
    <div class="card-content">
      <div class="columns">
        <div class="column is-two-fifths">
          <button class="button" @click="addToMyList(cardData)">Add</button>
        </div>
        <div class="column">
          <button class="button" @click="addToMyWatchedList(cardData)">Watched</button>
        </div>
        
      </div>
    </div>
    <!-- <div class="card-content">
      <div class="media">
        <div class="media-content">
          <p class="title is-6">{{ title }}</p>
          <p class="subtitle is-7">Film category</p>
        </div>
      </div>

      <div class="content">
        {{short_overview}}
        <br>
        <p>{{ rating }}</p>
      </div> 
    </div> -->
  </div>
</template>
<script>
  import { APIService } from '../apiService' 

  export default {
    data() {
      return {
        cardData: {}
      }
    },
    computed: {
      short_overview: function() {
        return this.overview.length > 50 ? this.overview.substring(0,50) + '...' : this.overview
      },
      short_title: function() {
        return this.title.length > 20 ? this.overview.substring(0,50) + '...' : this.overview
      }
    },
    props: {
      title: String,
      poster_path: String,
      rating: Number,
      overview: String,
      id: Number
    },
    methods: {
      ciao: function() { console.log('ciao') },
      addToMyList: async function (data) {
        const apiService = new APIService()
        const r = await apiService.addToMyList(data)
        console.log('ASDADASDASD', r)
      },
      addToMyWatchedList: async function (data) {
        const apiService = new APIService()
        const r = await apiService.addToMyWatchedList(data)
        console.log('ASDADASDASD', r)
      }
    },
    created: function () {
      this.cardData = {...this.$props}
    }     
  }
</script>

<style lang="scss" scoped>
  
  .card {
    margin-top: 20px;
   
  }

</style>