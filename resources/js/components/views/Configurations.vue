<template>
  <div class="card col-11" style="margin: 10px;">
    <div class="card-content row">

      <div class="card-title col-12 p-0">
        <h4 >Configuraciones del sistema</h4>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr class="text-center">
              <th>Tipo de usuario</th>
              <th>Contraseña</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr class="text-center">
              <td>Profesor</td>
              <td>
                <span id="prof" @dblclick="enableField" style="width: 100%;">********* </span>
                <input class="text-center" id="prof" type="password" name="pass" value="1234" style="display: none">
              </td>
              <td></td>
            </tr>
            <tr class="text-center">
              <td>Tecnio</td>
              <td>
                <span id="tec" @dblclick="enableField" style="width: 100%;">********* </span>
                <input class="text-center" id="tec" type="password" name="pass" value="1234" style="display: none">
              </td>
              <td></td>
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
        ci: ''
      }
    },
    methods: {
      enableField(e) {
        document.querySelector('span#'+e.target.id).style.display = 'none'
        let input = document.querySelector('input#'+e.target.id)
        input.style.display = 'inherit'
        input.focus()
        input.select()
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