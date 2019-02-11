<template>
  <div class="card" style="margin: 10px;">
    <div class="card-content row">
      <div class="card-title col-12 p-0">
        <h4 v-if="!clientForm">Lista de los clientes</h4>
        <h4 v-else>Registro de clientes</h4>
      </div>
      <div class="col-12 row" v-if="!clientForm">
        <input
          type="text"
          class="form-control col-4"
          placeholder="Buscar..."
          v-model="search"
        >
        <div class="col-8">          
          <button
            @click.prevent="clientForm = !clientForm"
            v-if="!clientForm"
            class="btn btn-primary text-white float-right"
            title="Registrar un cliente"
          >
            <i class="fas fa-plus"></i>
          </button>
        </div>
        
        <client-list
          :clients="filteredClients"
          :editClickHandler="setClient"
          :deleteClickHandler="deleteClient"
        />
      </div>

      <form v-else class="col-12 row" @submit.prevent="submit">
        <message-error v-if="errors.length" class="col-12 alert-danger alert" :message="errors"></message-error>        
        <div class="form-group col-6">
          <label for="ci">Cedula:</label>
          <input
            class="form-control"
            type="text"
            name="ci"
            v-model="client.cedula"
            placeholder="cedula"
            :readonly="update"
            :class="[ errors.cedula ? 'is-invalid' : '' ]"
          >
          <message-error :message="errors.cedula"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="first_name">Nombre:</label>
          <input
            class="form-control"
            type="text"
            name="first_name"
            v-model="client.nombres"
            placeholder="nombre"
            :class="[ errors.nombres ? 'is-invalid' : '' ]"
          >
          <message-error :message="errors.nombres"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="last_name">Apellido:</label>
          <input
            class="form-control"
            type="text"
            name="last_name"
            v-model="client.apellidos"
            placeholder="apellido"
            :class="[ errors.apellidos ? 'is-invalid' : '' ]"
          >
          <message-error :message="errors.apellidos"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="phone">Teléfono:</label>
          <input
            class="form-control"
            type="text"
            name="phone"
            v-model="client.telefono"
            placeholder="teléfono"
            :class="[ errors.telefono ? 'is-invalid' : '' ]"
          >
          <message-error :message="errors.telefono"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="address">Direcciòn:</label>
          <select
            class="custom-select"
            name="address"
            v-model="client.identificador_direccion"
            @change="getAreas"
            :class="[ errors.identificador_direccion ? 'is-invalid' : '' ]"
          >
            <option value>Seleccione Una</option>
            <option
              v-for="address in addresses"
              :value="address.identificador"
              :key="address.identificador"
            >{{address.nombre}}</option>
          </select>
          <message-error :message="errors.identificador_direccion"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="area">Area:</label>
          <select
            class="custom-select"
            name="area"
            v-model="client.identificador_area"
            :class="[ errors.identificador_area ? 'is-invalid' : '' ]"
          >
            <option value>Seleccione Una</option>
            <option
              v-for="area in areas"
              :value="area.identificador"
              :key="area.identificador"
            >{{area.nombre}}</option>
          </select>
          <message-error :message="errors.identificador_area"></message-error> 
        </div>

        <div class="form-group col-12 mt-5 d-flex justify-content-end">
          <button class="btn btn-secondary m-2" @click.prevent="toggleClientForm()">Cancelar</button>
          <input type="submit" class="btn btn-primary m-2" value="Guardar">
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ClientList from "../partials/ClientList";
import MessageError from '../partials/messageError'

export default {
  name: "clients",
  data() {
    return {
      errors: [],
      newClient: false,
      clientForm: false,
      client: {
        identificador: "",
        cedula: "",
        nombres: "",
        apellidos: "",
        telefono: "",
        identificador_area: "",
        identificador_direccion: ""
      },
      clients: [],
      areas: [],
      addresses: [],
      update: false,
      search: "",
    };
  },
  created() {
    this.getAddresses();
    this.getAreas();
    this.getClients();
  },
  computed: {
    filteredClients: function() {
      return this.clients.filter(item => {
        let fullName = item.nombres + " " + item.apellidos;

        return (
          fullName.toLowerCase().includes(this.search.toLowerCase()) ||
          item.cedula.includes(this.search)
        );
      });
    }
  },
  methods: {
    getClients() {
      this.$emit('loading-data', true)
      axios
        .get("api/clients")
        .then(response => {
          this.clients = response.data.data
          this.$emit('loading-data', false)
        })
        .catch(error => {
          console.log(error)
          this.$emit('loading-data', false)
        });
    },

    getAddresses() {
      axios
        .get("api/addresses")
        .then(response => {
          this.addresses = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    getAreas() {
      axios
        .get(`api/areas`)
        .then(response => (this.areas = response.data.data))
        .catch(error => {
          console.log(error);
          this.areas = [];
        });
    },

    setClient(event) {
      for (let i = 0; i < this.clients.length; i++) {
        if (this.clients[i].cedula == event.target.id) {
          this.client = this.clients[i];
          this.clientForm = !this.clientForm;
          this.update = true;
          break;
        }
      }
    },

    resetClient() {
      this.client = {
        identificador: "",
        cedula: "",
        nombres: "",
        apellidos: "",
        telefono: "",
        identificador_area: "",
        identificador_direccion: ""
      };
    },

    cleanAfterSubmit() {
      this.clientForm = false;
      this.getClients();
      this.resetClient();
    },

    updateClient() {
      axios
        .put("api/clients/" + this.client.identificador, this.client)
        .then(response => {
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos se acutlizaron con exito",
            confirmButtonText: "Continuar"
          }).then(() => {
            this.update = false;
            this.cleanAfterSubmit();
            this.errors = []
          });
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
        });
    },

    saveClient() {
      axios
        .post("api/clients", this.client)
        .then(response => {
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          }).then(() => {
            this.cleanAfterSubmit();
            this.errors = []
          });
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
        });
    },

    deleteClient(e) {
      this.$emit("prompt", {
        title: "¿Está seguro?",
        message: "¡El registro sera elminado!",
        confirmHandler: () => {
          axios
            .delete("api/clients/" + e.target.id)
            .then(() => {
              this.getClients();
            })
            .catch(error => {
              this.$emit("error", error);
            });
        }
      });
    },
    toggleClientForm(){
      this.clientForm = !this.clientForm
      this.errors = []
    },

    submit() {
      if (this.update) {
        this.updateClient();
      } else {
        this.saveClient();
      }
    }
  },
  components: {
    ClientList,
    MessageError
  }
};
</script>

<style></style>