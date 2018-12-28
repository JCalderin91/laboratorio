<template>
  <div>
    <h2>Registro de una nueva orden de servicio</h2>
    <h6>Registre los datos de un nuevo servicio de reparación o revición</h6>



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
              <div class="input-group">
                <input
                  @keypress.enter="searchClient(client.ci)"
                  @blur="searchClient(client.ci)"
                  @input="resetClient()"
                  v-model="client.ci"
                  type="text"
                  class="form-control"
                  placeholder="Cedula del cliente"
                  aria-label="Cedula del cliente"
                  required>
              </div>
            </div><!-- Cedula Nuevo Cliente -->

            <div class="col-6"><!-- Nombres -->
              <div class="form-group">
                <label>Nombres</label>
                <input :disabled="!newClient" v-model="client.first_name" type="text" class="form-control" required>
              </div>
            </div><!-- Nombres -->

            <div class="col-6"><!-- Apellidos -->
              <div class="form-group">
                <label>Apellidos</label>
                <input :disabled="!newClient" v-model="client.last_name" type="text" class="form-control" required>
              </div>
            </div><!-- Apellidos -->

            <div class="col-6"><!-- Teléfono -->
              <div class="form-group">
                <label>Teléfono</label>
                <input :disabled="!newClient" v-model="client.phone" type="text" class="form-control" required>
              </div>
            </div><!-- Teléfono -->

            <div v-if="newClient" class="col-6"><!-- Direcciones -->
              <div class="form-group">
                <label>Direcciones</label>
                <select class="custom-select" v-model="client.address" @change="getAreas(client.address)" required>
                  <option value="">Selecione una dirección</option>
                  <option v-for="address in addresses" :value="address.identificador" >{{ address.nombre }}</option>
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
                  <option v-for="area in areas" :value="area.identificador">{{ area.nombre }}</option>
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
                <input type="checkbox" class="custom-control-input" id="nameRegister" v-model="checkNameDevice" required>
                <label class="custom-control-label" for="nameRegister">Nuevo nombre</label>
              </div>
              <div class="form-group">
                <label>Nombre</label>

                <input
                  @input="resetDevice()"
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

              </div>
            </div><!-- Nombre del dispositivo -->

            <div class="col-md-6"><!-- Marca -->
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="brandRegister" v-model="checkBrand" required>
                <label class="custom-control-label" for="brandRegister">Nueva marca</label>
              </div>
              <div class="form-group">
                <label>Marca</label>

                <input
                  @input="resetDevice()"
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
                <input v-model="device.model" type="text" class="form-control" required>
              </div>
            </div><!-- Modelo -->

            <div class="col-md-6"><!-- Codigo de bien nacional -->
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="bn" v-model="checkBn" required>
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
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Cedula</label>

                <select class="custom-select" required>
                  <option value="">Selecione una cedula</option>
                  <option @click="setNameUser(user)" v-for="user in users" :value="user.identificador">{{ user.cedula }}</option>
                </select>

              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Datos</label>
                <input disabled type="text" class="form-control" v-model="nameUser" required>   
              </div>
            </div>

          </div>
        </div>
        <div class="card-footer">
          <a
            @click.prevent="saveOrder"
            href="#"
            class="btn btn-success float-right"
          >Registrar orden de servicio</a>
        </div>  
      </div>

      
    <pre>{{ $data }}</pre>
    

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
                  <th>Bien nacional</th>
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
  export default {
    name: 'Service',
    data(){
      return {
        client: {
          ci: '10196016',
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
        newClient: true,
        checkNameDevice: false,
        checkBrand: false,
        checkBn: false,
        addresses:'',
        areas:'',
        nameDevices:'',
        brands:'',
        users: '',
      }
    },

    mounted(){
      this.getAddress()
      this.getSubDevice()
      this.getBrands()
      this.getUsers()
    },

    methods: {

      searchClient(ci){
        if (ci != '') {
          axios
          .get("/api/clients/"+this.client.ci, {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.newClient = false
            this.client.first_name = response.data.data.nombres
            this.client.last_name = response.data.data.apellidos
            this.client.phone = response.data.data.telefono
            this.idArea = response.data.data.identificador_area
            this.client.address = response.data.data.direccion
            this.client.area = response.data.data.nombre_area
            this.getClientDevices(response.data.data.identificador)
          })
          .catch(error => (
            console.log(error)
          ));
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

      getAreas(area){
       axios
        .get("api/addresses/"+area+"/areas", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => (
              this.areas = response.data.data
            ))
          .catch(error => {
            console.log(error)
            this.areas = []
          });
      },

      getAddress(){
        axios
        .get("/api/addresses", {
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
      },

      getSubDevice(){
        axios
        .get("/api/sub-devices", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
              this.nameDevices = response.data.data
            })
          .catch(error => (
              console.log(error)
            ));
      },

      getBrands(){
        axios
        .get("/api/brands", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.brands = response.data.data
          })
          .catch(error => (
            console.log(error)
          ));
      },

      getUsers(){
        axios
        .get("/api/users", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.users = response.data.data
          })
          .catch(error => (
            console.log(error)
          ));
      },

      getClientDevices(clientId){
        axios
        .get("api/clients/"+clientId+"/devices", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.client.devices = response.data.data
            this.device.device = true
          })
          .catch(error => {
            console.log(error)
            this.device.device = false
          });
      },

      setNameUser(user){
        //console.log(event.target.text)
        //setear el id y el name a mostrar
        this.idUser = user.identificador
        this.nameUser = user.apellido+', '+user.nombre 
      },

      selectDevice(device){

        this.device.id =  device.identificador
        this.device.name =  device.nombre
        this.device.brand =  device.marca
        this.device.model =  device.modelo
        this.device.bn = device.bienNacinal
        this.device.description = device.bienNacinal
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

        axios
        .post("api/orders", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            },
            // Datos del cliente
            cedula: this.client.ci,
            nombres: this.client.first_name,
            apellidos: this.client.last_name,
            phone: this.client.phone,
            area: area,
            //address: this.client.address,
            // Datos del dispositivo
            equipo: this.device.id,
            nombre_equipo: this.device.name.toLowerCase(),
            marca: this.device.brand.toLowerCase(),
            modelo: this.device.model,
            bienNacional: this.device.bn,
            detalle: this.device.description,
            // Datos del tecnico
            tecnico: this.idUser
          })
          .then(response => {
            Swal({
              type: 'success',
              title: 'Excelente',
              text: 'Datos guardados con exito',
              confirmButtonText: 'Continuar',
            }).then(() => {
              this.$router.push('/');
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
          });
      }

    }
  }

</script>

<style></style>