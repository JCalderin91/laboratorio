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
									<a v-if="order.estado === 'pending'" href="#" title="Reparar" class="btn btn-primary btn-sm"><i class="fa fa-wrench"></i></a>
									<a v-else  href="#" title="Entregar" class="btn btn-success btn-sm"><i class="fa fa-check-double"></i></a>
								</td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<pre>{{$data}}</pre>
		</div>
</template>

<script>
	import Widget from '../partials/Widget'
	export default {
		name: 'dashboard',
		data(){
			return{
				orders: []
			}
		},
		components: {
			Widget,
		},
		mounted(){
			this.getOrders()
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
			}
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