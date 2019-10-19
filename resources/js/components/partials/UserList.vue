<template>
  <table class="table table-bordered table-hover table-sm mt-4">
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
        <td>{{ (user.sexo === 'F'?'Femenino':'Masculino') }}</td>
        <td v-if="isAdmin">{{ (user.esAdministrador) ? 'Profesor' : 'Técnico' }}</td>
        <td>
          <button @click.prevent="edit(user.cedula)" class="btn btn-sm" title="Editar">
            <i class="fas fa-pen"></i>
          </button>
          <button @click="destroy(user.identificador)" class="btn btn-sm" title="Eliminar">
            <i class="fas"
              :class="{'text-danger fa-user-slash': user.fechaEliminacion == null,'text-success fa-user':user.fechaEliminacion!==null}"></i>
          </button>
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
  },

};
</script>