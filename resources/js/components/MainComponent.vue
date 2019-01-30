<template>
  <Login v-if="!logged"/>
  <div v-else>
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
      <Sidebar/>
      <div class="loader-wrapper" v-if="loading">
        <div id="loader" class="spinner-border text-white" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div id="main" class="page-content">
        <transition name="fade" mode="out-in">
          <router-view @error="errorAlert" @prompt="promptAlert" @loading-data="setLoading"></router-view>
        </transition>
      </div>
    </div>
    <div class="about">Lineight &copy; 2018</div>
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
      loading: false
    };
  },
  computed: {
    logged() {
      return this.$session.exists();
    }
  },
  created() {
    if (this.logged) {
      axios.defaults.headers.common["X-CSRF-TOKEN"] = this.$session.get("xsrf");
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + this.$session.get("token");
    }
  },
  methods: {
    setLoading(loading) {
      console.log(this.loading, loading)
      this.loading = loading;
    },
    errorAlert(message) {
      Swal({
        title: "Ha ocurrido un error",
        text: message,
        type: "error",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6"
      });
    },

    promptAlert(payload) {
      Swal({
        title: payload.title,
        text: payload.message,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar"
      }).then(result => {
        if (result.value) {
          payload.confirmHandler();
        }
      });
    }
  },
  components: {
    Login,
    Dashboard,
    Sidebar
  }
};
</script>
<style lang="scss" >
.fade-enter,
.fade-leave-active {
  transition: opacity 0.1s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
.about {
  position: fixed;
  bottom: 5px;
  right: 5px;
  color: #33333360;
  font-style: italic;
  transition: all 0.3s ease;
  &:hover {
    color: #333;
  }
}
</style>

