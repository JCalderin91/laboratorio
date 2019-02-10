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
      <li v-if="revision.identificador" class="nav-item">
        <a
          class="nav-link"
          id="repair-tab"
          data-toggle="tab"
          href="#repair"
          role="tab"
          aria-controls="repair"
          aria-selected="false"
        >Revision</a>
      </li>
      <li v-if="entrega.fecha" class="nav-item">
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
              <select
                :disabled="!isAdmin"
                v-model="cliente.identificador_direccion"
                class="custom-select"
                required
                @change="setFlag(0)"
              >
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
              <select
                :disabled="!isAdmin"
                class="custom-select"
                v-model="cliente.identificador_area"
                required
                @change="setFlag(0)"
              >
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
      </div>
      <div class="tab-pane fade" id="reception" role="tabpanel" aria-labelledby="reception-tab">
        <div class="row p-3">
          <div class="col-6">
            <div class="form-group">
              <label>Equipo</label>
              <select
                :disabled="!isAdmin"
                class="custom-select"
                v-model="equipo.nombre"
                required
                @change="setFlag(1)"
              >
                <option value>Selecione una dispositivo</option>
                <option
                  v-for="device in devices"
                  :key="'dev-'+device.identificador"
                  :selected="device.nombre === equipo.nombre"
                  :value="device.identificador"
                >{{device.nombre}}</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Marca</label>
              <select
                :disabled="!isAdmin"
                class="custom-select"
                v-model="equipo.marca"
                required
                @change="setFlag(1)"
              >
                <option value>Selecione una marca</option>
                <option
                  v-for="brand in brands"
                  :key="'brand-'+brand.identificador"
                  :selected="brand.nombre === equipo.marca"
                  :value="brand.identificador"
                >{{brand.nombre}}</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Modelo</label>
              <input
                :readonly="!isAdmin"
                v-model="equipo.modelo"
                type="text"
                class="form-control"
                required
                @input="setFlag(1)"
              >
            </div>
          </div>

          <div v-if="equipo.bienNacional" class="col-6">
            <div class="form-group">
              <label>Bien nacional</label>
              <input
                :readonly="!isAdmin"
                v-model="equipo.bienNacional"
                type="text"
                class="form-control"
                required
                @input="setFlag(1)"
              >
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Tecnico</label>
              <select
                name="tecnico"
                id="tecnico"
                class="form-control"
                v-model="recepcion.tecnico"
                :disabled="!isAdmin"
                @change="setFlag(1)"
              >
                <option
                  v-for="tecnico in users"
                  :key="tecnico.identificador"
                  :value="tecnico.identificador"
                >{{tecnico.apellido + ', '+ tecnico.nombre}}</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Fecha</label>
              <input
                :readonly="!isAdmin"
                v-model="recepcion.fecha"
                type="date"
                class="form-control"
                required
                @input="setFlag(1)"
              >
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="repair" role="tabpanel" aria-labelledby="repair-tab">
        <div class="row p-3">
          <div class="col-6">
            <div class="form-group">
              <label>Fecha de Revisión</label>
              <input
                :readonly="!isAdmin"
                type="date"
                v-model="revision.fecha"
                class="form-control"
                required
                @input="setFlag(2)"
              >
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Estado</label>
              <select
                :readonly="!isAdmin"
                v-model="revision.estado"
                type="text"
                class="form-control"
                required
                @change="setFlag(2)"
              >
                <option value="repaired">Reparado</option>
                <option value="without repair">Sin reparar</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Tecnico</label>
              <select
                name="tecnico"
                id="tecnico"
                class="form-control"
                v-model="revision.tecnico"
                :disabled="!isAdmin"
                @change="setFlag(2)"
              >
                <option
                  v-for="tecnico in users"
                  :key="tecnico.identificador"
                  :value="tecnico.identificador"
                >{{tecnico.apellido + ', '+ tecnico.nombre}}</option>
              </select>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label>Detalle</label>
              <textarea
                v-model="revision.detalle"
                type="text"
                class="form-control"
                required
                style="resize: none"
                @input="setFlag(2)"
              ></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
        <div class="row p-3">
          <div class="col-6">
            <div class="form-group">
              <label>Fecha de Entrega</label>
              <input
                :readonly="!isAdmin"
                type="date"
                v-model="entrega.fecha"
                class="form-control"
                required
                @input="setFlag(3)"
              >
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Tecnico</label>
              <select name="tec-entrega" id="tec-entrega" class="form-control" @change="setFlag(3)">
                <option
                  v-for="tecnico in users"
                  :value="tecnico.identificador"
                  :key="'tec-'+tecnico.identificador"
                >{{tecnico.apellido +', '+ tecnico.nombre}}</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Cedula Retiro</label>
              <input
                v-if="entrega.cedula"
                v-model="entrega.cedula"
                type="text"
                class="form-control"
                required
                @input="setFlag(3)"
              >
              <input
                :readonly="!isAdmin"
                v-else
                v-model="cliente.cedula"
                type="text"
                class="form-control"
                required
                @input="setFlag(3)"
              >
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label>Retirado por</label>
              <input
                :readonly="!isAdmin"
                v-model="entrega.nombre"
                type="text"
                class="form-control"
                required
                @input="setFlag(3)"
              >
            </div>
          </div>
        </div>
      </div>

      <a @click.prevent="saveChanges" href="#" class="btn btn-success m-3 float-right">Guardar</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "edit-order",
  props: ["id"],
  data() {
    return {
      estados: {
        repaired: "Reparado",
        "without repair": "Sin reparación"
      },
      cliente: {
        identificador: "",
        nombres: "",
        apellidos: "",
        telefono: "",
        identificador_area: "",
        nombre_area: "",
        identificador_direccion: "",
        nombre_direccion: ""
      },
      recepcion: {
        tecnico: ""
      },
      revision: {
        fecha: false
      },
      entrega: {
        fecha: false
      },
      equipo: {
        modelo: "",
        nombre: "",
        marca: ""
      },
      addresses: [],
      devices: [],
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
          let data = response.data.data;
          this.cliente = data.cliente.data;
          this.equipo = data.equipo.data;
          this.equipo.nombre = this.equipo.identificador;

          //REVISION
          if (data.reparacion) {
            let {
              detalle,
              estado,
              fechaCreacion,
              identificador
            } = data.reparacion.data;

            this.revision = {
              detalle,
              estado,
              fecha: this.formatDate(fechaCreacion),
              identificador
            };
            this.revision.tecnico =
              data.reparacion.data.tecnico.data.identificador;
          }

          //ENTREGA
          let {
            fechaEntrega,
            cedulaEntrega,
            tecnicoEntrega,
            nombreEntrega
          } = response.data.data;
          this.entrega = {
            fecha: this.formatDate(fechaEntrega),
            cedula: cedulaEntrega,
            tecnico: tecnicoEntrega,
            nombre: nombreEntrega
          };

          //RECEPCION
          this.recepcion = {
            tecnico: data.tecnico.data.identificador,
            fecha: this.formatDate(data.fechaCreacion),
            orden: data.identificador
          };
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
          this.users = response.data.data;
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

    updateClient() {
      axios
        .patch("/api/clients/" + this.cliente.identificador, this.cliente)
        .then(res => {
          console.log("updated client");
        })
        .catch(err => {
          console.log("failed to update client");
        });
    },

    updateDevice() {
      let equipo = { ...this.equipo, cliente: this.cliente.identificador };
      console.log(equipo);
      axios
        .patch("/api/devices/" + this.equipo.identificador, equipo)
        .then(res => {
          console.log("updated device");
        })
        .catch(err => {
          console.log("failed to update device");
        });
    },

    updateRepair() {
      axios
        .patch(
          "/api/orders/${this.recepcion.orden}/repairs/" +
            this.revision.identificador,
          { ...this.revision, orden: this.recepcion.orden }
        )
        .then(res => {
          console.log("updated repair");
        })
        .catch(err => {
          console.log("failed to update repair");
        });
    },

    updateDelivery() {
      console.log(this.entrega);
      axios
        .patch(
          "/api/orders/" +
            this.recepcion.orden +
            "/deliveries/" +
            this.entrega.identificador,
          { ...this.entrega, orden: this.recepcion.orden }
        )
        .then(res => {
          console.log("updated delivery");
        })
        .catch(err => {
          console.log("failed to update delivery");
        });
    },

    saveChanges() {
      this.$emit("loading-data", true);
      //Update Client
      if (this.flags[0]) {
        this.updateClient();
        this.flags[0] = 0;
      }
      if (this.flags[1]) {
        this.updateDevice();
        this.flags[1] = 0;
      }
      if (this.flags[2]) {
        this.updateRepair();
        this.flags[2] = 0;
      }
      if (this.flags[3]) {
        this.updateDelivery();
        this.flags[3] = 0;
      }
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
