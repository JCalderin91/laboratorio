<template>
  <div class="login-wrapper">
    <div class="card" style="width: 25%;">
      <form class="card-content" @submit.prevent="login">
        <div class="card-title center">
          <img src="assets/favicon.png" alt="logo-proyecto" height="25px">
          <h4>Please sign in</h4>
        </div>
        <label for="ci">Email:</label>
        <input
          id="ci"
          name="ci"
          type="text"
          placeholder="ejemplo@gmail.com"
          v-model="cedula"
          required
        >
        <label for="contraseña">Contraseña:</label>
        <input
          id="contraseña"
          name="contraseña"
          type="text"
          placeholder="password"
          v-model="contraseña"
          required
        >
        <div class="card-action">
          <input
            type="submit"
            class="btn btn-primary btn-block"
            style="margin: auto;"
            value="Iniciar Sesíon"
            @click.prevent="login"
          >
        </div>
        <div class="card-action center">
          <a href="#" class="pssw-rec">Recuperar contraseña</a>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      error: false,
      cedula: "",
      contraseña: ""
    };
  },
  methods: {
    login() {
      axios
        .post("/auth/login", {
          cedula: this.cedula,
          contraseña: this.contraseña
        })
        .then(response => this.loginSuccessful(response.data))
        .catch(error => {
          console.error(error);
          this.loginFailed();
        });
    },
    loginSuccessful(data) {
      this.$session.start()
      this.$session.set('ci', this.cedula)
      this.$session.set('password', this.contraseña)
      this.$session.set('token', data.access_token)
      this.$session.set('name', data.user.original.data.nombre + ' ' + data.user.original.data.apellido)
      window.location = '/'
    },
    loginFailed() {
      this.error = "Login failed!";
      delete localStorage.token;
    }
  }
};
</script>

<style lang="css" scoped>
.login-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  width: 100vw;
  background-color: whitesmoke;
}

.card-action {
  border-top: 0px;
}

.pssw-rec {
  margin-right: 0 !important;
  color: teal !important;
}

.pssw-rec:hover {
  text-decoration: underline;
}
</style>