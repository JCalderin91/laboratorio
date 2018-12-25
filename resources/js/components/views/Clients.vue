<template>
	<div class="card col-11" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4 v-if="!clientForm">Lista de las direcciones</h4>
				<h4 v-else>Registro de Cliente</h4>
			</div>
			<div class="col-12 row" v-if="!clientForm">
				<button 
					@click.prevent="clientForm = !clientForm"
					v-if="!clientForm"
					class="btn btn-primary text-white">
					<i class="fas fa-plus"></i>
				</button>
				
				<input type="text" class="form-control col-4 ml-auto" placeholder="buscar..">
				<client-list></client-list>
			</div>

			<form v-else class="col-12 row" @submit.prevent="saveClient">
				<div class="form-group col-6">
					<label for="ci">Cedula:</label>
					<input class="form-control" type="text" name="ci" v-model="client.ci" placeholder="cedula">
				</div>
				<div class="form-group col-6">
					<label for="first_name">Nombre:</label>
					<input class="form-control" type="text" name="first_name" v-model="client.first_name" placeholder="nombre">
				</div>
				<div class="form-group col-6">
					<label for="last_name">Apellido:</label>
					<input class="form-control" type="text" name="last_name" v-model="client.last_name" placeholder="apellido">
				</div>
				<div class="form-group col-6">
					<label for="phone">Teléfono:</label>
					<input class="form-control" type="text" name="phone" v-model="client.phone" placeholder="teléfono">
				</div>
				<div class="form-group col-6">
					<label for="address">Direcciòn:</label>
					<select class="form-control" type="text" name="address" v-model="client.address" placeholder="direccion">
						<option value="">Seleccione Una</option>
						<option v-for="address in addresses" :value="address.nombre" :key="address.id">{{address.nombre}}</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label for="area">Area:</label>
					<select class="form-control" type="text" name="area" v-model="client.area" placeholder="area">
						<option value="">Seleccione Una</option>
						<option v-for="area in areas" :value="area.nombre" :key="area.id">{{area.nombre}}</option>
					</select>
				</div>

				<div class="form-group col-6 mt-5">
					<input type="submit" class="btn btn-primary btn-block" value="Guardar">
				</div>

				<div class="form-group col-6 mt-5">
					<button class="btn btn-danger btn-block" @click.prevent="clientForm = !clientForm">Cancelar</button>
				</div>
			</form>

		</div>
	</div>
</template>

<script>
	import ClientList from '../partials/ClientList'
	export default {
		name: 'clients',
		data() {
			return {
				newClient: false,
				clientForm: false,
        client: {
          ci: '',
          first_name: '',
          last_name: '',
          phone: '',
          area: '',
          address: '',
        },
        areas: [],
        addresses: []
			}
		},
		mounted() {
			this.getAddresses()
			this.getAreas()
		},
		methods: {
			getAddresses() {
				axios
					.get('api/addresses', {
						headers: {'Authorization': `Bearer ${this.$session.get('token')}` }
					})
					.then(response => {this.addresses = response.data.data})
					.catch(error => {console.log(error)})
			},
			getAreas() {
				axios
					.get('api/areas', {
						headers: {'Authorization': `Bearer ${this.$session.get('token')}` }
					})
					.then(response => {this.areas = response.data.data})
					.catch(error => {console.log(error)})
			},
			saveClient() {
				let data = JSON.stringify(this.client)
				axios.post('api/clients', {
						headers: {'Accept': 'Application/json', 'Content-Type': 'Application/json'},
						data: data
					})
					.then(response => {console.log(response)})
					.catch(error => {console.log(error)})
			}
		},
		components: {
			ClientList
		}
	}
</script>

<style></style>