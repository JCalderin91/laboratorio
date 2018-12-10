<template>
  <div>
  <nav class="bg-teal"> 
    <div class="nav-wrapper">
      <a href="#!" data-target="slide-out" style="display: block" class="sidenav-trigger brand-logo"><i class="fas fa-bars"></i>Laboratorio</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
  </nav>


  <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img src="assets/img/background.jpg">
      </div>
      <a href="#user"><img class="circle" src="assets/avatars/001-man.png"></a>
      <a href="#name"><span class="white-text name">{{ name }}</span></a>
      <a href="#email"><span class="white-text email">{{ email }}</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>

    
  </div>
</template>

<script>

export default {
  name: 'Dashboard',
  data () {
    return {
      name: 'Jesus Calderin',
      email: 'jesuscaldeirn@gmail.com',
      password: '123',
      error: false
    }
  },
  mounted () {
    $('.sidenav').sidenav()
  },
  methods: {
    
  }
}
</script>

<style lang="css">

</style>