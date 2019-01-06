<template>
	<div class="card" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4 v-if="!clientForm">Lista de los clientes</h4>
				<h4 v-else>Registro de clientes</h4>
			</div>
			<div class="col-12 row" v-if="!clientForm">
				<button 
					@click.prevent="clientForm = !clientForm"
					v-if="!clientForm"
					class="btn btn-primary text-white">
					<i class="fas fa-plus"></i>
				</button>
				
				<input type="text" class="form-control col-4 ml-auto" placeholder="Buscar...">
				<client-list></client-list>
			</div>

			<form v-else class="col-12 row" @submit.prevent="saveClient">
				<div class="form-group col-6">
					<label for="ci">Cedula:</label>
					<input class="form-control" type="text" name="ci" v-model="client.cedula" placeholder="cedula">
				</div>
				<div class="form-group col-6">
					<label for="first_name">Nombre:</label>
					<input class="form-control" type="text" name="first_name" v-model="client.nombres" placeholder="nombre">
				</div>
				<div class="form-group col-6">
					<label for="last_name">Apellido:</label>
					<input class="form-control" type="text" name="last_name" v-model="client.apellidos" placeholder="apellido">
				</div>
				<div class="form-group col-6">
					<label for="phone">Teléfono:</label>
					<input class="form-control" type="text" name="phone" v-model="client.telefono" placeholder="teléfono">
				</div>
				<div class="form-group col-6">
					<label for="address">Direcciòn:</label>
					<select class="form-control" type="text" name="address" v-model="client.direccion" placeholder="direccion" @change="getAreas">
						<option value="">Seleccione Una</option>
						<option v-for="address in addresses" :value="address.identificador" :key="address.identificador">{{address.nombre}}</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label for="area">Area:</label>
					<select class="form-control" type="text" name="area" v-model="client.identificador_area" placeholder="area">
						<option value="">Seleccione Una</option>
						<option v-for="area in areas" :value="area.identificador">{{area.nombre}}</option>
					</select>
				</div>

				<div class="form-group col-12 mt-5 d-flex justify-content-end">
					<button class="btn btn-secondary m-2" @click.prevent="clientForm = !clientForm">Cancelar</button>
					<input type="submit" class="btn btn-primary m-2" value="Guardar">
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
          cedula: '',
          nombres: '',
          apellidos: '',
          telefono: '',
          identificador_area: '',
          direccion: '',
        },
        areas: [],
        addresses: []
			}
		},
		mounted() {
			this.getAddresses()
		},
		methods: {
			getAddresses() {
				axios
					.get('api/addresses')
					.then(response => {this.addresses = response.data.data})
					.catch(error => {console.log(error)})
			},

      getAreas(){
        axios
          .get(`api/addresses/${this.client.direccion}/areas`)
          .then(response => this.areas = response.data.data)
          .catch(error => {
            console.log(error)
            this.areas = []
          });
      },

			saveClient() {
				axios.post('api/clients', this.client)
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
			},
		},
		components: {
			ClientList
		}
	}
</script>

<style></style>