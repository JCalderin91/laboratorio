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
					<button :id="client.cedula" @click="editClickHandler" class="waves-effect waves-light btn btn-dark text-white btn-small">
						<i :id="client.cedula" class="fas fa-pen"></i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>

</template>

<script>
	export default {
		name: 'client-list',
		props: ['clients', 'editClickHandler'],
	}
</script>