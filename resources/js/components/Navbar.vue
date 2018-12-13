<template>
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

<style lang="css">
  nav{
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1000;
  }
  .sidenav{
    margin-top: 60px;
  }
</style>