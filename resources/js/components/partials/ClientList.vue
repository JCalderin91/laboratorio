<template>

	<table class="table table-striped table-sm table-hover mt-4">
		<thead class="bg-dark text-white text-center">
			<tr>
				<th>C.I</th>
				<th>Nombre</th>
				<th>Area</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Opciones</th>
			</tr>
		</thead>

		<tbody>
			<tr v-if="!clients.length">
				<td colspan="6" class="text-center">No se econtraron coincidencias.</td>
			</tr>
			<tr v-else v-for="client in clients" :key="client.id" class="text-center">
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
					{{ client.nombre_direccion }}
				</td>
				<td>
					{{ client.telefono }}
				</td>
				<td>
					<button :id="client.cedula" @click="editClickHandler" class=" btn btn-outline-dark btn-sm" title="Modificar cliente">
						<i :id="client.cedula" class="fas fa-pen"></i>
					</button>
					<button :id="client.identificador" class=" btn btn-outline-danger btn-sm" title="Eliminar cliente"
						@click.prevent="deleteClickHandler">
						<i :id="client.identificador" class="fas fa-trash"></i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>

</template>

<script>
	export default {
		name: 'client-list',
		props: ['clients', 'editClickHandler', 'deleteClickHandler'],
	}
</script>