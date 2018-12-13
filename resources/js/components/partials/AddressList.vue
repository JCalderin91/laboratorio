<template>
	<div class="card" style="margin: 10px;">
    <div class="card-content">
      
    <div class="card-title">    
      <h4 class>Lista de las direcciones</h4>
    </div>
    <a 
      v-on:click="newAddress = !newAddress"
      v-if="!newAddress"
      class="waves-effect blue waves-light btn-small">
      <i class="fas fa-plus"></i>
    </a>
    <small style="margin-left: 10px;">Se muestra una lista de las direcciones disponibles</small>

    <div v-if="newAddress" class="new">
      <input type="text">
      <a
        v-on:click.prevent="newAddress = !newAddress" 
        href=""
        class="btn red">Cancelar</a>

      <a
        v-on:click.prevent="newAddress = !newAddress" 
        href=""
        class="btn">Guardar</a>
    </div>

    <table v-else>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Opciones</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="address in addresses">
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
	        .get("/api/areas", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
	        .then(response => (
	        		this.addresses = response.data.data
	        	))
	        .catch(error => (
	        		console.log(error)
	        	));
    	}
    }
	}
</script>