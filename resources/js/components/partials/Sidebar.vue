		
<template>
		<nav id="sidebar" class="sidebar-wrapper">
			<div class="sidebar-content">
				<div class="sidebar-brand">
					<a class="toggle-item" href="#">laboratorio</a>
					<div id="close-sidebar">
						<i class="fas fa-times"></i>
					</div>
				</div>
				<div class="sidebar-header">
					<div class="user-pic">
						<img class="img-responsive img-rounded" src="assets/avatars/001-man.png" alt="User picture">
					</div>
					<div class="user-info">
						<span v-if="isAdmin" class="user-name toggle-item">Profesor</span>
						<span v-else class="user-name">Técnico</span>
					</div>
				</div>
				<div class="sidebar-menu mb-4">
					<ul>
						<li class="header-menu">
							<span class="toggle-item">Menu</span>
						</li>
						<li class="sidebar">
							<router-link tag="a" :to="{name:'dashboard'}">
								<i class="fa fa-home"></i>
							  <span class="toggle-item">Principal</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/servicio">
								<i class="fa fa-file-invoice "></i>
							  <span class="toggle-item">Registrar servicio</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/clientes">
								<i class="fa fa-users"></i>
							  <span class="toggle-item">Clientes</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/ordenes">
								<i class="fa fa-laptop"></i>
							  <span class="toggle-item">Ordenes</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/usuarios">
								<i class="fa fa-id-badge "></i>
							  <span class="toggle-item" v-if="isAdmin" >Usuarios</span>
							  <span class="toggle-item" v-else >Técnicos</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/marcas">
								<i class="fa fa-blender-phone"></i>
							  <span class="toggle-item">Dispositivos & Marcas</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-directions"></i>
							  <span class="toggle-item">Direcciones & Areas</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/reportes">
								<i class="fa fa-table"></i>
							  <span class="toggle-item">Reportes</span>
							</router-link>
						</li>

						<li v-if="isAdmin" class="sidebar">
							<router-link tag="a" to="/configuraciones">
								<i class="fa fa-cogs"></i>
							  <span class="toggle-item">Configuraciones</span>
							</router-link>
						</li>

					</ul>
				</div>
				<!-- sidebar-menu  -->
				<a id="logout-link" class="text-center text-white pb-2" @click.prevent="logoutPrompt"><i class="fa fa-sign-out-alt" ></i> <span class="toggle-item">Cerrar sesion</span>		</a>
			</div>
			<!-- sidebar-content  -->
		</nav>
</template>

<script>
	export default {
		name: 'sidebar',
		data() {
			return {
				name: this.$session.get('name'),
				isAdmin: this.$session.get('isAdmin')
			}
		},
		methods: {
			logoutPrompt() {

				Swal({
				  title: 'Esta seguro?',
				  text: "Estas saliendo del sistema!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  cancelButtonText: 'Cancelar',
				  confirmButtonText: 'Salir'
				}).then(result => {
				  if (result.value) {
				    this.logout()
				  }
				})
			},
			logout() {
				this.$session.destroy()
				this.$router.push({name: 'login'})
			},
			toggleModal(event) {
				event.preventDefault()
				this.showModal = false
			}
		},
	}	
</script>

<style scoped>
.background img{
	height: 100%;
}
.sidebar-menu li a.router-link-exact-active{
	filter: brightness(2);
}
.sidebar-menu li a.router-link-exact-active span{
	font-weight: bold;
}

#logout-link {
	cursor: pointer !important;
	position: fixed;
	bottom: 0;
	width: 260px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>