		
<template>
		<nav id="sidebar" class="sidebar-wrapper">
			<div class="sidebar-content">
				<div class="sidebar-brand">
					<a href="#">laboratorio</a>
					<div id="close-sidebar">
						<i class="fas fa-times"></i>
					</div>
				</div>
				<div class="sidebar-header">
					<div class="user-pic">
						<img class="img-responsive img-rounded" src="assets/avatars/001-man.png" alt="User picture">
					</div>
					<div class="user-info">
						<span class="user-name">
							{{ name }}
						</span>
						<span class="user-role">Administrator</span>
					</div>
				</div>
				<div class="sidebar-menu">
					<ul>
						<li class="header-menu">
							<span>Menu</span>
						</li>
						<li class="sidebar">
							<router-link tag="a" to="/">
								<i class="fa fa-tachometer-alt"></i>
							  <span>Principal</span>
								<span class="badge badge-pill badge-danger">New</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-file-invoice "></i>
							  <span>Registrar servicio</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-users"></i>
							  <span>Clientes</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-laptop"></i>
							  <span>Equipos</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-tachometer-alt"></i>
							  <span>Marcas</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-id-badge "></i>
							  <span>Usuarios</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-directions"></i>
							  <span>Areas & Direcciones</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-tachometer-alt"></i>
							  <span>Reportes</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-cogs"></i>
							  <span>Configuraciones</span>
							</router-link>
						</li>

					</ul>
				</div>
				<!-- sidebar-menu  -->
				<a id="logout-link" class="text-center text-white pb-2" @click.prevent="showModal = true"><i class="fa fa-sign-out-alt" ></i> Cerrar sesion</a>
			</div>
			<!-- sidebar-content  -->
			<transition name="fade">
				<Modal 
					title="Cerrar session" 
					content="¿Deseas salir del sistema?" 
					:acceptHandler="logout" 
					:closeHandler="toggleModal"
					v-if="showModal"/>
			</transition>
		</nav>
</template>

<script>
	import Modal from './Modal'
	export default {
		name: 'sidebar',
		props: ['name', 'email', 'avatarUrl'],
		data() {
			return {
				showModal: false
			}
		},
		methods: {
			logout() {
				this.$session.destroy()
				window.location = '/'
			},
			toggleModal(event) {
				event.preventDefault()
				this.showModal = false
			}
		},
		components: {
			Modal
		}
	}	
</script>

<style lang="css">
.background img{
	height: 100%;
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