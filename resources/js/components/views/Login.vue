<template>
	<div class="login-wrapper">
		<div class="card">
			<form class="card-content" @submit.prevent="login">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="m-0 text-primary">Iniciar sesión</h4>
					<img src="assets/favicon.png" alt="logo-proyecto" height="25px">
				</div>  
				<div class="card-body">
					<p class="alert alert-danger text-center" v-if="error">{{error}}</p>
					<div class="form-group">
						<label for="ci">Usuario:</label>
						<input
						class="form-control"
						id="ci"
						name="ci"
						type="text"
						placeholder="Ingrese el usuario"
						v-model="usuario"
						required
						:disabled="loading">
					</div>
					<div class="form-group">
						<label for="contraseña">Contraseña:</label>
						<input 
						class="form-control" 
						id="contraseña"
						name="contraseña"
						type="password"
						placeholder="Ingrese su contraseña"
						v-model="contrasena"
						required
						:disabled="loading">
					</div>

					<div class="card-action">
						<input
						type="submit"
						class="btn btn-primary btn-block"
						style="margin: auto;"
						value="Iniciar Sesíon"
						@click.prevent="login"
						:disabled="loading"
						>
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

<style lang="css" scoped>
.login-wrapper {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	width: 100vw;

	background: #232526;  /* fallback for old browsers */
	background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
	background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */




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

</style>