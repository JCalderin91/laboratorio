<template>
	<div class="card col-11" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4 v-if="!userForm">Lista de los 
					<span v-if="isAdmin">usuarios</span>
					<span v-else >técnicos</span>
				</h4>
				<h4 v-else>Registro de usuarios</h4>
			</div>
			<div class="col-12 row" v-if="!userForm">
				<button 
					@click.prevent="userForm = !userForm"
					v-if="!userForm && isAdmin"
					class="btn btn-primary text-white">
					<i class="fas fa-plus"></i>
				</button>
				
				<input type="text" class="form-control col-4 ml-auto" placeholder="Buscar...">
				<user-list></user-list>
			</div>

			<form v-else class="col-12 row" @submit.prevent="saveUser">
				<div class="form-group col-6">
					<label for="ci">Cedula:</label>
					<input class="form-control" type="text" name="ci" v-model="user.ci" placeholder="Cedula">
				</div>
				<div class="form-group col-6">
					<label for="first_name">Nombres:</label>
					<input class="form-control" type="text" name="first_name" v-model="user.first_name" placeholder="Nombres">
				</div>
				<div class="form-group col-6">
					<label for="last_name">Apellidos:</label>
					<input class="form-control" type="text" name="last_name" v-model="user.last_name" placeholder="Apellidos">
				</div>

				<div class="form-group col-6">
					<label for="role">Rol:</label>
					<select class="form-control" type="text" name="role" v-model="user.role" placeholder="direccion">
						<option value="">Seleccione un rol</option>
						<option value="teacher">Profesor</option>
						<option value="tecnic">Técnico</option>
					</select>
				</div>

				<div class="form-group col-6">
					<label for="gender">generos:</label>
					<select class="form-control" type="text" name="gender" v-model="user.gender" placeholder="direccion">
						<option value="">Seleccione un genero</option>
						<option value="F">Femenino</option>
						<option value="M">Masculino</option>
					</select>
				</div>

				<div class="col-12 float-right d-flex justify-content-end">
					<button type="button" class="btn btn-secondary" @click.prevent="userForm = !userForm">Cancelar</button>
					<button id="close-modal2" type="submit" class="btn btn-primary ml-3">Guardar</button>
				</div>

			</form>
		</div>
	</div>
</template>

<script>
	import UserList from '../partials/UserList'
	export default {
		name: 'users',
		data() {
			return {
				isAdmin: this.$session.get('isAdmin'),
				newUser: false,
				userForm: false,
        user: {
          ci: '',
          first_name: '',
          last_name: '',
          role: '',
          gender: ''
        }
			}
		},
		methods: {
			saveUser() {
				if(this.user.role == 'teacher')
					this.user.role = true
				else
					this.user.role = false
				
				axios.post('api/users', {
						headers: {
							'Authorization': `Bearer ${this.$session.get('token')}`
						},
						cedula: this.user.ci,
						nombre: this.user.first_name,
						apellido: this.user.last_name,
						contraseña: '123',
						esAdministrador: this.user.role,
						sexo: this.user.gender,
					})
					.then(response => {
						Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos guardados con exito',
              confirmButtonText: 'Continuar',
            }).then(() => {
              this.$router.push('/');
            })
					})
					.catch(error => {
						Swal({
              type: 'error',
              title: 'Alerta',
              text: error,
              confirmButtonText: 'Continuar',
            })
					})
			}
		},
		components: {
			UserList
		}
	}
</script>

<style></style>