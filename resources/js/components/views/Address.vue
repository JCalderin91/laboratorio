<template>
	<div class="card">
   

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h6 class="m-2 text-white">Lista de las direcciones</h6>
            <a 
              @click="toggleForm"
              v-if="!newAddress"
              class="btn btn-primary btn-sm text-white float-right">
              <i class="fas fa-plus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <new-address v-if="newAddress" :newAddress="toggleForm"></new-address>
            
            <table v-else class="table table-striped table-hover mt-2 text-center">
              <thead>
                <tr>
                  <th></th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="address in addresses" :key="address.identificador">
                  <td>
                      <input @click="getAreas(address.identificador)" type="radio" name="customRadio">
                  </td>
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
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h6 class="m-2 text-white">Lista de las areas</h6>
            <a 
              @click="newAddress = !newAddress"
              class="btn btn-primary btn-sm text-white float-right">
              <i class="fas fa-plus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <new-address v-if="newAddress" :newAddress="toggleForm"></new-address>
            
            <table v-else class="table table-striped table-hover mt-2 text-center">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="area in areas" :key="area.id">
                  <td>
                    {{ area.nombre }}
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
      </div>
    </div>

	</div>
</template>

<script>
  import NewAddress from '../partials/NewAddress'
	export default {
		name: 'Address-View',
    data() {
      return {
        addresses: '',
        areas: '',
        newArea: false,
        newAddress: false
      }
    },
    mounted(){
      this.getAdresess()
      this.getAreas()
    },
    methods: {
      toggleForm() {
        this.newAddress = !this.newAddress
        this.areas = ''
      },
      getAdresess(){
        axios
          .get("/api/addresses")
          .then(response => {this.addresses = response.data.data})
          .catch(error => {console.log(error)});
      },
      getAreas(area){
        axios
          .get("api/addresses/"+area+"/areas")
          .then(response => {this.areas = response.data.data})
          .catch(error => {console.log(error)});
      }
    },
    components: {
      NewAddress
    }
	}
</script>