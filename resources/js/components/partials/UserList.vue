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
        <td>{{ user.nombres }}</td>
        <td>{{ user.apellidos }}</td>
        <td>
          <span v-if="user.sexo === 'F'">Femenino</span>
          <span v-else>Masculino</span>
        </td>
        <td v-if="isAdmin">
          <span v-if="user.esAdministrador">Profesor</span>
          <span v-else>Ténico</span>
        </td>
        <td>
          <a class="btn btn-info" title="Editar usuario">
            <i
                :id="user.cedula"
                @click.prevent="edit(user.cedula)"
                class="fas fa-pen text-white"
              ></i>
          </a>
          <a class="btn btn-danger" title="Eliminar usuario">
            <i :id="user.cedula" class="fas fa-trash text-white"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "user-list",
  props: ["users", "edit"],
  data() {
    return {
      isAdmin: this.$session.get("isAdmin")
    };
  }
};
</script>