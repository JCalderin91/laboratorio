<template>
  <div class="card col-11" style="margin: 10px;">
    <div class="card-content row">

      <div class="card-title col-12 p-0">
        <h4 >Configuraciones del sistema</h4>
      </div>
      <div class="card-body p-0">
        <h5>Cuentas registradas</h5>

        <table class="table table-striped table-hover table-sm">
          <thead class="thead-dark">
            <tr class="text-center">
              <th>Tipo de usuario</th>
              <th>Contraseña</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="editing">
              <td>
                <input :value="editAccount.usuario" type="text" class="form-control w-100">
              </td>
              <td>
                <input :value="editAccount.clave" type="text" class="form-control w-100">
              </td>
              <td class="d-flex justify-content-around">
                <button class="btn btn-success">Guardar</button>
                <button @click.prevent="cancelEdit()" class="btn btn-danger">Cancelar</button>
              </td>
            </tr>
            <tr v-for="acount in accounts" class="text-center">
              <td>
                <span>{{ acount.usuario }}</span>
                
              </td>
              <td>
                <span id="prof" style="width: 100%;">********* </span>
                
               </td>
               <td>
                  <a
                    @click.prevent="editHandler(acount)"
                    title="Editar cuenta"
                    class="text-info">  
                      <small><i class="fas fa-pen" style="cursor: pointer;"></i></small>
                  </a>
               </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'configurations',
    data() {
      return {
        ci: '',
        accounts: '',
        editing: false,
        editAccount: {
          usuario: '',
          clave: '',
        }
      }
    },
    mounted(){
      this.getAccounts()
    },
    methods: {
      editHandler(user) {
        this.editing = true
        this.editAccount.usuario = user.usuario
        this.editAccount.clave = '*******'
      },
      cancelEdit() {
        this.editing = false
        this.editAccount.usuario = ''
        this.editAccount.clave = ''
      },
      getAccounts(){
        axios
          .get("/api/accounts")
          .then(response => {this.accounts = response.data.data})
          .catch(error => {console.log(error)});
      }
    }
  }
</script>

<style scoped>

</style>