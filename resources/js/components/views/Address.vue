<template>
	<div class="card">
    <h1>Areas y Direcciones</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-dark d-flex justify-content-between align-items-center">
            <h6 class="m-2 text-white">Lista de las direcciones</h6>
            <a 
              id="address-toggle" 
              @click="toggleForm"
              v-if="!newAddress"
              class="btn btn-primary btn-sm text-white float-right">
              <i id="address-toggle" class="fas fa-plus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <form v-if="newAddress" class="row m-2" @submit.prevent="saveAddress">
              
              <div class="form-group col-12">
                <input v-model="selectedAddress" type="text" class="form-control" placeholder="Nombre del la Direccion">
              </div>

              <div class="form-group col-12 d-flex justify-content-end">
                <a id="address-toggle" @click.prevent="toggleForm" href="" class="btn m-2 btn-secondary">Cancelar</a>

                <input type="submit" class="btn m-2 btn-primary" value="Guardar"> 
              </div>
              
            </form>
            
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
                    <input 
                      @change="getAreas"
                      v-model="selectedAddress"
                      type="radio" 
                      name="customRadio"
                      :value="address.identificador">
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
              id="area-toggle"
              @click.prevent="toggleForm"
              class="btn btn-primary btn-sm text-white float-right">
              <i id="area-toggle" class="fas fa-plus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <form v-if="newArea" class="row m-2" @submit.prevent="saveArea">
              
              <div class="form-group col-12">
                <input v-model="area" type="text" class="form-control" placeholder="Nombre del la Direccion">
              </div>

              <div class="form-group col-12 d-flex justify-content-end">
                <a id="area-toggle" @click.prevent="toggleForm" href="" class="btn m-2 btn-secondary">Cancelar</a>

                <input type="submit" class="btn m-2 btn-primary" value="Guardar"> 
              </div>
              
            </form>
            
            <table v-else class="table table-striped table-hover mt-2 text-center">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                <tr v-if="areas" v-for="area in areas" :key="area.id">
                  <td>
                    {{ area.nombre }}
                  </td>
                  <td>
                    <a class="waves-effect waves-light btn-small">
                      <i class="fas fa-pen"></i>
                    </a>
                  </td>
                </tr>
                <tr v-if="!selectedAddress">
                  <td colspan="2"><strong>Debe seleccionar una direccion.</strong></td>
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
  import NewAreaAddress from '../partials/NewAreaAddress'
	export default {
		name: 'Address-View',
    data() {
      return {
        area: '',
        selectedAddress: '',
        addresses: null,
        areas: null,
        newArea: false,
        newAddress: false
      }
    },
    mounted(){
      this.getAdresess()
    },
    methods: {
      toggleForm(event) {
        if (event.target.id == 'address-toggle') {
          this.newAddress = !this.newAddress
          this.areas = ''
        } else  if (event.target.id == 'area-toggle') {
          if (this.selectedAddress == '') return
          this.newArea = !this.newArea
        }
      },
      
      getAdresess(){
        axios
          .get('/api/addresses')
          .then(response => {this.addresses = response.data.data})
          .catch(error => {console.log(error)})
      },

      getAreas(){
        axios
          .get(`api/addresses/${this.selectedAddress}/areas`)
          .then(response => {this.areas = response.data.data})
          .catch(error => {console.log(error)})
      },

      saveAddress() {
        axios
          .post('api/addresses/', {nombre: this.selectedAddress})
          .then(response => {
            this.selectedAddress = ''
            this.getAdresess()
            this.newAddress = false
          })
          .catch(error => {console.log(error)})
      },

      saveArea() {
        axios
          .post('api/areas/', {identificador_direccion: this.selectedAddress, nombre: this.area})
          .then(response => {console.log('area saved \n', response)})
          .catch(error => {console.log(error)})
      }
    },
    components: {
      NewAreaAddress
    }
	}
</script>