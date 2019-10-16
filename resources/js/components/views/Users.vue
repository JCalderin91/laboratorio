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
          
        <input type="text" class="form-control col-4" placeholder="Buscar...">
        <div class="col-8">
          <button
            @click.prevent="userForm = !userForm"
            v-if="!userForm && isAdmin"
            class="btn btn-primary text-white"
          >
            <i class="fas fa-plus"></i>
          </button>
        </div>
        

        <user-list :users="users" :destroy="destroyUser" :edit="editUser" @edit.stop="toggleForm"></user-list>
      </div>

      <form v-else class="col-12 row" @submit.prevent="submit">
        <div class="form-group col-6">
          <label for="ci">Cedula <span class="text-danger">*</span></label>
          <input
            class="form-control"
            type="text"
            name="ci"
            v-model="user.cedula"
            :disabled="update"
            placeholder="Cedula"
            required
          >
        </div>
        <div class="form-group col-6">
          <label for="first_name">Nombres <span class="text-danger">*</span></label>
          <input
            class="form-control"
            type="text"
            name="first_name"
            v-model="user.nombre"
            placeholder="Nombres"
            required
          >
        </div>
        <div class="form-group col-6">
          <label for="last_name">Apellidos <span class="text-danger">*</span></label>
          <input
            class="form-control"
            type="text"
            name="last_name"
            v-model="user.apellido"
            placeholder="Apellidos"
            required
          >
        </div>

        <div class="form-group col-6">
          <label for="role">Rol <span class="text-danger">*</span></label>
          <select
            class="form-control"
            type="text"
            name="role"
            v-model="user.esAdministrador"
            required
          >
            <option value>Seleccione un rol</option>
            <option value="true">Profesor</option>
            <option value="false">Técnico</option>
          </select>
        </div>

        <div class="form-group col-6">
          <label for="gender">Género <span class="text-danger">*</span></label>
          <select class="form-control" type="text" name="gender" v-model="user.sexo" required>
            <option value>Seleccione un genero</option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
          </select>
        </div>

        <div class="col-12 float-right d-flex justify-content-end">
          <button
            v-if="update"
            type="button"
            class="btn btn-light"
            @click.prevent="toggleForm"
            id="update-cancel-button"
          >Cancelar</button>
          <button
            v-else
            type="button"
            class="btn btn-light"
            @click.prevent="toggleForm"
            id="create-cancel-button"
          >Cancelar</button>
          
          <button id="close-modal2" type="submit" class="btn btn-success ml-3">Guardar</button>
        </div>
        <small class="text-danger">(*) Campos requeridos</small>
      </form>
    </div>
  </div>
</template>

<script>
import UserList from "../partials/UserList";
export default {
  name: "users",
  data() {
    return {
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
    }
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    toggleForm(event) {
      let id = event.target.id;

      if (id == "update-cancel-button") {
        this.userForm = false;
        this.update = false;
        this.clearUserData();
      } else if (id == "create-cancel-button") {
        this.userForm = false;
      }
    },

    destroyUser(id) {
      axios
        .delete("/api/users/"+id)
        .then(response => {
          this.getUsers();
          this.$emit("loading-data", false);
        })
        .catch(error => {
          this.$emit("error", error);
          this.$emit("loading-data", false);
        });
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
          });
        })
        .catch(error => {
          this.$emit("error", error);
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
          });
        })
        .catch(error => {
          this.$emit("error", error);
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
    UserList
  }
};
</script>

<style></style>