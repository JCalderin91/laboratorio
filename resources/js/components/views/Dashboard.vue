<template>
		<div class="card">
			<div class="row">
				<widget type="pendientes" icon="exclamation-triangle" :value="pendingCant"></widget>
				<widget type="revisados" icon="wrench" :value="revisedCant"></widget>	

				<div class="col-12 pt-3">
					<table class="table text-center table-striped table-hover">
						<thead class="bg-dark text-white">
							<tr>
								<th>Cedula</th>
								<th>Equipo</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="order in orders">
								<td>{{order.cliente.data.cedula}}</td>
								<td>{{order.equipo.data.nombre}}</td>
								<td>{{order.fechaCreacion}}</td>
								<td>
									<span v-if="order.estado === 'pending'" class="badge badge-danger">Pendiente</span>
									<span v-else class="badge badge-primary">Revisado</span>
								</td>
								<td>
									<a
										@click="setOrder(order)"
										data-toggle="modal" data-target="#reparar"
										v-if="order.estado === 'pending'"
										href="#" title="Reparar"
										class="btn btn-primary btn-sm">
										<i class="fa fa-wrench"></i>
									</a>
									<a
										v-else
										href="#"
										title="Entregar"
										class="btn btn-success btn-sm">
										<i class="fa fa-check-double"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>

	

			<!-- Modal de reparar -->
			<div class="modal fade" id="reparar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<form @submit.prevent="saveRepair" method="POST">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Atender orden de revisión</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<div class="row">
				      		<div class="col-md-6">
				      			<div class="form-group">
			                <label>Cedula del técnico</label>

			                <select v-model="tecnicID" class="custom-select" required>
			                  <option value="">Selecione una cedula</option>
			                  <option v-for="user in users" :value="user.identificador">{{ user.cedula }}</option>
			                </select>

			              </div>
				      		</div>
				      		<div class="col-md-6">
				      			<div class="form-group">
			                <label>Estado del dispositivo</label>

			                <select v-model="stateDevice" class="custom-select" required>
			                  <option value="">Selecione el resultado de la revisión</option>
			                  <option v-for="state in states" :value="state.value">{{ state.name }}</option>
			                </select>

			              </div>
				      		</div>
				      		<div class="col-md-12">
				      			<div class="form-group">
			                <label for="observaciones">Observaciones de atencion de orden</label>
			                <textarea v-model="datails" class="form-control" id="observaciones" rows="3" required></textarea>
			              </div>
				      		</div>
				      	</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				        <button type="submit" class="btn btn-primary">Guardar</button>
				      </div>
			    	</form>
			    </div>
			  </div>
			</div>

		</div>
</template>

<script>
	import Modal from '../partials/Modal'
	import Widget from '../partials/Widget'
	export default {
		name: 'dashboard',
		data(){
			return{
				datails: '',
				stateDevice:'',
				order: '',
				tecnicID: '',
				users: '',
				states: [{
					value: 'without repair',
					name: 'Sin reparación'
				},{
					value: 'repaired',
					name: 'Reparado'
				}],
				orders: [],
			}
		},
		components: {
			Widget,
			Modal
		},
		mounted(){
			this.getOrders()
			this.getUsers()
		},
		methods: {
			getOrders(){
				axios
        .get("api/orders", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
          	//console.log(response.data.data)
            this.orders = response.data.data
          })
          .catch(error => {
            console.log(error)
          });
			},
			saveRepair(){
				axios.post("api/orders/"+this.order+"/repairs",{
					headers: {
            'Authorization': `Bearer ${this.$session.get('token')}`
          },
          tecnico: this.tecnicID,
          estado: this.stateDevice ,
          detalle: this.datails
				})
				.then(response => {
					this.getOrders()
					this.tecnicID = ''
          this.state = ''
          this.datails = ''
          this.order = ''
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
        }).then(()=>{
        	$('#reparar').modal('hide')
        });

			},

			setOrder(order){
				this.order = order.identificador
			},

      getUsers(){
        axios
        .get("/api/users", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.users = response.data.data
          })
          .catch(error => (
            console.log(error)
          ));
      },
		},
		computed:{
			pendingCant: function(argument) {
				let pendingCant = this.orders.filter(order => order.estado === 'pending')
				return Object.keys(pendingCant).length
			},
			revisedCant: function(argument) {
				let revisedCant = this.orders.filter(order => order.estado === 'revised')
				return Object.keys(revisedCant).length
			}
		}
	}
</script>

<style>
</style>