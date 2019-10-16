<template>
  <div class="card">
    
    <h2>Registro de una nueva orden de servicio</h2>
    <h6>Registre los datos de un nuevo servicio de reparación o revición</h6>

    <form @submit.prevent="saveOrder" method="POST">

      <div class="card">
        <div class="card-header bg-dark">
          <h6 class="m-0 text-white">
            Datos del cliente 
          </h6>
        </div>
        <div class="card-body">
          <div class="row">
       
            <div class="col-6"><!-- Cedula Nuevo Cliente -->
              <label>Cédula</label>
              <div class="form-group">
                <input
                  @keypress.enter.prevent="searchClient"
                  @blur="searchClient"
                  @input="resetClient"
                  v-model="client.ci"
                  type="text"
                  class="form-control"
                  placeholder="Cedula del cliente"
                  aria-label="Cedula del cliente"
                  required>
                  <message-error :message="errors.cedula"></message-error> 
              </div>
            </div><!-- Cedula Nuevo Cliente -->

            <div class="col-6"><!-- Nombres -->
              <div class="form-group">
                <label>Nombres</label>
                <input :disabled="!newClient" v-model="client.first_name" type="text" class="form-control" required>
                <message-error :message="errors.nombres"></message-error> 
              </div>
            </div><!-- Nombres -->

            <div class="col-6"><!-- Apellidos -->
              <div class="form-group">
                <label>Apellidos</label>
                <input :disabled="!newClient" v-model="client.last_name" type="text" class="form-control" required>
                <message-error :message="errors.apellidos"></message-error> 
              </div>
            </div><!-- Apellidos -->

            <div class="col-6"><!-- Teléfono -->
              <div class="form-group">
                <label>Teléfono</label>
                <input :disabled="!newClient" v-model="client.phone" type="text" class="form-control" required>
                <message-error :message="errors.telefono"></message-error> 
              </div>
            </div><!-- Teléfono -->
    
            <div v-if="newClient" class="col-6"><!-- Direcciones -->
              <div class="form-group">
                <label>Direcciones</label>
                <select class="custom-select" v-model="client.address" required>
                  <option value="">Selecione una dirección</option>
                  <option v-for="address in addresses" :value="address.identificador" >{{ address.nombre_direccion }}</option>
                </select>
              </div>
            </div><!-- Direcciones -->

            <div v-else class="col-6"><!-- Dirección -->
              <div class="form-group">
                <label>Dirección</label>
                <input :disabled="!newClient" v-model="client.address" type="text" class="form-control" required>
              </div>
            </div><!-- Dirección -->
           
            <div v-if="newClient" class="col-6"><!-- Area -->
              <div class="form-group" >
                <label>Área</label>
                <select class="custom-select" v-model="client.area" required>
                  <option value="">Selecione una area</option>
                  <option v-for="area in areas" :value="area.identificador">{{ area.nombre_area }}</option>
                </select>
              </div>
            </div><!-- Area -->

            <div v-else class="col-6"><!-- Area -->
              <div class="form-group">
                <label>Área</label>
                <input :disabled="!newClient" v-model="client.area" type="text" class="form-control" required>
              </div>
            </div><!-- Area -->
          </div>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-header bg-dark">
          <h6 class="mt-2 text-white d-inline-block">
            Datos del dispositivo 
          </h6>
          <a v-if="device.device" data-toggle="modal" data-target="#clientDevices" href="#" class="btn btn-primary float-right btn-sm">Mis dispositivos</a>
        </div>

        <div class="card-body">
          <div class="row">

            <div class="col-md-6"><!-- Nombre del dispositivo -->
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="nameRegister" v-model="checkNameDevice">
                <label class="custom-control-label" for="nameRegister">Nuevo nombre</label>
              </div>
              <div class="form-group">
                <label>Nombre</label>

                <input
                  @input="resetDevice"
                  v-if="checkNameDevice"
                  v-model="device.name"
                  type="text"
                  class="form-control text-capitalize"
                  required
                >

                <select v-else class="custom-select" v-model="device.name" required>
                  <option value="">Selecione un dispositivo</option>
                  <option v-for="name in nameDevices" :value="name.nombre" >{{ name.nombre }}</option>
                </select>
                
                <message-error :message="errors.nombre"></message-error> 

              </div>
            </div><!-- Nombre del dispositivo -->

            <div class="col-md-6"><!-- Marca -->
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="brandRegister" v-model="checkBrand">
                <label class="custom-control-label" for="brandRegister">Nueva marca</label>
              </div>
              <div class="form-group">
                <label>Marca</label>

                <input
                  @input="resetDevice"
                  v-if="checkBrand"
                  v-model="device.brand"
                  type="text"
                  class="form-control text-capitalize"
                  required
                >

                <select v-else class="custom-select" v-model="device.brand" required>
                  <option value="">Selecione una marca</option>
                  <option v-for="brand in brands" :value="brand.nombre" >{{ brand.nombre }}</option>
                </select>

              </div>
            </div><!-- Marca -->

            <div class="col-md-6"><!-- Modelo -->
              <div class="form-group">
                <label>Modelo</label>
                <input v-model="device.model" type="text" class="form-control" >
              </div>
            </div><!-- Modelo -->

            <div class="col-md-6"><!-- Codigo de bien nacional -->
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="bn" v-model="checkBn">
                  <label class="custom-control-label" for="bn">Bien nacional</label>
                </div>
                <input v-if="checkBn" v-model="device.bn" type="text" class="form-control" style="margin-top: 6px" required>
              </div>
            </div><!-- Codigo de bien nacional -->

            <div class="col-12">
              <div class="form-group">
                <label for="observaciones">Observaciones de recepción</label>
                <textarea v-model="device.description" class="form-control" id="observaciones" rows="3" required></textarea>
              </div>
            </div>
          </div>
        </div>       
      </div>

      <div class="card mt-3">
        <div class="card-header bg-dark">
          <h6 class="m-0 text-white">
            Datos del técnico 
          </h6>
        </div>
        <div class="card-body">
          <set-user :users="users"></set-user>
        </div>
        <div class="card-footer">
          <button
            type="submit"
            href="#"
            class="btn btn-success float-right"
          >Registrar orden de servicio</button>
        </div>  
      </div>

    </form>

      
    <div class="modal" id="clientDevices" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Mis dispositivos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-0">
            <table class="table text-center">
              <thead class="bg-dark text-white">
                <tr>
                  <th>Nombtre</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>B/N</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="device in client.devices">
                  <td>{{device.nombre}}</td>
                  <td>{{device.marca}}</td>
                  <td>{{device.modelo}}</td>
                  <td v-if="device.bienNacinal">{{device.bienNacinal}}</td>
                  <td v-else>No</td>
                  <td>
                    <a title="Seleccionar" data-dismiss="modal" @click="selectDevice(device)" href="#" class="btn btn-outline-success btn-sm">
                      <i class="fas fa-check"></i>
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
  import SetUser from '../partials/SetUser'
  import MessageError from '../partials/messageError'
  export default {

    components:{
      SetUser,
      MessageError
    },
    name: 'Service',
    data(){
      return {
        loading: false,
        client: {
          ci: '',
          first_name: '',
          last_name: '',
          phone: '',
          area: '', 
          address: '',
          devices: ''
        },
        device: {
          id: '',
          name: '',
          brand: '',
          model: '',
          bn: '',
          description: '',
          device: false
        },
        nameUser:'',
        idUser:'',
        idArea:'',
        idAddress:'',
        newClient: true,
        checkNameDevice: false,
        checkBrand: false,
        checkBn: false,
        addresses:'',
        areas:'',
        nameDevices:'',
        brands:'',
        users: [],
        errors: []
      }
    },
    created(){
      eventBus.$on('idUser', (value) => {
        this.idUser = value 
      })
    },
    mounted(){
      this.getAddress()
      this.getAreas()
      this.getSubDevice()
      this.getBrands()
      this.getUsers()
      
    },

    methods: {

      searchClient(){
        if (this.client.ci != '') {
          this.loading = true
          eventBus.$emit('loading', true)
          axios
            .get("/api/clients/"+this.client.ci)
            .then(response => {
              this.newClient = false
              this.client.first_name = response.data.data.nombres
              this.client.last_name = response.data.data.apellidos
              this.client.phone = response.data.data.telefono
              this.idArea = response.data.data.identificador_area
              this.client.address = response.data.data.nombre_direccion
              this.idAddress = response.data.data.identificador_direccion
              this.client.area = response.data.data.nombre_area
              this.getClientDevices(response.data.data.identificador)
              this.loading = false
            })
            .catch(error => {
              console.log(error)
              this.loading = false
            })
            .then(() => {eventBus.$emit('loading', false)})
        }
      },

      resetClient(){
        this.client.first_name = ''
        this.client.last_name = ''
        this.client.phone = ''
        this.client.area = ''
        this.client.address = ''
        this.idArea = ''
        this.newClient= true
        this.device.device = false 
      },
      resetDevice(){
        this.device.model = ''
        this.device.bn = ''
        this.device.description = ''
      },

      getAreas(){
        axios
          .get("api/areas")
          .then(response => {this.areas = response.data.data})
          .catch(error => {
            console.log(error)
            this.areas = []
          })
      },

      getAddress(){
        axios
          .get("/api/addresses")
          .then(response => {this.addresses = response.data.data})
          .catch(error => {console.log(error)})
      },

      getSubDevice(){
        axios
          .get("/api/sub-devices")
          .then(response => {this.nameDevices = response.data.data})
          .catch(error => {console.log(error)})
      },

      getBrands(){
        axios
          .get("/api/brands")
          .then(response => {this.brands = response.data.data})
          .catch(error => {console.log(error)})
      },

      getUsers(){
        axios
          .get("/api/users-all")
          .then(response => {this.users = response.data.data})
          .catch(error => {console.log(error)})
      },

      getClientDevices(clientId){
        axios
          .get("api/clients/"+clientId+"/devices")
          .then(response => {
            this.client.devices = response.data.data
            this.device.device = true
          })
          .catch(error => {
            console.log(error)
            this.device.device = false
          });
      },

      setNameUser(event){
        for (let i = 0; i <= this.users.length; i++) {
          if (this.users[i].identificador == this.idUser) {
            this.idUser = this.users[i].identificador
            this.nameUser = this.users[i].apellido+', '+this.users[i].nombre
            break
          } else {
            console.log(i)
          }
        } 
      },

      selectDevice(device){

        this.device.id =  device.identificador
        this.device.name =  device.nombre
        this.device.brand =  device.marca
        this.device.model =  device.modelo
        this.device.bn = device.bienNacinal
        this.device.description = device.description
        if (this.device.bn) this.checkBn = true
        else this.checkBn = false
        this.checkNameDevice = true
        this.checkBrand = true

      },
      saveOrder(){
        let area = ''
        if (typeof(this.client.area) == 'number') {
          area = this.client.area
        } else {
          area = this.idArea
        }

        let address = ''
        if (typeof(this.client.address) == 'number') {
          address = this.client.address
        } else {
          address = this.idAddress
        }

        let order = {
          // Datos del cliente
          cedula: this.client.ci,
          nombres: this.client.first_name,
          apellidos: this.client.last_name,
          telefono: this.client.phone,
          area: area,
          direccion: address,
          // Datos del dispositivo
          equipo: this.device.id,
          nombre_equipo: this.device.name.toLowerCase(),
          marca: this.device.brand.toLowerCase(),
          modelo: this.device.model,
          bienNacional: this.device.bn,
          detalle: this.device.description,
          // Datos del tecnico
          tecnico: this.idUser
        }

        axios
          .post("api/orders", order)
          .then(response => {
            Swal({
              type: 'success',
              title: 'Excelente',
              html:'<p>Datos guardados con exito</p><h3>Código de orden: <strong>LAB-'+response.data.data.codigo+'</strong></h3>',
              confirmButtonText: 'Continuar',
            }).then(() => {
              this.$router.push('/')
            })
          })
          .catch(error => {
            if (error.response) {
              console.log('error.response')
              console.log(error.response.data.error)
              this.errors = error.response.data.error
            } else if (error.request) {
                console.log('error.request');
                console.log(error.request);
            } else {
                console.log('Error', error.message);
            }
          })
      }

    },
  }

</script>

<style></style>