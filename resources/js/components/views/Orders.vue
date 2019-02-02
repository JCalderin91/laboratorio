<template>
	<div class="card col-11" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4>Lista de las ordenes registradas
					<a v-if="editOrder" @click.prevent="editOrder = !editOrder" href="#" class="btn btn-info float-right">Finalizar edición</a>
				</h4>
			</div>

			<edit-order v-if="editOrder" :id="idOrder"></edit-order>	

			<div v-if="!editOrder"  class="col-12 row">

				<div class="form-group col-6">
					<input type="text" class="form-control" v-model="searchOrder" placeholder="Buscar orden">
				</div>
					
				<div class="col-6 text-right">
					<span v-if="searchOrder" >{{filterOrders.length}} Ordenes</span> 
          <span v-else>{{allOrders.length}} Ordenes</span> 
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
						<tr v-for="order in filterOrders">
							<td>LAB-{{order.codigo}}</td>
							<td>{{order.cliente.data.cedula}}</td>
							<td>{{order.equipo.data.nombre}}</td>
							<td>{{order.fechaCreacion}}</td>
							<td>
								<span v-if="order.estado === 'pendiente'" class="badge badge-danger">Pendiente</span>
								<span v-else-if="order.estado === 'revisado'" class="badge badge-primary">Revisado</span>
								<span v-else class="badge badge-success">Entregado</span>
							</td>
							<td>
								<a
									@click.prevent="getOrder(order.identificador)"
									href="#" title="Editar"
									class="btn text-info btn-sm">
									<small>
										<i class="fas fa-pen" style="cursor: pointer;"></i>
									</small>
								</a>

								<a
									href="#" title="Eliminar"
									class="btn text-danger btn-sm">
									<small>
										<i class="fas fa-trash" style="cursor: pointer;"></i>
									</small>
								</a>
							</td>
						</tr>
					</tbody>
				</table>	

				<nav v-if="!searchOrder" aria-label="Page navigation example" class="mx-2">
					<ul class="pagination pagination-sm">
						<li 
							v-for="page in ordersMeta.total_pages"
							v-bind:class="{'page-item pt-1':true, 'active':(page === ordersMeta.current_page)}">
							<a @click.prevent="ordersPaginate(page)" class="page-link" href="#">
								{{page}}
							</a>
						</li>
					</ul>
				</nav>
				
			</div>
		</div>
	</div>
</template>

<script>
	
	import EditOrder from '../partials/EditOrder'
	export default {
		name: 'orders',
		data() {
			return {
				editOrder: false,
				searchOrder: '',
				orders: '',
				idOrder: '',
				allOrders: '',
				ordersMeta: '',
        device: {
          ci: '',
          first_name: '',
          last_name: '',
          phone: '',
          area: '',
          address: '',
        }
			}
		},
    created() {
      eventBus.$on('editingOrder', (value) => {
        this.editOrder = value 
      })

    },
		mounted(){
			this.getAllOrders()
			this.getOrders()
		},
		methods:{
			getAllOrders(){
				eventBus.$emit('loading', true)
				axios
          .get("api/orders")
          .then(response => {
						this.allOrders = response.data.data
					})
          .catch(error => {console.log(error)})
          .then(() => {eventBus.$emit('loading', false)})

			},
			getOrders(){
				eventBus.$emit('loading', true)
				axios
          .get("api/orders?paginate=true")
          .then(response => {
						this.orders = response.data.data
						this.ordersMeta = response.data.meta.pagination
					})
          .catch(error => {console.log(error)})
          .then(() => {eventBus.$emit('loading', false)})

			},
      ordersPaginate(page){
        axios
          .get("/api/orders?paginate=true&page="+page)
          .then(response => {
            this.orders = response.data.data
            this.ordersMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      getOrder(id){
				this.idOrder = id
				this.editOrder = true
			},
		},
		computed:{
			filterOrders: function(){  
				if(this.searchOrder != ''){
          return this.allOrders.filter((item) => 
	          	item.cliente.data.cedula.includes(this.searchOrder) ||
	          	item.equipo.data.nombre.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.codigo.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.estado.toUpperCase().includes(this.searchOrder.toUpperCase()) ||
	          	item.fechaCreacion.includes(this.searchOrder) 
          	);					
				}else{
					return this.allOrders
				}
				
			}
		},
		components:{
			EditOrder
		}
	}
</script>

<style></style>