<template>

	<div class="card col-6" style="margin: 10px;">
		<div class="card-content">

			<div class="card-title">    
				<h4 class>Lista de las direcciones</h4>
			</div>
			<a 
				@click="newAddress = !newAddress"
				v-if="!newAddress"
				class="btn btn-primary text-white my-2">
				<i class="fas fa-plus"></i>
			</a>
			
			<new-address v-if="newAddress" :newAddress="toggleForm"></new-address>
			<table v-else class="table table-striped table-hover mt-2">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Opciones</th>
					</tr>
				</thead>

				<tbody>
					<tr v-for="address in addresses" :key="address.id">
						<td>
							{{ address.nombre }}
						</td>
						<td>
							<a class="waves-effect waves-light btn-small">
								<i class="fas fa-pen"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</template>

<script>
	export default {
		name: 'area-list',
		data () {
      return {
        areas: '',
        newAddress: false
      }
    },
    mounted(){
    	this.list()
    },
    methods:{
    	list(){
    		axios
	        .get("/api/areas")
	        .then(response => {this.areas = response.data.data})
	        .catch(error => {console.log(error)})
    	}
    }
	}
</script>