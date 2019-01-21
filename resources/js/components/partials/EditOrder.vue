<template>
	<div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
		    <a class="nav-link active" id="client-tab" data-toggle="tab" href="#client" role="tab" aria-controls="client" aria-selected="true">Cliente</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="reception-tab" data-toggle="tab" href="#reception" role="tab" aria-controls="reception" aria-selected="false">Recepción</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="repair-tab" data-toggle="tab" href="#repair" role="tab" aria-controls="repair" aria-selected="false">Revición</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">Entrega</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="client" role="tabpanel" aria-labelledby="client-tab">
				<div class="row p-3">
		
					<div class="col-6"><!-- Cedula Nuevo Cliente -->
						<label>Cédula</label>
						<div class="input-group">
							<input
								v-model="cliente.cedula"
								type="text"
								class="form-control"
								placeholder="Cedula del cliente"
								aria-label="Cedula del cliente"
								disabled
								required>
						</div> 
					</div><!-- Cedula Nuevo Cliente -->

					<div class="col-6"><!-- Nombres -->
						<div class="form-group">
							<label>Nombres</label>
							<input v-model="cliente.nombres" type="text" class="form-control" required>
						</div>
					</div><!-- Nombres -->

					<div class="col-6"><!-- Apellidos -->
						<div class="form-group">
							<label>Apellidos</label>
							<input v-model="cliente.apellidos" type="text" class="form-control" required>
						</div>
					</div><!-- Apellidos -->

					<div class="col-6"><!-- Teléfono -->
						<div class="form-group">
							<label>Teléfono</label>
							<input v-model="cliente.telefono" type="text" class="form-control" required> 
						</div>
					</div><!-- Teléfono -->
	
					<div class="col-6"><!-- Direcciones -->
						<div class="form-group">
							<label>Dirección</label>
							<select class="custom-select"  required>
								<option value="">Selecione una dirección</option>
								<option v-for="address in addresses" :selected="address.nombre === cliente.nombre_direccion" :value="address.identificador">{{address.nombre}}</option>	
							</select>
						</div>
					</div><!-- Direcciones -->

				
					<div  class="col-6"><!-- Area -->
						<div class="form-group" >
							<label>Área</label>
							<select class="custom-select" required>
								<option value="">Selecione una area</option>
								<option v-for="area in areas" :selected="area.nombre === cliente.nombre_area" :value="area.identificador">{{area.nombre}}</option>
							</select>
						</div>
					</div><!-- Area -->

				</div>	
		  	<a @click.prevent="finishEditing" href="#" class="btn btn-success m-3 float-right">Guardar</a>
		  </div>
		  <div class="tab-pane fade" id="reception" role="tabpanel" aria-labelledby="reception-tab">
				<div class="row p-3">

					<div class="col-6">
						<div class="form-group">
							<label>Equipo</label>
							<input v-model="equipo.nombre" type="text" class="form-control" required>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label>Marca</label>
							<input v-model="equipo.marca" type="text" class="form-control" required>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label>Modelo</label>
							<input v-model="equipo.modelo" type="text" class="form-control" required>
						</div>
					</div>

					<div v-if="equipo.bienNacional" class="col-6">
						<div class="form-group">
							<label>Bien nacional</label>
							<input v-model="equipo.bienNacional" type="text" class="form-control" required>
						</div>
					</div>

				</div>
			</div>
		  <div class="tab-pane fade" id="repair" role="tabpanel" aria-labelledby="repair-tab">
				Datos de la revisión
			</div>
		  <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
				Datos de la reparación
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'edit-order',
		props: ['id'],
		data(){
			return {
				cliente: '',
				equipo: '',
				areas: '',
				addresses: '',
			}
		},

		mounted(){
			this.getOrder()
			this.getAddresses()
			this.getAreas()
		},

		methods:{
			finishEditing(){
				eventBus.$emit('editingOrder', false)
			},
			getOrder(){
				axios
          .get("api/orders/"+this.id)
          .then(response => {
						this.cliente =  response.data.data.cliente.data
						this.equipo =  response.data.data.equipo.data
					})
          .catch(error => {console.log(error)});
			},
			getAreas(){
        axios
          .get("api/areas")
          .then(response => {this.areas = response.data.data})
          .catch(error => {
            console.log(error)
            this.areas = []
          })
			},
			getAddresses(){
        axios
          .get("/api/addresses")
          .then(response => {this.addresses = response.data.data})
          .catch(error => {console.log(error)})
      },
		},
	}
</script>

<style>
	#myTabContent{
		border: 1px solid #dee2e6 !important;
		border-top: none !important
	}
	.nav-link.active{
		background-color: var(--dark) !important;
		color: white !important
	}
	</style>
