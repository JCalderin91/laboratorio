<template>
  <nav class="teal"> 
    <div class="nav-wrapper">
      <a href="#!" style="display: block" class="sidenav-trigger brand-logo">Laboratorio</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li @click="logout"><a href="#">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'navbar',
  methods: {
    logout() {
      this.$session.destroy();
      window.location = '/'
    }
  }
}
</script>

<style lang="css"></style>