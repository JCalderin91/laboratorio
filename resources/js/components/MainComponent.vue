<template>
  <Login v-if="!logged"/>
  <div v-else>
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
      <Sidebar/>
      <img id="loader" src="svg/loader.svg" v-if="loading">
      <div id="main" class="page-content">    
        <transition transition="expand" >
          <router-view></router-view>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>

  //import Navbar from "./partials/Navbar";
  import Sidebar from "./partials/Sidebar";
  import Dashboard from "./views/Dashboard";
  import Login from "./views/Login";

  export default {
    name: "app",
    data() {
      return {
        email: "jesuscaldeirn@gmail.com",
        password: "123",
        error: false,
        loading: false,
      };
    },
    computed: {
      logged() {
        return this.$session.exists()
      }
    },
    created() {
      if (this.logged) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.$session.get('xsrf')
        axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$session.get('token')
      }
      eventBus.$on('loading', (loading) => {
        this.loading = loading 
      })

    },
    components: {
      Login,
      Dashboard,
      Sidebar
    }
  };
</script>

