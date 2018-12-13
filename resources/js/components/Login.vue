<template>
  <div class="login-wrapper">
    <div class="card">
      <form class="card-content" @submit.prevent="login">
        <div class="card-title center">
          <img src="assets/favicon.png" alt="logo-proyecto" height="25px">
          <h4>Iniciar sesión</h4>
        </div>  
        <p class="alert alert-danger" v-if="error">{{error}}</p>
        <label for="ci">Cedula:</label>
        <input
          id="ci"
          name="ci"
          type="text"
          placeholder="00000000"
          v-model="cedula"
          required
        >
        <label for="contraseña">Contraseña:</label>
        <input 
          id="contraseña"
          name="contraseña"
          type="password"
          placeholder="*******"
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
          console.log('Error')
          console.error(error);
          this.loginFailed();
        });
    },
    loginSuccessful(data) {
      console.log(data)
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
  
  background: #22c1c3;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #fdbb2d, #22c1c3);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #fdbb2d, #22c1c3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */



}
.card{
  width: 400px;
  max-width: 99%;
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

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  padding: 10px;
  border: 1px solid #f5c6cb;
  border-radius: 8px;
  text-align: center;
}
</style>