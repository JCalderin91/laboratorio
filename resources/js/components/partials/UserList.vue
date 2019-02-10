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
          <a class="btn-sm" title="Editar usuario">
            <small>
              <i
                :id="user.cedula"
                @click.prevent="edit(user.cedula)"
                class="fas fa-pen"
                style="cursor: pointer;"
              ></i>
            </small>
          </a>
          <a class="btn-sm" title="Eliminar usuario">
            <small>
              <i
                :id="user.cedula"
                class="fas fa-trash text-danger"
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
  props: ["users", "edit"],
  data() {
    return {
      isAdmin: this.$session.get("isAdmin")
    };
  }
};
</script>