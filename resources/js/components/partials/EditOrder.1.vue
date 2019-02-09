<template>
  <div style="width: 100%">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="client-tab"
          data-toggle="tab"
          href="#client"
          role="tab"
          aria-controls="client"
          aria-selected="true"
        >Cliente</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          id="reception-tab"
          data-toggle="tab"
          href="#reception"
          role="tab"
          aria-controls="reception"
          aria-selected="false"
        >Recepción</a>
      </li>
      <li v-if="true" class="nav-item">
        <a
          class="nav-link"
          id="repair-tab"
          data-toggle="tab"
          href="#repair"
          role="tab"
          aria-controls="repair"
          aria-selected="false"
        >Revisión</a>
      </li>
      <li v-if="true" class="nav-item">
        <a
          class="nav-link"
          id="delivery-tab"
          data-toggle="tab"
          href="#delivery"
          role="tab"
          aria-controls="delivery"
          aria-selected="false"
        >Entrega</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div
        class="tab-pane fade show active"
        id="client"
        role="tabpanel"
        aria-labelledby="client-tab"
      >
        <div class="row p-3">
          <div class="col-6">
            <!-- Cedula Nuevo Cliente -->
            <label>Cédula</label>
            <div class="input-group">
              <input
                v-model="cliente.cedula"
                type="text"
                class="form-control"
                placeholder="Cedula del cliente"
                aria-label="Cedula del cliente"
                disabled
                required
              >
            </div>
          </div>
          <!-- Cedula Nuevo Cliente -->
          <div class="col-6">
            <!-- Nombres -->
            <div class="form-group">
              <label>Nombres</label>
              <input
                :readonly="!isAdmin"
                v-model="cliente.nombres"
                type="text"
                class="form-control"
                required
                @input="setFlag(0)"
              >
            </div>
          </div>
          <!-- Nombres -->
          <div class="col-6">
            <!-- Apellidos -->
            <div class="form-group">
              <label>Apellidos</label>
              <input
                :readonly="!isAdmin"
                v-model="cliente.apellidos"
                type="text"
                class="form-control"
                required
                @input="setFlag(0)"
              >
            </div>
          </div>
          <!-- Apellidos -->
          <div class="col-6">
            <!-- Teléfono -->
            <div class="form-group">
              <label>Teléfono</label>
              <input
                :readonly="!isAdmin"
                v-model="cliente.telefono"
                type="text"
                class="form-control"
                required
                @input="setFlag(0)"
              >
            </div>
          </div>
          <!-- Teléfono -->
          <div class="col-6">
            <!-- Direcciones -->
            <div class="form-group">
              <label>Dirección</label>
              <select :disabled="!isAdmin" class="custom-select" required @change="setFlag(0)">
                <option value>Selecione una dirección</option>
                <option
                  v-for="address in addresses"
                  :key="'addr-'+address.identificador"
                  :selected="address.nombre === cliente.nombre_direccion"
                  :value="address.identificador"
                >{{address.nombre}}</option>
              </select>
            </div>
          </div>
          <!-- Direcciones -->
          <div class="col-6">
            <!-- Area -->
            <div class="form-group">
              <label>Área</label>
              <select :disabled="!isAdmin" class="custom-select" required @change="setFlag(0)">
                <option value>Selecione una area</option>
                <option
                  v-for="area in areas"
                  :key="'area-'+area.identificador"
                  :selected="area.nombre === cliente.nombre_area"
                  :value="area.identificador"
                >{{area.nombre}}</option>
              </select>
            </div>
          </div>
          <!-- Area -->
        </div>
        <a @click.prevent="saveChanges" href="#" class="btn btn-success m-3 float-right">Guardar</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "edit-order",
  props: ["id"],
  data() {
    return {
      cliente: null,
      recepcion: null,
      revision: null,
      entrega: null,
      addresses: [],
      subDevices: [],
      brands: [],
      users: [],
      areas: [],
      isAdmin: this.$session.get("isAdmin"),
      flags: [0, 0, 0, 0]
    };
  },
  created() {
    this.getOrder();
    this.getAddresses();
    this.getAreas();
    this.getSubDevice();
    this.getBrands();
    this.getUsers();
  },
  methods: {
    formatDate(date) {
      if (date == "" || date == null) return "";
      let fecha = date.split(" ")[0].split("-");

      return `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
    },
    finishEditing() {
      eventBus.$emit("editingOrder", false);
    },
    getOrder() {
      axios
        .get("api/orders/" + this.id)
        .then(response => {
          let data = response.data.data
          this.cliente = data.cliente.data
          this.equipo = data.equipo.data
          this.tecnicoRecepcion = data.tecnico.data
          
          //reparacion
          let { detalle, estado, fechaCreacion, identificador } = data.reparacion.data
          this.reparacion = {detalle, estado, fechaCreacion, identificador}
          this.reparacion.tecnico = data.reparacion.data.tecnico.data.identificador
          console.log(this.reparacion)
        })
        .catch(error => {
          console.log(error);
        });
    },
    getUsers() {
      this.$emit("loading-data", true);
      axios
        .get("/api/users/")
        .then(response => {
          this.$emit("loading-data", false);
        })
        .catch(error => {
          this.$emit("error", error);
          this.$emit("loading-data", false);
        });
    },
    getAreas() {
      axios
        .get("api/areas")
        .then(response => {
          this.areas = response.data.data;
        })
        .catch(error => {
          console.log(error);
          this.areas = [];
        });
    },
    getAddresses() {
      axios
        .get("/api/addresses")
        .then(response => {
          this.addresses = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    getSubDevice() {
      axios
        .get("/api/sub-devices")
        .then(response => {
          this.devices = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    getBrands() {
      axios
        .get("/api/brands")
        .then(response => {
          this.brands = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    setFlag(tab) {
      this.flags[tab] += 1;
    },

    saveChanges() {
      console.log(this.flags);

      if (this.flags[0]) this.updateClient();
      if (this.flags[1]) this.updateRecepcion();
      if (this.flags[2]) this.updateRevicion();
      if (this.flags[3]) this.updateDelivery();
    }
  }
};
</script>

<style>
#myTabContent {
  border: 1px solid #dee2e6 !important;
  border-top: none !important;
}
.nav-link.active {
  background-color: var(--dark) !important;
  color: white !important;
}
#myTab .nav-link {
  color: var(--dark);
}
</style>
