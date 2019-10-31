<template>
		<div class="card">
			<div class="row">
				<widget clase="col-md-6" type="pendientes" icon="exclamation-triangle" :value="pendingCount"></widget>
				<widget clase="col-md-6" type="revisados" icon="wrench" :value="revisedCount"></widget>	

				<div class="mt-3 col-12"></div>

				<div class="col-6">					
					<div class="form-group">
						<input type="text" class="form-control" v-model="searchOrder" placeholder="Buscar orden">
					</div>
				</div>	
				<div class="col-md-6">
					<router-link class="btn btn-success float-right" tag="a" to="/servicio">
						<i class="fa fa-file-invoice "></i>
						<span>Registrar servicio</span>
					</router-link>
				</div>

				<div class="col-12">

						
					<table class="table text-center table-bordered table-hover table-sm">
						<thead class="bg-dark text-white">
							<tr>
								<th>Código</th>
								<th>Cedula</th>
								<th>Nombre</th>
								<th>Equipo</th>
								<th>Fecha - Hora</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-if="!filterOrders.length">
				        <td colspan="6" class="text-center">No se econtraron coincidencias.</td>
				      </tr>

							<tr v-for="order in filterOrders" :key="order.identificador">
								<td>LAB-{{order.codigo}}</td>
								<td>{{order.cliente.data.cedula}}</td>
								<td>{{order.cliente.data.nombres}} {{order.cliente.data.apellidos}}</td>
								<td>{{order.equipo.data.nombre}}</td>
								<td>{{order.fechaCreacion}}</td>
								<td>
									<button
										@click="setOrder(order, 'repair')"
										v-if="order.estado === 'pendiente'"
										title="Reparar"
										class="btn btn-sm">
										<i class="fa fa-wrench text-danger"></i>
									</button>
									<button
										@click="setOrder(order, 'delivery')"
										v-else
										title="Entregar"
										class="btn btn-sm">
										<i class="fa fa-check-double text-primary"></i>
									</button>
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

		

			<transition name="fade">
				<!-- Modal de reparar -->
				<div v-if="repair" class="modal vue fade show" id="reparar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				    	<form @submit.prevent="saveRepair" method="POST">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Atender orden de revisión</h5>
					        <button type="button" class="close" @click="closeModal('repair')">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
	
										<date-custom class="col-6 offset-6" :date="dateCustom"></date-custom>
	
	
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
					        <button type="button" class="btn btn-light" @click="closeModal('repair')">Cancelar</button>
					        <button type="submit" class="btn btn-success">Guardar</button>
					      </div>
				    	</form>
				    </div>
				  </div>
				</div>
			</transition>

			<transition name="fade">
				<!-- Modal de Entregar -->
				<div v-if="delivery" class="modal vue fade show" id="entregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				    	<form @submit.prevent="saveDelivery" method="POST">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Entregar dispositivo</h5>
					        <button type="button" class="close" @click="closeModal('delivery')">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
	
										<date-custom class="col-6 offset-6" :date="dateCustom"></date-custom>
	
	
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
					        <button type="button" class="btn btn-light" @click="closeModal('delivery')">Cancelar</button>
					        <button type="submit" class="btn btn-success">Guardar</button>
					      </div>
				    	</form>
				    </div>
				  </div>
				</div>
			</transition>

		</div>
	</template>

