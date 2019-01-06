<template>

	<table class="table table-striped table-hover mt-4">
		<thead class="bg-dark text-white text-center">
			<tr>
				<th>Cedula</th>
				<th>Nombre</th>
				<th>apellido</th>
				<th>Genero</th>
				<th v-if="isAdmin" >Rol</th>
				<th>Opciones</th>
			</tr>
		</thead>

		<tbody>
			<tr v-for="user in users" :key="user.identificador" class="text-center">
				<td>
					{{ user.cedula }}
				</td>
				<td>
					{{ user.nombre }}
				</td>
				<td>
					{{ user.apellido }}
				</td>
				<td>
					<span v-if="user.sexo === 'F'" >Femenino</span>
					<span v-else >Masculino</span>
				</td>
				<td v-if="isAdmin" >
					<span v-if="user.esAdministrador" >Profesor</span>
					<span v-else >Ténico</span>
				</td>
				<td>
					<a class="btn btn-sm">
						<i class="fas fa-pen"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>

</template>

<script>
	export default {
		name: 'user-list',
		data () {
			return {
				isAdmin: this.$session.get('isAdmin'),
				users: [],
			}
		},
		mounted(){
			this.list()
		},
		methods:{
			list(){
				axios
					.get("/api/users")
					.then(response => {this.users = response.data.data})
					.catch(error => {console.log(error)});
			}
		}
	}
</script>