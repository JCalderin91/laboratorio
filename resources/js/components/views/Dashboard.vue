<template>
		<div class="card">
			<div class="row">
				<widget type="pendientes" icon="exclamation-triangle" :value="pendingCount"></widget>
				<widget type="revisados" icon="wrench" :value="revisedCount"></widget>	

				<div class="col-12 pt-3">

					<div class="form-group">
						<input type="text" class="form-control" v-model="searchOrder" placeholder="Buscar orden">
					</div>
						
					<table class="table text-center table-striped table-hover table-sm">
						<thead class="bg-dark text-white">
							<tr>
								<th>Código</th>
								<th>Cedula</th>
								<th>Equipo</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="order in filterOrders" :key="order.identificador">
								<td>LAB-{{order.codigo}}</td>
								<td>{{order.cliente.data.cedula}}</td>
								<td>{{order.equipo.data.nombre}}</td>
								<td>{{order.fechaCreacion}}</td>
								<td>
									<span v-if="order.estado === 'pendiente'" class="badge badge-danger">Pendiente</span>
									<span v-else class="badge badge-primary">Revisado</span>
								</td>
								<td>
									<a
										@click="setOrder(order)"
										data-toggle="modal" data-target="#reparar"
										v-if="order.estado === 'pendiente'"
										href="#" title="Reparar"
										class="btn btn-primary btn-sm">
										<i class="fa fa-wrench"></i>
									</a>
									<a
										@click="setOrder(order)"
										data-toggle="modal" data-target="#entregar"
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

					<nav v-if="!searchOrder" aria-label="Page navigation example" class="mx-2">
						<ul class="pagination pagination-sm">
							<li 
								v-for="page in ordersMeta.total_pages" :key="page"
								v-bind:class="{'page-item pt-1':true, 'active':(page === ordersMeta.current_page)}">
								<a @click.prevent="ordersPaginate(page)" class="page-link" href="#">
									{{page}}
								</a>
							</li>
						</ul>
					</nav>	

							
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

				      		<div class="col-md-12">
				      			<div class="form-group">
			                <label>Estado del dispositivo</label>
			                <select v-model="stateDevice" class="custom-select" required>
			                  <option value="">Selecione el resultado de la revisión</option>
			                  <option v-for="state in states" :value="state.value" :key="state.name">{{ state.name }}</option>
			                </select>
			              </div>
				      		</div>

				      		<div class="col-md-12">
				      			<div class="form-group">
			                <label for="observaciones">Observaciones de atencion de orden</label>
			                <textarea v-model="datails" class="form-control" id="observaciones" rows="3" required></textarea>
			              </div>
				      		</div>

				      		<set-user class="col-12" :users="users"></set-user>

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

			<!-- Modal de Entregar -->
			<div class="modal fade" id="entregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<form @submit.prevent="saveDelivery" method="POST">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Entregar dispositivo</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<div class="row">

				      		<div class="col-md-12">
				      			<div class="form-group">
			                <div class="custom-control custom-checkbox">
			                  <input @change="setClient" type="checkbox" class="custom-control-input" id="bn" v-model="sameClientCheck">
			                  <label class="custom-control-label" for="bn">Lo retira la misma persona que lo ingresó</label>
			                </div>
			              </div>
				      		</div>

				      		<div class="col-md-4 pr-1">
				      			<div class="form-group">
			                <label>Cedula</label>
			                <input v-model="client.ci" type="text" class="form-control" :disabled="sameClientCheck" required>
			              </div>
				      		</div>

				      		<div class="col-md-8 pl-1">
				      			<div class="form-group">
			                <label>Nombres y apellidos</label>
			                <input v-model="client.name" type="text" class="form-control" :disabled="sameClientCheck" required>
			              </div>
				      		</div>

				      		<set-user class="col-12" :users="users"></set-user>

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
	import SetUser from '../partials/SetUser'
	export default {
		name: 'dashboard',
		data(){
			return{
				searchOrder:'',
				sameClientCheck: false,
				sameClient:{
					ci:'',
					name:''
				},
				client:{
					ci:'',
					name:''
				},
				datails: '',
				stateDevice:'',
				order: '',
				idUser: '',
				users: '',
				states: [{
					value: 'without repair',
					name: 'Sin reparación'
				},{
					value: 'repaired',
					name: 'Reparado'
				}],
				orders: [],
				allOrders: [],
				ordersMeta: [],
			}
		},
		components: {
			Widget,
			Modal,
			SetUser
		},
		mounted(){
			this.getAllOrders()
			this.getOrders()
			this.getUsers()
		},
    created(){
      eventBus.$on('idUser', (value) => {
        this.idUser = value 
      })
    },
		methods: {
			getAllOrders(){
				this.$emit('loading-data', true)
				axios
          .get("api/orders")
          .then(response => {
          	this.allOrders = response.data.data.filter((item)=>item.estado != 'entregado')
					})
          .catch(error => {console.log(error)})
          .then(() => {
						this.$emit('loading-data', false)
					})
			},
			getOrders(){
				this.$emit('loading-data', true)
				axios
          .get("api/orders?paginate=true")
          .then(response => {
          	this.orders = response.data.data.filter((item)=>item.estado != 'entregado')
          	this.ordersMeta = response.data.meta.pagination
					})
          .catch(error => {console.log(error)})
          .then(() => {this.$emit('loading-data', false)})

			},
      ordersPaginate(page){
        axios
          .get("/api/orders?paginate=true&page="+page)
          .then(response => {
            this.orders = response.data.data.filter((item)=>item.estado != 'entregado')
          	this.ordersMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
			saveRepair(){
        let repair = {
          tecnico: this.idUser,
          estado: this.stateDevice ,
          detalle: this.datails
        }
				axios
          .post(`api/orders/${this.order}/repairs`, repair)
  				.then(response => {
  					this.getAllOrders()
						this.getOrders()
						this.getUsers()
            this.state = ''
            this.datails = ''
            this.order = ''
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos guardados con exito',
              confirmButtonText: 'Continuar',
            }).then(() => {
              this.$router.push('/')
              this.getAllOrders()
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
          })

			},
			saveDelivery(){
        let delivery = {
          user_delivery_id: this.idUser,
          client_ci: this.client.ci ,
          client_name: this.client.name
        }
        this.$emit('unsetUser', '')
				axios
          .post(`api/orders/${this.order}/deliveries`, delivery)
  				.then(response => {
  					this.getAllOrders()
						this.getOrders()
						this.getUsers()
            this.client.ci  = ''
            this.client.name = ''
            this.sameClientCheck= false
            Swal({
              type: 'success',
              title: 'Excelente',
              html:'<p>Datos guardados con exito</p><h3>Código de orden: <strong id="code">LAB-'+response.data.data.codigo+'</strong></h3><small class="text-danger font-weight-bold">Recuerde solicitar la firma de este código</small>',
              confirmButtonText: 'Continuar',
            })
  				})
          .then(()=>{
            $('#entregar').modal('hide')
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
			setClient(){
				if(this.sameClientCheck){
					this.client.ci =  this.sameClient.ci
					this.client.name = this.sameClient.name
				}else{
					this.client.ci = ''
					this.client.name = ''
				}
			},

			setOrder(order){
				this.order = order.identificador
				this.sameClient.ci = order.cliente.data.cedula
				this.sameClient.name = order.cliente.data.nombres+' '+order.cliente.data.apellidos
			},

      getUsers(){
        axios
          .get("/api/users")
          .then(response => {this.users = response.data.data})
          .catch(error => {console.log(error)});
      },
		},
		computed:{
			pendingCount: function() {
				let pendingCount
				if(this.searchOrder != ''){
					pendingCount = this.filterOrders.filter(order => order.estado === 'pendiente')
				}else{
					pendingCount = this.allOrders.filter(order => order.estado === 'pendiente')
				}
				return Object.keys(pendingCount).length
			},
			revisedCount: function() {
				let revisedCount
				if(this.searchOrder != ''){
					revisedCount = this.filterOrders.filter(order => order.estado === 'revisado')
				}else{
					revisedCount = this.allOrders.filter(order => order.estado === 'revisado')
				}

				return Object.keys(revisedCount).length
			},
			filterOrders: function(){
  			
				if(this.searchOrder != ''){
					this.allOrders = this.allOrders.filter((item)=>item.estado != 'entregado')
          return this.allOrders.filter((item) => 
	          	item.cliente.data.cedula.includes(this.searchOrder) ||
	          	item.equipo.data.nombre.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.codigo.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.estado.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.fechaCreacion.includes(this.searchOrder) 
          	);					
				}else{
					return this.orders.filter((item)=>item.estado != 'entregado')
				}
				
			}
		}
	}
</script>

<style>
</style>