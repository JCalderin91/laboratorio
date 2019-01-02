		
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
						<span v-if="isAdmin" class="user-role">Profesor</span>
						<span v-else class="user-role">Técnico</span>
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
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/servicio">
								<i class="fa fa-file-invoice "></i>
							  <span>Registrar servicio</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/clientes">
								<i class="fa fa-users"></i>
							  <span>Clientes</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/dispositivos">
								<i class="fa fa-laptop"></i>
							  <span>Dispositivos</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/marcas">
								<i class="fa fa-tachometer-alt"></i>
							  <span>Marcas</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/usuarios">
								<i class="fa fa-id-badge "></i>
							  <span v-if="isAdmin" >Usuarios</span>
							  <span v-else >Técnicos</span>
							</router-link>
						</li>

						<li class="sidebar">
							<router-link tag="a" to="/areas">
								<i class="fa fa-directions"></i>
							  <span>Areas & Direcciones</span>
							</router-link>
						</li>

						<li v-if="isAdmin" class="sidebar">
							<router-link tag="a" to="/reportes">
								<i class="fa fa-tachometer-alt"></i>
							  <span>Reportes</span>
							</router-link>
						</li>

						<li v-if="isAdmin" class="sidebar">
							<router-link tag="a" to="/conf">
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
					:acceptHandler="logout" 
					:closeHandler="toggleModal"
					v-if="showModal">
					<p>¿Desea salír del Sistema?</p>
				</Modal>
			</transition>
		</nav>
</template>

<script>
	import Modal from './Modal'
	export default {
		name: 'sidebar',
		data() {
			return {
				showModal: false,
				name: this.$session.get('name'),
				isAdmin: this.$session.get('isAdmin')
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