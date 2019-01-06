<template>

	<table class="table table-striped table-hover mt-4">
		<thead class="bg-dark text-white text-center">
			<tr>
				<th>C.I</th>
				<th>Nombre</th>
				<th>Area</th>
				<th>Teléfono</th>
				<th>Opciones</th>
			</tr>
		</thead>

		<tbody>
			<tr v-for="client in clients" :key="client.id" class="text-center">
				<td>
					{{ client.cedula }}
				</td>
				<td>
					{{ client.nombres + ' ' + client.apellidos }}
				</td>
				<td>
					{{ client.nombre_area }}
				</td>
				<td>
					{{ client.telefono }}
				</td>
				<td>
					<a class="waves-effect waves-light btn-small">
						<i class="fas fa-pen"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>

</template>

<script>
	export default {
		name: 'client-list',
		data () {
			return {
				clients: [],
			}
		},
		mounted(){
			this.list()
		},
		methods:{
			list(){
				axios
					.get("/api/clients")
					.then(response => {this.clients = response.data.data})
					.catch(error => {onsole.log(error)})
			}
		}
	}
</script>