<template>
  <ul id="slide-out" class="sidenav">
	  <li>
	  	<div class="user-view">
		    <div class="background">
		      <img :src="avatarUrl || 'assets/img/background.jpg'">
		    </div>
		    <a href="#user"><img class="circle" src="assets/avatars/001-man.png" style="margin: auto;"></a>
		    <a href="#name" class="center"><span class="white-text name">{{ name }}</span></a>
		    <a href="#email" class="center"><span class="white-text email">{{ email }}</span></a>
		  </div>
		</li>
	  <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
	  <li><a href="#!">Second Link</a></li>
	  <li><div class="divider"></div></li>
	  <li class="sidenav-close" ><router-link to="/areas">Direciones</router-link></li>
	  <li class="sidenav-close" ><router-link to="/">Test</router-link></li>
  </ul>
</template>

<script>
	export default {
		name: 'sidebar',
		props: ['name', 'email', 'avatarUrl'],
    mounted () {
      $('.sidenav').sidenav()
    }
	}	
</script>

<style lang="css">
	
</style>