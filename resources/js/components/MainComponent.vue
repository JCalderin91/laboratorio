<template>
  <Login v-if="!logged"/>
  <Dashboard v-else/>
  <!-- poner nombre mas apropiado a este componente-->
</template>

<script>
import Dashboard from "./dashboard";
import Login from "./Login";

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
    Dashboard
  }
};
</script>
