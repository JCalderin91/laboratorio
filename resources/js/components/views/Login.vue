<template>
	<div class="login-wrapper d-flex">
		<div class="img-background" style="background-image: url('assets/img/bg.jpg')">
			<div class="filtro"></div>
			<div class="info">
				<h1>
					<img src="assets/favicon.png" alt="logo-proyecto" height="50px">
					<span>Laboratorio</span>
				</h1>
				<h2>Bienvenido al sistema</h2>
			</div>
		</div>
		<div class="login">
			<form method="POST" class="card-content" @submit.prevent="login">
					<!-- <h4 class="m-0 text-primary">Iniciar sesión</h4>
					 -->
				<h3>Ingrese a su cuenta</h3>
				<div class="">
					<transition name="fade">
						<p class="alert alert-danger text-center" v-if="error">{{error}}</p>
					</transition>

					<div class="form-group">
						<input
						class="form-control-lg w-100"
						id="ci"
						name="ci"
						type="text"
						placeholder="Ingrese el usuario"
						v-model="usuario"
						@input="error = false"
						required
						:disabled="loading">
					</div>
					<div class="form-group">
						<input 
						class="form-control-lg w-100" 
						id="contraseña"
						name="contraseña"
						type="password"
						@input="error = false"
						placeholder="Ingrese su contraseña"
						v-model="contrasena"
						required
						:disabled="loading">
					</div>

					<div class="btn-box">
						<button v-if="!loading" type="submit" class="btn btn-primary btn-block">INICIAR SESIÓN</button>
						<button v-else="!loading" class="btn btn-primary btn-block" type="button" disabled>
						  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						  <span class="ml-2">CARGANDO...</span>
						</button>
					</div>
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
				usuario: "",
				contrasena: "",
				loading: false,
			};
		},
		methods: {
			login() {
				this.loading = true;
				axios
					.post("/auth/login", {usuario: this.usuario, contrasena: this.contrasena})
					.then(response => {this.loginSuccessful(response.data)})
					.catch(error => {
						console.error(error);
						this.loginFailed();
					});
			},
			loginSuccessful(data) {
				console.log(data)
				this.$session.start()
				this.$session.set('token', data.access_token)
				this.$session.set('xsrf', document.cookie.split('=')[1])
				this.$session.set('usuario', data.user.original.data.usuario)
				this.$session.set('isAdmin', data.user.original.data.esAdministrador)
				//this.$router.push({name:'dashboard'})
				window.location = '/'
			},
			
			loginFailed() {
				this.error = "Credenciales invalidas";
				this.loading = false;
			}
		}
	};
</script>

<style lang="scss" scoped>
	.img-background{
		width: calc(100vw - 400px) !important;
		height: 100vh;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;	
		z-index: -2;

		.info{
			position: absolute;
			bottom: 0;
			left: 0;
			color: white;
			z-index: 5;
			padding: 5%
		}
		
	}
	.filtro{
			content: '';
			position: absolute;
			width: 110%; height: 110%;
			top: -10px; left: -20px;
			background-color: rgba(0,0,0,0.75);
		}
	.login{
		position: absolute;
		right: 0;
		top: 0;
		height: 100vh;
		width: 400px;
		max-width: 100%;
		background-color: #fff;

		display: flex;
		align-items: center;
		justify-content: center;
	
		form{
			width: 80%;
			h3{
				margin-bottom: 20px
			}
			.btn-box{
				margin-top: 40px
			}

		}
	}
	input{
		border: none;
		border-bottom: 1px solid #33333388;
		border-radius: 0;
		&:focus{
			box-shadow: none;
		}
	}

</style>