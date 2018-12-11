<template>
  <div class="login-wrapper">
    <div class="card" style="width: 25%;">
      <form class="card-content" @submit.prevent="login">
        <div class="card-title center">
          <img src="assets/favicon.png" alt="logo-proyecto" height="25px">
          <h4>Please sign in</h4>
        </div>
        <label for="email">Email:</label>
        <input
          id="email"
          name="email"
          type="text"
          placeholder="ejemplo@gmail.com"
          v-model="email"
          required
        >
        <label for="password">Contraseña:</label>
        <input
          id="password"
          name="password"
          type="text"
          placeholder="password"
          v-model="password"
          required
        >
        <div class="card-action">
          <input
            type="submit"
            class="btn btn-primary btn-block"
            style="margin: auto;"
            value="Iniciar Sesíon"
            @click="login"
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
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      axios
        .post("/auth", { user: this.email, password: this.password })
        .then(response => this.loginSuccessful(response))
        .catch(function(error) {
          this.loginFailed();
        });
    },
    loginSuccessful(req) {
      if (!req.data.token) {
        this.loginFailed();
        return;
      }
      this.error = false;
      //localStorage.token = req.data.token
      //this.$router.replace(this.$route.query.redirect || '/authors')
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