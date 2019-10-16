<template>
  <table class="table table-striped table-hover table-sm mt-4">
    <thead class="bg-dark text-white text-center">
      <tr>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>apellido</th>
        <th>Genero</th>
        <th v-if="isAdmin">Rol</th>
        <th>Opciones</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="user in users" :key="user.identificador" class="text-center">
        <td>{{ user.cedula }}</td>
        <td>{{ user.nombre }}</td>
        <td>{{ user.apellido }}</td>
        <td>
          <span v-if="user.sexo === 'F'">Femenino</span>
          <span v-else>Masculino</span>
        </td>
        <td v-if="isAdmin">
          <span v-if="user.esAdministrador">Profesor</span>
          <span v-else>Ténico</span>
        </td>
        <td>
          <a class="btn-sm">
            <small>
              <i
                :id="user.cedula"
                @click.prevent="edit(user.cedula)"
                class="fas fa-pen"
                style="cursor: pointer;"
              ></i>
            </small>
          </a>
          <a class="btn-sm">
            <small>
              <i
                @click.prevent="destroy(user.identificador)"
                :id="user.cedula"
                class="fas "
                :class="{'text-danger fa-user-slash': user.fechaEliminacion == null,'text-success fa-user':user.fechaEliminacion!==null}"
                style="cursor: pointer;"
              ></i>
            </small>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "user-list",
  props: ["users", "edit", "destroy"],
  data() {
    return {
      isAdmin: this.$session.get("isAdmin")
    };
  }
};
</script>