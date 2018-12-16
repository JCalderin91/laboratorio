<template>
  <Login v-if="!logged"/>
  <div v-else>
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
      <Sidebar/>
      <div id="main" class="page-content">    
        <router-view></router-view>
      </div>
    </div>
  </div>

  <!-- poner nombre mas apropiado a este componente-->
</template>

<script>

  import Navbar from "./partials/Navbar";
  import Sidebar from "./partials/Sidebar";
  import Dashboard from "./views/Dashboard";
  import Login from "./views/Login";

  export default {
    name: "app",
    data() {
      return {
        email: "jesuscaldeirn@gmail.com",
        password: "123",
        error: false
      };
    },
    computed: {
      logged() {
        return this.$session.exists();
      }
    },
    mounted() {
    //this.$session.destroy() descomentar para cerrar session
    if (!this.logged) {
      //this.$router.push({name: 'login'})
    }
  },
  components: {
    Login,
    Dashboard,
    Sidebar
  }
};
</script>
