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
                @input="resetForm()"
                v-model="client.ci"
                type="text"
                class="form-control"
                placeholder="Cedula del cliente"
                aria-label="Cedula del cliente">
            </div>
          </div><!-- Cedula Nuevo Cliente -->

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

          <div class="col-6"><!-- Teléfono -->
            <div class="form-group">
              <label>Teléfono</label>
              <input :disabled="!newClient" v-model="client.phone" type="text" class="form-control">
            </div>
          </div><!-- Teléfono -->

          <div v-if="newClient" class="col-6"><!-- Area -->
            <div class="form-group">
              <label>Área</label>
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
              <label>Área</label>
              <input :disabled="!newClient" v-model="client.area" type="text" class="form-control">
            </div>
          </div><!-- Area -->

          <div v-if="newClient" class="col-6"><!-- Direcciones -->
            <div class="form-group">
              <label>Direcciones</label>
              <select class="form-control">
                <option>Selecione una dirección</option>
                <option value="">Dirección 1</option>
                <option value="">Dirección 2</option>
                <option value="">Dirección 3</option>
                <option value="">Dirección 4</option>
                <option value="">Dirección 5</option>
              </select>
            </div>
          </div><!-- Direcciones -->

          <div v-else class="col-6"><!-- Dirección -->
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
        newClient: true
      }
    },
    methods: {
      searchClient(ci){
        axios
        .get("/api/clients/"+this.client.ci, {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
        .then(response => {
            this.newClient = false
            console.log(response.data.data)
            this.client.first_name = response.data.data.nombres
            this.client.last_name = response.data.data.apellidos
            this.client.phone = response.data.data.telefono
            this.client.address = response.data.data.direccion
            this.client.area = response.data.data.area
          })
        .catch(error => (
            console.log(error)
          ));
      },
      resetForm(){
        this.client.first_name = ''
        this.client.last_name = ''
        this.client.phone = ''
        this.client.area = ''
        this.client.address = ''
        this.newClient= true
      }
    }
  }

</script>

<style></style>