<template>
    <div class="container">
      <Menu></Menu>
      <div class="card card-default">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
              User Dashboard 
          </div>
      </div>
    </div>
</template>
<script>
  import Menu from '../../components/Menu.vue'
  export default {
    data() {
      return {
        movies: []
      }
    },
    components: {
      Menu
    },
    beforeCreate: function () {
      /* axios
        .get('https://api.themoviedb.org/3/movie/550?api_key=eb256750e09137c9565156e96a6e8ce1')
        .then(response => console.log(response, "movies", this.movies)) */
    }

  }
</script>