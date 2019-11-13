<template>
    <div id="main" class="container is-fluid">
        <header id="header">
          <Header></Header>
        </header>
        <div id="content">
          <router-view></router-view>
        </div>
    </div>
</template>
<script>
  import Header from './components/Header.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      Header
    }
  }
</script>