<script>
	import Modal from '../partials/Modal'
	import Widget from '../partials/Widget'
	import SetUser from '../partials/SetUser'
  import DateCustom from '../partials/DateCustom'
	export default {
		name: 'dashboard',
		  components: {
		    Widget,
		    Modal,
		    SetUser,
		    DateCustom
		  },
		  data() {
		    return {
					repair: false,
					delivery: false,
					dateCustom: '',
		      searchOrder: '',
		      sameClientCheck: false,
		      sameClient: {
		        ci: '',
		        name: ''
		      },
		      client: {
		        ci: '',
		        name: ''
		      },
		      datails: '',
		      stateDevice: '',
		      order: '',
		      idUser: '',
		      users: '',
		      states: [{
		        value: 'without repair',
		        name: 'Sin reparación'
		      }, {
		        value: 'repaired',
		        name: 'Reparado'
		      }],
		      orders: [],
		      allOrders: [],
		      ordersMeta: [],
		    }
		  },
		  mounted() {
		    this.getAllOrders()
		    this.getOrders()
				this.getUsers()
		  },
		  created() {
				eventBus.$on('date-custom', (value) => {
					this.dateCustom = value
				})
		    eventBus.$on('idUser', (value) => {
		      this.idUser = value
		    })
		  },
		  methods: {
				closeModal(type){
					if(type==='delivery') { this.delivery = false }
					else { this.repair = false }
					eventBus.$emit('modal-state', false )
				},
		    getAllOrders() {
		      this.$emit('loading-data', true)
		      axios
		        .get("api/orders")
		        .then(response => {
		          this.allOrders = (response.data.data) ? response.data.data.filter((item) => item.estado != 'entregado') : []
		        })
		        .catch(error => {
		          console.log(error)
		        })
		        .then(() => {
		          this.$emit('loading-data', false)
		        })
		    },
		    getOrders() {
		      this.$emit('loading-data', true)
		      axios
		        .get("api/orders?paginate=true")
		        .then(response => {
		          this.orders = (response.data.data) ? response.data.data.filter((item) => item.estado != 'entregado') : []
		          if (response.data.meta) this.ordersMeta = response.data.meta.pagination
		        })
		        .catch(error => {
		          console.log(error)
		        })
		        .then(() => {
		          this.$emit('loading-data', false)
		        })

		    },
		    ordersPaginate(page) {
		      axios
		        .get("/api/orders?paginate=true&page=" + page)
		        .then(response => {
		          this.orders = response.data.data.filter((item) => item.estado != 'entregado')
		          if (response.data.meta) this.ordersMeta = response.data.meta.pagination
		        })
		        .catch(error => {
		          console.log(error)
		        })
		    },
		    saveRepair() {
		      let repair = {
						fechaCreacion: this.dateCustom,
		        tecnico: this.idUser,
		        estado: this.stateDevice,
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
		        }).then(() => {
		          $('#reparar').modal('hide')
		        })

		    },
		    saveDelivery() {
		      let delivery = {
						fechaEntrega: this.dateCustom,
		        tecnicoEntrega: this.idUser,
		        cedulaEntrega: this.client.ci,
		        nombreEntrega: this.client.name
		      }
		      this.$emit('unsetUser', '')
		      axios
		        .post(`api/orders/${this.order}/deliveries`, delivery)
		        .then(response => {
		          this.getAllOrders()
		          this.getOrders()
		          this.getUsers()
		          this.client.ci = ''
		          this.client.name = ''
		          this.sameClientCheck = false
		          Swal({
		            type: 'success',
		            title: 'Excelente',
		            html: '<p>Datos guardados con exito</p><h3>Código de orden: <strong id="code">LAB-' + response.data.data.codigo + '</strong></h3><small class="text-danger font-weight-bold">Recuerde solicitar la firma de este código</small>',
		            confirmButtonText: 'Continuar',
		          })
		        })
		        .then(() => {
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
		    setClient() {
		      if (this.sameClientCheck) {
		        this.client.ci = this.sameClient.ci
		        this.client.name = this.sameClient.name
		      } else {
		        this.client.ci = ''
		        this.client.name = ''
		      }
		    },
		    setOrder(order, type) {
					console.log(order)
					this.order = order.identificador
		      this.sameClient.ci = order.cliente.data.cedula
		      this.sameClient.name = order.cliente.data.nombres + ' ' + order.cliente.data.apellidos
					if(type==='delivery') { this.delivery = true }
					else { this.repair = true }
		    },
		    getUsers() {
		      axios
		        .get("/api/users-all")
		        .then(response => {
		          this.users = response.data.data
		        })
		        .catch(error => {
		          console.log(error)
		        });
		    },
		  },
		  computed: {
		    pendingCount: function () {
		      let pendingCount
		      if (this.searchOrder != '') {
		        pendingCount = this.filterOrders.filter(order => order.estado === 'pendiente')
		      } else {
		        pendingCount = this.allOrders.filter(order => order.estado === 'pendiente')
		      }
		      return Object.keys(pendingCount).length
		    },
		    revisedCount: function () {
		      let revisedCount
		      if (this.searchOrder != '') {
		        revisedCount = this.filterOrders.filter(order => order.estado === 'revisado')
		      } else {
		        revisedCount = this.allOrders.filter(order => order.estado === 'revisado')
		      }

		      return Object.keys(revisedCount).length
		    },
		    filterOrders: function () {

		      if (this.searchOrder != '') {
		        this.allOrders = this.allOrders.filter((item) => item.estado != 'entregado')
		        return this.allOrders.filter((item) =>
		          item.cliente.data.cedula.includes(this.searchOrder) ||
		          item.cliente.data.nombres.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
		          item.cliente.data.apellidos.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
		          item.equipo.data.nombre.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
		          item.codigo.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
		          item.fechaCreacion.includes(this.searchOrder)
		        );
		      } else {
		        return this.orders.filter((item) => item.estado != 'entregado')
		      }

		    }
		  }
		}
</script>

<style>
</style>