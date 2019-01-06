<template>
	<table class="table table-striped table-hover mt-2">
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
</template>

<script>
	export default {
		name: 'address-list',
		data () {
      return {
        addresses: '',
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
	        .then(response => {this.addresses = response.data.data})
	        .catch(error => {console.log(error)})
    	}
    }
	}
</script>