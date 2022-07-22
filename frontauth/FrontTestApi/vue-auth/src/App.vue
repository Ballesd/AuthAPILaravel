<template>
  <div id = "app">
    <Nav></Nav>
    <div>
      <router-view/>
    </div>
  </div>
</template>

<script>
  import Nav from './components/Nav.vue'

  export default {
    name: 'App',
    components: {
      Nav,    
  }
}
</script>

<style>

</style>
