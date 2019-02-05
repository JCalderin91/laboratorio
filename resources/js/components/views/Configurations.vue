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
            </tr>
          </thead>
          <tbody>
            <tr v-for="acount in accounts" class="text-center">
              <td>
                <span v-if="acount.usuario === 'admin'">Profesor</span>
                <span v-else >Técnico</span>
              </td>
              <td>
                <span id="prof" style="width: 100%;">********* </span>
               </td>
            </tr>
            <!-- <tr class="text-center">
              <td>Tecnio</td>
              <td>
                <span id="tec" @dblclick="enableField" style="width: 100%;">********* </span>
                <input class="text-center" id="tec" type="password" name="pass" value="1234" style="display: none">
              </td>
              <td></td>
            </tr> -->
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
        accounts: ''
      }
    },
    mounted(){
      this.getAccounts()
    },
    methods: {
      enableField(e) {
        document.querySelector('span#'+e.target.id).style.display = 'none'
        let input = document.querySelector('input#'+e.target.id)
        input.style.display = 'inherit'
        input.focus()
        input.select()
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
  input {
    background: white;
    border: none;
    border-bottom: 1px solid grey;
    width: 50%;
  }
</style>