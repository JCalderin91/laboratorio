<template>

	<table class="table table-striped table-hover mt-4">
		<thead class="bg-dark text-white text-center">
			<tr>
				<th>Nombre</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Bien Nacional</th>
				<th>Opciones</th>
			</tr>
		</thead>

		<tbody>
			<tr v-for="device in devices" :key="device.identificador" class="text-center">
				<td>
					{{ device.nombre }}
				</td>
				<td>
					{{ device.marca }}
				</td>
				<td>
					{{ device.modelo }}
				</td>
				<td v-if="bienNacional">
					{{ device.bienNacional }}
				</td>
				<td v-else>
					No
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
		name: 'device-list',
		data () {
			return {
				devices: [],
			}
		},
		mounted(){
			this.list()
		},
		methods:{
			list(){
				axios
					.get("/api/devices")
					.then(response => {this.devices = response.data.data})
					.catch(error => {console.log(error)});
			}
		}
	}
</script>