<template>
  <div class="card col-11" style="margin: 10px;">
    <div class="card-content row">

      <div class="card-title col-12 p-0">
        <h4 >Configuraciones del sistema</h4>
      </div>
      <div class="card-body p-0">
        <h5 v-if="!editing" >Cuentas registradas</h5> 
        <h5 v-else >Editar cuenta</h5> 

        <div v-if="editing" class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nombre de usuario</label>
              <input
                placeholder="Nombre de usuario"
                v-model="editAccount.usuario"
                type="text"
                class="form-control">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Contraseña</label>
              <input
                placeholder="Contraseña"
                v-model="editAccount.clave"
                type="password"
                class="form-control">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Nueva contraseña</label>
              <input
                v-model="newPass"
                placeholder="Nueva contraseña"
                type="password"
                :class="[ verifyPassword == true ? 'is-valid' : 'is-invalid' ]"
                class="form-control">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Confirmar contraseña</label>
              <input
                v-model="verifyPass"
                placeholder="Confirmar contraseña"
                type="password"
                :class="[ verifyPassword == true ? 'is-valid' : 'is-invalid' ]"
                class="form-control">
            </div>
          </div>
            
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <button @click.prevent="cancelEdit()" class="m-1 btn btn-secondary">Cancelar</button>
              <button class="m-1 btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
               
        <table v-else class="table table-striped table-hover table-sm">
          <thead class="thead-dark">
            <tr class="text-center">
              <th>Nombre de usuario</th>
              <th>Contraseña</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
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
        },
        verifyPass: '',
        newPass: ''
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
        this.newPass = ''
        this.verifyPass = ''
      },
      getAccounts(){
        axios
          .get("/api/accounts")
          .then(response => {this.accounts = response.data.data})
          .catch(error => {console.log(error)});
      }
    },
    computed: {
      verifyPassword: function () {
        if(this.newPass === this.verifyPass && this.newPass != ''){
          return true
        }
        else{
          return false
        }
      }
    }
  }
</script>

<style scoped>

</style>