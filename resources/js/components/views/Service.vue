<template>
  <div>
    <h2>Registro de una nueva orden de servicio</h2>
    <h6>Registre los datos de un nueo servicio de reparación o revición</h6>

    <div class="card">
      <div class="card-header bg-dark">
        <h6 class="m-0 text-white">
          Datos del cliente
        </h6>
      </div>
      <div class="card-body">
        <div class="row">

          <div v-if="newClient" class="col-6"><!-- Cedula Nuevo Cliente -->
            <label>Cedula</label>
            <div class="input-group">
              <input v-model="client.ci" type="text" class="form-control" placeholder="Cedula del cliente" aria-label="Cedula del cliente" @input="resetForm">
            </div>
          </div><!-- Cedula Nuevo Cliente -->

          <div v-else class="col-6"><!-- Cedula -->
            <label>Cedula</label>
            <div class="input-group">
              <input v-model="client.ci" type="text" class="form-control" placeholder="Cedula del cliente" aria-label="Cedula del cliente" aria-describedby="btnBuscarCedula" @input="resetForm">
              <div class="input-group-append">
                <button
                  v-on:click="searchClient(client.ci)"
                  class="btn btn-outline-success"
                  type="button"
                  id="btnBuscarCedula"
                  v-on:click.prevent="newClient = !newClient"
                >Buscar</button>
              </div>
            </div>
          </div><!-- Cedula -->

          <div class="col-6"><!-- Nombres -->
            <div class="form-group">
              <label>Nombres</label>
              <input :disabled="!newClient" v-model="client.first_name" type="text" class="form-control">
            </div>
          </div><!-- Nombres -->

          <div class="col-6"><!-- Apellidos -->
            <div class="form-group">
              <label>Apellidos</label>
              <input :disabled="!newClient" v-model="client.last_name" type="text" class="form-control">
            </div>
          </div><!-- Apellidos -->

          <div class="col-6"><!-- Telefno -->
            <div class="form-group">
              <label>Telefno</label>
              <input :disabled="!newClient" v-model="client.phone" type="text" class="form-control">
            </div>
          </div><!-- Telefno -->

          <div v-if="newClient" class="col-6"><!-- Area -->
            <div class="form-group">
              <label>Area</label>
              <select class="form-control">
                <option>Selecione una area</option>
                <option value="">Area 1</option>
                <option value="">Area 2</option>
                <option value="">Area 3</option>
                <option value="">Area 4</option>
                <option value="">Area 5</option>
              </select>
            </div>
          </div><!-- Area -->

          <div v-else class="col-6"><!-- Area -->
            <div class="form-group">
              <label>Area</label>
              <input :disabled="!newClient" v-model="client.area" type="text" class="form-control">
            </div>
          </div><!-- Area -->



          <div v-if="!newClient" class="col-6"><!-- Dirección -->
            <div class="form-group">
              <label>Dirección</label>
              <input :disabled="!newClient" v-model="client.address" type="text" class="form-control">
            </div>
          </div><!-- Dirección -->

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
          ci: '',
          first_name: '',
          last_name: '',
          phone: '',
          area: '',
          address: '',
        },
        newClient: false
      }
    },
    methods: {
      searchClient(ci){
        console.log('Buscar: '+ci)

        this.client.ci = '22998438'
        this.client.first_name = 'Jesus'
        this.client.last_name = 'Calderin'
        this.client.phone = '+112 212121 54'
        this.client.area = '+112 212121 54'
        this.client.address = '+112 212121 54'
        // axios
        // .get("/auth/clients")
        // .then(response => console.log(response.data))
        // .catch(error => {
        //   console.log('Error')
        // });
      },
      resetForm(){
        this.client.first_name = ''
        this.client.last_name = ''
        this.client.phone = ''
        this.client.area = ''
        this.client.address = ''
        this.newClient= false
      }
    }
  }

</script>

<style></style>