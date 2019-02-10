<template>
  <div class="card col-11" style="margin: 10px;">
    <div class="card-content row">
      <div class="card-title col-12 p-0">
        <h4 v-if="!userForm">
          Lista de los
          <span v-if="isAdmin">usuarios</span>
          <span v-else>técnicos</span>
        </h4>
        <h4 v-else-if="userForm && update">Editar usuario</h4>
        <h4 v-else>Registro de usuarios</h4>
      </div>
      <div class="col-12 row" v-if="!userForm">

        <input v-model="search" type="text" class="form-control col-4" placeholder="Buscar...">

        <div class="col-8">
          <button
            @click.prevent="userForm = !userForm"
            v-if="!userForm && isAdmin"
            class="btn btn-primary text-white float-right"
          >
            <i class="fas fa-plus"></i>
          </button>
        </div>

        

        <user-list :users="filteredUsers" :edit="editUser" @edit.stop="toggleForm"></user-list>

      </div>

      <form v-else class="col-12 row" @submit.prevent="submit">
        <message-error v-if="errors.length" class="col-12 alert-danger alert" :message="errors"></message-error> 
        <div class="form-group col-6">
          <label for="ci">Cedula:</label>
          <input
            class="form-control"
            type="text"
            name="ci"
            v-model="user.cedula"
            placeholder="Cedula"
            :class="[ errors.cedula ? 'is-invalid' : '' ]"           
          >
          <message-error :message="errors.cedula"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="first_name">Nombres:</label>
          <input
            class="form-control"
            type="text"
            name="first_name"
            v-model="user.nombres"
            placeholder="Nombres"            
            :class="[ errors.nombres ? 'is-invalid' : '' ]" 
          >
          <message-error :message="errors.nombres"></message-error> 
        </div>
        <div class="form-group col-6">
          <label for="last_name">Apellidos:</label>
          <input
            class="form-control"
            type="text"
            name="last_name"
            v-model="user.apellidos"
            placeholder="Apellidos"
            :class="[ errors.apellidos ? 'is-invalid' : '' ]" 
          >
          <message-error :message="errors.apellidos"></message-error> 
        </div>

        <div class="form-group col-6">
          <label for="role">Rol:</label>
          <select
            class="custom-select"
            name="role"
            v-model="user.esAdministrador"  
            placeholder="Rol"
            :class="[ errors.esAdministrador ? 'is-invalid' : '' ]" 
          >          
            <option value>Seleccione un rol</option>
            <option value="true">Profesor</option>
            <option value="false">Técnico</option>
          </select>
          <message-error :message="errors.esAdministrador"></message-error> 
        </div>

        <div class="form-group col-6">
          <label for="gender">Genero:</label>
          <select
            class="custom-select"
            name="gender"
            placeholder="Genero"
            v-model="user.sexo"
            :class="[ errors.sexo ? 'is-invalid' : '' ]"
           >
            <option value>Seleccione un genero</option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
          </select>          
          
          <message-error :message="errors.sexo"></message-error> 
        </div>

        <div class="col-12 float-right d-flex justify-content-end">
          <button
            v-if="update"
            type="button"
            class="btn btn-secondary"
            @click.prevent="toggleForm"
            id="update-cancel-button"
          >Cancelar</button>
          <button
            v-else
            type="button"
            class="btn btn-secondary"
            @click.prevent="toggleForm"
            id="create-cancel-button"
          >Cancelar</button>
          
          <button id="close-modal2" type="submit" class="btn btn-primary ml-3">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import UserList from "../partials/UserList";
import MessageError from '../partials/messageError';

export default {
  name: "users",
  data() {
    return {
      search: '',
      errors: [],
      userForm: false,
      update: false,
      users: [],
      user: {
        cedula: "",
        nombres: "",
        apellido: "",
        esAdministrador: "",
        sexo: ""
      }
    };
  },
  computed: {
    isAdmin() {
      return this.$session.get("isAdmin");
    },
    filteredUsers: function() {
      return this.users.filter(item => {
        return (
          item.cedula.includes(this.search) ||
          item.nombres.toLowerCase().includes(this.search.toLowerCase()) ||
          item.apellidos.toLowerCase().includes(this.search.toLowerCase())
        );
      });
    }
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    toggleForm(event) {
      let id = event.target.id;

      if (id == "update-cancel-button") {
        this.$emit("prompt", {
          title: "¡Atención!",
          message: "Los cambios realizados seran descartados.",
          confirmHandler: () => {
            this.userForm = false;
            this.update = false;
            this.clearUserData();
            this.errors = []
          }
        });
      } else if (id == "create-cancel-button") {
        this.userForm = false;
      }
    },

    editUser(id) {
      this.update = true;
      this.userForm = true;
      this.user = this.users.filter(user => user.cedula == id)[0];
    },

    getUsers() {
      this.$emit("loading-data", true);
      axios
        .get("/api/users")
        .then(response => {
          this.users = response.data.data;
          this.$emit("loading-data", false);
        })
        .catch(error => {
          this.$emit("error", error);
          this.$emit("loading-data", false);
        });
    },
    createUser() {
      axios
        .post("api/users", this.user)
        .then(response => {
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          }).then(() => {
            this.clearUserData();
            this.userForm = false;
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
    updateUser() {
      this.user.esAdministrador =
        this.user.esAdministrador == "true" || this.user.esAdministrador == true
          ? "true"
          : "false";
      axios
        .put("api/users/" + this.user.identificador, this.user)
        .then(response => {
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          }).then(() => {
            this.clearUserData();
            this.userForm = false;
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
    submit() {
      if (this.update) {
        this.updateUser();
      } else {
        this.createUser();
      }

      this.getUsers();
    },
    clearUserData() {
      this.user = {
        ci: "",
        first_name: "",
        last_name: "",
        role: "",
        gender: "",
        password: ""
      };
    }
  },
  components: {
    UserList,
    MessageError
  }
};
</script>

<style></style>