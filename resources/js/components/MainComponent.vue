<template>
  <Login v-if="checkSession()"/>
  <Dashboard v-else /> <!-- poner nombre mas apropiado a este componente-->
</template>

<script>
  import Dashboard from './dashboard';
  import Login from './Login';

  export default {
    name: 'app',
    data () {
      return {
        email: 'jesuscaldeirn@gmail.com',
        password: '123',
        error: false
      }
    },
    mounted () {
      if (localStorage.getItem('token')) {
        //this.$router.replace(this.$route.query.redirect || '/authors')
        console.log('Ya esta logueado')
      }
    },
    methods: {
      checkSession() {
        return true
      }
    },
    components: {
      Login,
      Dashboard
    }
  }
</script>
