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

          <div class="col-6 d-flex align-items-end">
            <div class="form-group">
              <button 
                @click="editPass"
                class="btn"
                :class="{'btn-info':!changePassword, 'btn-danger':changePassword}">
                {{ (changePassword)?'Cancelar cambio':'Cambiar contraseña'}}
              </button>
            </div>
          </div>

          <div v-if="changePassword" class="col-md-6">
            <div class="form-group">
              <label>Ingrese su contraseña actual <i v-if="loader" class="fas fa-spinner spin"></i></label>
              <input
                @keyup="verificar"
                placeholder="Contraseña"
                v-model="editAccount.contrasena_actual"
                type="password"
                class="form-control">
                <message-error :message="errors.contrasena_actual"></message-error>  
            </div>
          </div>

          <div class="col-6"></div>

          <div v-if="virified" class="col-md-6">
            <div class="form-group">
              <label>Nueva contraseña</label>
              <input
                v-model="editAccount.contrasena"
                placeholder="Nueva contraseña"
                type="password"
                :class="[ varifyPass == true  ? 'is-valid' : 'is-invalid' ]"
                class="form-control">
                <message-error :message="errors.contrasena"></message-error>  
            </div>
          </div>

          <div v-if="virified" class="col-md-6">
            <div class="form-group">
              <label>Confirmar contraseña</label>
              <input
                v-model="editAccount.confirmacion"
                placeholder="Confirmar contraseña"
                type="password"
                :class="[ varifyPass == true ? 'is-valid' : 'is-invalid' ]"
                class="form-control">
                <message-error :message="errors.confirmacion"></message-error>  
            </div>
          </div>
            
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <button @click.prevent="cancelEdit()" class="m-1 btn btn-light">Cancelar</button>
              <button @click.prevent="saveAccount()" class="m-1 btn btn-success">Guardar</button>
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
            <tr :key="key" v-for="(acount, key) in accounts" class="text-center">
              <td>
                <span>{{ acount.usuario }}</span>                
              </td>
              <td>
                <span id="prof" style="width: 100%;">*********</span>                
               </td>
               <td>
                  <a
                    @click.prevent="editHandler(acount)"
                    title="Editar cuenta"
                    class="text-dark">  
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
  import MessageError from '../partials/messageError'

  export default {
    components: {
      MessageError
    },
    name: 'configurations',
    data() {
      return {
        accounts: '',
        editing: false,
        loader: false,
        virified: false,
        changePassword: false,
        editAccount: {},
        errors: []
      } 
    },
    mounted(){
      this.getAccounts()
    },
    methods: {
      verificar(user) {
        let current_password = this.editAccount.contrasena_actual
        let cant = this.editAccount.contrasena_actual.length
        if(cant >= 5) {
          this.loader = true
          axios
            .post("/api/check-password/"+this.editAccount.identificador, {current_password} )
            .then(response => {
              this.virified = response.data
            })
            .catch(error => {console.log(error)})
            .then(()=>{this.loader = false})
        }else{
          this.virified = false
        }
      },
      editPass() {
        this.changePassword = !this.changePassword
        if(!this.changePassword){
          this.virified = false
          this.editAccount.contrasena_actual = ''
        }
        
      },
      editHandler(user) {
        this.editing = true
        this.editAccount = JSON.parse(JSON.stringify(user))
      },
      cancelEdit() {
        this.editing = false
        this.editAccount = {}
      },
      getAccounts(){
        this.$emit("loading-data", true);
        axios
          .get("/api/accounts")
          .then(response => {this.accounts = response.data.data})
          .catch(error => {console.log(error)})
          .then(()=>{this.$emit("loading-data", false)})
      },
      saveAccount(){
        this.$emit("loading-data", true);
        axios
          .put("/api/accounts/"+this.editAccount.identificador, this.editAccount)
             .then((response) => {    
                this.getAccounts()
                this.editing = false
                this.changePassword = false
                this.virified = false
                this.editAccount.contrasena_actual = ''
              })
              .catch((error) => {
                  // Error
                  if (error.response) {
                    this.errors = error.response.data.error
                  } else if (error.request) {
                      console.log(error.request);
                  } else {
                      console.log('Error', error.message);
                  }
            })
            .then(()=>{this.$emit("loading-data", false)})
      }
    },
    computed: {
      varifyPass: function () {
        if(this.editAccount.contrasena === this.editAccount.confirmacion && this.editAccount.contrasena && this.editAccount.contrasena != ''){
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
  .spin{
    animation-name: spin;
    animation-duration: 1.3s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
  }
  @keyframes spin {
    from {
      transform: rotate(0deg);
    }
    to{
      transform: rotate(360deg);
    }  
  }
</style>