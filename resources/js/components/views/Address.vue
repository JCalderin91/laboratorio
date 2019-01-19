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
              class="btn btn-primary btn-sm text-white float-right">
              <i v-if="!newAddress" id="address-toggle" class="fas fa-plus"></i>
              <i v-else id="address-toggle" class="fas fa-minus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <form v-if="newAddress" class="row m-2" @submit.prevent="addressSubmit">
              
              <div class="input-group col-12">
                <input v-model="address_name" type="text" class="form-control" placeholder="Nombre de la Direccion">
                <input type="submit" class="input-group-append btn btn-primary" value="Guardar"> 
              </div>
              
            </form>
            
            <table class="table table-striped table-hover text-center" style="margin-bottom: 0px;">
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
                      @click="setAddressName"
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
                    <a 
                      class="btn btn-sm bg-dark text-white" 
                      @click.prevent="editAddress">
                      <i :id="address.identificador" class="fas fa-pen"></i>
                    </a>
                    <a @click.prevent="deleteAddress(address.identificador)" href="#" class="ml-1 btn btn-outline-danger btn-sm">
                      <i class="fas fa-trash"></i>  
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
              v-if="selectedAddress"
              class="btn btn-primary btn-sm text-white float-right">
              <i v-if="!newArea" id="area-toggle" class="fas fa-plus"></i>
              <i v-else id="area-toggle" class="fas fa-minus"></i>
            </a>            
          </div>
          <div class="card-body p-0">
            <form v-if="newArea" class="row m-2" @submit.prevent="areaSubmit">
              
              <div class="input-group col-12">
                <input v-model="area_name" type="text" class="form-control" placeholder="Nombre del area">
                <input type="submit" class="input-group-append btn btn-primary" value="Guardar"> 
              </div>
              
            </form>
            
            <table class="table table-striped table-hover text-center" style="margin-bottom: 0px;">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                <tr v-if="!areas">
                  <td colspan="2"><strong>No hay nada para mostrar.</strong></td>
                </tr>
                <tr v-else v-for="area in areas" :key="area.id">
                  <td>
                    {{ area.nombre }}
                  </td>
                  <td>
                    <a @click.prevent="editArea" class="btn btn-sm btn-dark text-white" style="cursor: pointer;">
                      <i :id="area.identificador" class="fas fa-pen"></i>
                    </a>
                    <a @click.prevent="deleteArea(area.identificador)" href="#" class="ml-1 btn btn-outline-danger btn-sm">
                      <i class="fas fa-trash"></i>  
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
  import NewAreaAddress from '../partials/NewAreaAddress'
	export default {
		name: 'Address-View',
    data() {
      return {
        area_name: '',
        selectedAddress: '',
        selectedArea: '',
        address_name: '',
        addresses: [],
        areas: false,
        newArea: false,
        newAddress: false,
        addressUpdate: false,
        areaUpdate: false,
      }
    },
    mounted(){
      this.getAddresses()
    },
    methods: {
      setAddressName() {
        this.addresses.forEach(address => {
          if (address.identificador == this.selectedAddress) this.address_name = address.nombre
        })
      },

      editAddress(event) {
        for (let i = 0; i < this.addresses.length; i ++) {
          if (this.addresses[i].identificador == event.target.id) {
            this.address_name = this.addresses[i].nombre
            this.newAddress = true
            this.addressUpdate = true
            this.selectedAddress = this.addresses[i].identificador
            break;
          }
        }
      },

      editArea(event) {
        for (let i = 0; i < this.areas.length; i ++) {
          if (this.areas[i].identificador == event.target.id) {
            this.area_name = this.areas[i].nombre
            this.newArea = true
            this.areaUpdate = true
            this.selectedArea = this.areas[i].identificador
            break;
          }
        }
      },

      toggleForm(event) {
        let target = event.target.id
        switch (target) {
          case 'address-toggle': 
            this.newAddress = !this.newAddress
            this.addressUpdate = false
            this.address_name = ''
            break;
          case 'area-toggle': 
            this.newArea = !this.newArea
            this.addressUpdate = false
            this.address_name = ''
            break;
          
        }
      },
      
      getAddresses(){
        axios
          .get('/api/addresses')
          .then(response => {this.addresses = response.data.data})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      getAreas(){
        axios
          .get(`api/addresses/${this.selectedAddress}/areas`)
          .then(response => {this.areas = response.data.data})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      saveAddress() {
        axios
          .post('api/addresses/', {nombre: this.address_name})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      updateAddress() {
        axios
          .put('api/addresses/'+this.selectedAddress, {nombre: this.address_name})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      deleteAddress(id) {
        Swal({
          title: 'Esta seguro?',
          text: "Estas a punto de borrar el registro!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Continuar'
        }).then(result => {
          if (result.value) {
            axios
              .delete('api/addresses/'+id)
              .then(response => {this.getAddresses()})
              .catch(error => {
                this.$emit('error', error)
              })
          }
        })
      },

      addressSubmit() {
        if (this.addressUpdate) {
          this.updateAddress()
        } else {
          this.saveAddress()
        }

        this.newAddress = false
        this.selectedAddress = ''
        this.address_name = ''
        this.getAddresses()
      },

      saveArea() {
        axios
          .post(`api/addresses/${this.selectedAddress}/areas`, {nombre: this.area_name})
          .then(response => {this.areas = response.data.data})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      updateArea() {
        axios
          .put(`api/areas/${this.selectedArea}`, {nombre: this.area_name})
          .then(response => {console.log(response.data.data)})
          .catch(error => {
            this.$emit('error', error)
          })
      },

      deleteArea(id) {
        axios
          .delete(`/api/areas/${id}`)
          .then(response => {
            this.getAreas()
          })
          .catch(error => {
            this.$emit('error', error)
          })
      },

      areaSubmit() {
        if (this.areaUpdate) {
          this.updateArea()
        } else {
          this.saveArea()
        }

        this.newArea = false
        this.area_name = ''
        this.selectedArea = ''
        this.getAreas()
      }
    },
    components: {
      NewAreaAddress
    }
	}
</script>