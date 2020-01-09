<template>
    <div>
      <div class="bg-dark page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fas fa-bars"></i>
        </a>
        <Sidebar/>
        <div class="loader-wrapper" v-if="false">
          <div id="loader" class="spinner-border text-info" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div id="main" class="bg-dark page-content pb-3">
          <transition name="fade" mode="out-in">
            <router-view @error="errorAlert" @prompt="promptAlert" @loading-data="setLoading"></router-view>
          </transition>
        </div>
      </div>
      <div class="about">Lineight &copy; 2018</div>
    </div>
</template>
<script>
  import Sidebar from "../partials/Sidebar";
  export default {
    components: {
      Sidebar
    },
    computed: {
      logged() {
        return this.$session.exists();
      }
    },
    created() {
      if (this.logged) {
        console.log(this.$session.getAll());
        
        axios.defaults.headers.common["X-CSRF-TOKEN"] = this.$session.get("xsrf");
        axios.defaults.headers.common["Authorization"] = "Bearer " + this.$session.get("token");
      } else {
        console.log('Session exprired')
      }
    },  methods: {
    setLoading(loading) {
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

  }
</script>

<style lang="scss" scoped>

</style>