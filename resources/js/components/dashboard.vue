<template>
  <div>
    <Navbar />
    <Sidebar 
      :name="name"
      :email="email"/>
    <router-view></router-view>
  </div>
</template>

<script>
  import Navbar from './Navbar';
  import Sidebar from './Sidebar';

  export default {
    name: 'Dashboard',
    data () {
      return {
        name: 'Jesus Calderin',
        email: 'jesuscaldeirn@gmail.com',
        password: '123',
        error: false
      }
    },
    methods: {
      
    },
    components: {
      Navbar,
      Sidebar
    }
  }
</script>

<style lang="css">

</style>