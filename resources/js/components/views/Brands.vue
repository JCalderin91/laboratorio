<template>
	<div class="card" style="margin: 10px;">
    <div class="card-content">      
		  <div class="card-title mb-3">    
		    <h4 class>Lista de los dispositivos y las marcas</h4>
		  </div>
      <div class="card-body p-0 row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              {{devicesMeta.total}} Dispositivos registrados
              <a v-if="!newDevice" @click.prevent="newDevice = true" href="#" class="btn btn-primary float-right btn-sm">
                <i class="fas fa-plus"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <div class="p-2" v-if="newDevice" >
                  <div class="form-group">
                    <input type="text" v-model="device" class="form-control">
                  </div>
                  <a @click.prevent="newDevice = false" href="#" class="btn btn-secondary">Cancelar</a>
                  <a @click.prevent="createDevice" href="#" class="btn btn-primary">Guardar</a>
                </div>
              </transition>
              <table class="table table-sm table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class=" text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center">
                      <button class="btn btn-outline-light btn-sm" title="Eliminar Dispositivo(s)"  @click.prevent="deleteSubDevice"><i class="fas fa-trash"></i></button>
                      <button class="btn btn-outline-light btn-sm" title="Editar Dispositivo"><i class="fas fa-pen"></i></button>
                    </th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr v-for="device in devices">
                    <td>{{ device.nombre }}</td>
                    <td>
                      <!-- <a href="#" class="btn bg-dark text-white btn-sm">
                        <i class="fas fa-pen"></i>  
                      </a>
                      <a @click.prevent="deleteSubDevice(device.identificador)" href="#" class="ml-1 btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash"></i>  
                      </a> -->
                      <div class="custom-control custom-radio" style="cursor: pointer;">
                        <input class="custom-control-input" type="radio" style="display: none;"
                          @change="selectDevice" 
                          name="brand" 
                          :id="device.identificador">
                        <label class="custom-control-label" :for="device.identificador" style="vertical-align: top"></label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table> 
              <nav aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li 
                    v-for="page in devicesMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === devicesMeta.current_page)}">
                    <a @click.prevent="subDevicePaginate(page)" class="page-link" href="#">
                      {{page}}
                    </a>
                  </li>
                </ul>
              </nav> 
            </div>
          </div>
        </div> 
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              {{brandsMeta.total}} Marcas registradas
              <a v-if="!newBrand" @click.prevent="newBrand = true" href="#" class="btn btn-primary float-right btn-sm">
                <i class="fas fa-plus"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <div class="p-2" v-if="newBrand" >
                  <div class="form-group">
                    <input type="text" v-model="brand" class="form-control">
                  </div>
                  <a @click.prevent="newBrand = false" href="#" class="btn btn-secondary">Cancelar</a>
                  <a @click.prevent="createBrand" href="#" class="btn btn-primary">Guardar</a>
                </div>
              </transition>
              <table class="table table-sm table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class=" text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center">
                      <button class="btn btn-outline-light btn-sm" title="Eliminar Marca(s)"  @click.prevent="deleteBrand"><i class="fas fa-trash"></i></button>
                      <button class="btn btn-outline-light btn-sm" title="Editar Marca"><i class="fas fa-pen"></i></button>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center" v-for="brand in brands">
                    <td>{{ brand.nombre }}</td>
                    <td>
                      <!-- <a href="#" class="btn bg-dark text-white btn-sm">
                        <i class="fas fa-pen"></i>  
                      </a>
                      <a @click.prevent="deleteBrand(brand.identificador)" href="#" class="ml-1 btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash"></i>  
                      </a> -->
                      <div class="custom-control custom-radio" style="cursor: pointer;">
                        <input class="custom-control-input" type="radio" style="display: none;"
                          @change="selectBrand" 
                          name="brand" 
                          :id="brand.identificador">
                        <label class="custom-control-label" :for="brand.identificador" style="vertical-align: top"></label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>  
              <nav aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li 
                    v-for="page in brandsMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === brandsMeta.current_page)}">
                    <a @click.prevent="brandPaginate(page)" class="page-link" href="#">
                      {{page}}
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>       
      </div>
    </div>
	</div>
</template>

<script>
	export default {
		name: 'Brands-View',
    data() {
      return {
        newBrand: false,
        newDevice: false,
        brand: '',
        brands: '',
        brandsMeta: '',
        device: '',
        devices: '',
        selectedDevice: null,
        selectedBrand: null,
        devicesMeta: '',
      }
    },
    mounted() {
      this.getSubDevice()
      this.getBrands()
    },
    methods: {
      selectDevice(event) {
        this.selectedDevice = event.target.id
      },
      selectBrand(event) {
        this.selectedBrand = event.target.id
      },

      getBrands(){
        axios
          .get("/api/brands?paginate=true")
          .then(response => {
            this.brands = response.data.data
            this.brandsMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      brandPaginate(page){
        axios
          .get("/api/brands?paginate=true&page="+page)
          .then(response => {
            this.brands = response.data.data
            this.brandsMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      createBrand(){
        this.newBrand = false 
        axios
          .post("api/brands",{nombre:this.brand})
          .then(response => {
            this.getBrands()
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos guardados con exito',
              confirmButtonText: 'Continuar',
            })
          })
          .catch(error => {console.log(error)})
      },

      deleteBrand(){
        this.$emit('prompt', {
          title: '¿Está seguro?',
          message: 'El resgistro sera Eliminado!',
          confirmHandler: this.deleteBrandHandler
        })
      },

      deleteBrandHandler() {
        axios
          .delete("api/brands/"+this.selectedBrand)
          .then(response => {
            this.getBrands()
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos borrados con exito',
              confirmButtonText: 'Continuar',
            })
          })
          .catch(error => {console.log(error)})   
      },

      getSubDevice(){
        axios
          .get("/api/sub-devices?paginate=true")
          .then(response => {
            this.devices = response.data.data
            this.devicesMeta = response.data.meta.pagination
          })
          .catch(error => {
            console.log(error)
            Swal({
              type: 'error',
              title: 'Alerta',
              text: error,
              confirmButtonText: 'Continuar',
            })
          })
      },
      subDevicePaginate(page){
        axios
          .get("/api/sub-devices?paginate=true&page="+page)
          .then(response => {
            this.devices = response.data.data
            this.devicesMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },

      createDevice(){
        this.newDevice = false 
        axios
          .post("api/sub-devices",{nombre:this.device})
          .then(response => {
            this.getSubDevice()
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos guardados con exito',
              confirmButtonText: 'Continuar',
            })
          })
          .catch(error => {
            console.log(error)
            Swal({
              type: 'error',
              title: 'Alerta',
              text: error,
              confirmButtonText: 'Continuar',
            })
          })
      },


      deleteSubDevice() {
        this.$emit('prompt', {
          title: '¿Seguro?',
          message: '¡El registro sera elminado!',
          confirmHandler: this.deleteSubDeviceHandler,
        })
      },

      deleteSubDeviceHandler(){
        axios
          .delete("api/sub-devices/"+this.selectedDevice)
          .then(response => {
            this.getSubDevice()
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos borrados con exito',
              confirmButtonText: 'Continuar',
            })
          })
          .catch(error => {console.log(error)})
      },
    }
	}
</script>