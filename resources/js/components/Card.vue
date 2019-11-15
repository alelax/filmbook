<template>
  <div class="card">
    <div class="card-image">
      <figure class="image is-3by4">
        <img :src="'https://image.tmdb.org/t/p/w342/' + poster_path" alt="Placeholder image">
        <!-- <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image"> -->
      </figure>
    </div>
    <div class="card-content">
      <div class="media">
        <div class="media-content">
          <p class="title is-4">{{ title }}</p>
          <p class="subtitle is-6">Film category</p>
        </div>
      </div>

      <div class="content">
        {{short_overview}}
        <br>
        <p>{{ rating }}</p>
      </div> 
    </div>
  </div>
</template>
<script>
  export default {
    computed: {
      short_overview: function() {
        return this.overview.length > 50 ? this.overview.substring(0,50) + '...' : this.overview
      }
    },
    props: {
      title: String,
      poster_path: String,
      rating: Number,
      overview: String,
    }     
  }
</script>

<style>
  .card {
    margin-top: 20px;
  }
</style>