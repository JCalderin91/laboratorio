<template>
  <div class="card" style="margin-right: 10px;">
    <h4>Reportes y estadisticas</h4>
    <form @submit.prevent="getReport" action="post">
      <div class="row mt-3">

        <div class="col-12 d-flex justify-content-around mb-3">
          <div class="custom-control custom-radio mr-2">
            <input v-model="type" value="today" type="radio" class="custom-control-input" id="today">
            <label class="custom-control-label" for="today">Hoy</label>
          </div>

          <div class="custom-control custom-radio mr-2">
            <input v-model="type" value="current_month" type="radio" class="custom-control-input" id="current_month">
            <label class="custom-control-label" for="current_month">Mes actual</label>
          </div>

          <div class="custom-control custom-radio mr-2">
            <input v-model="type" value="last_month" type="radio" class="custom-control-input" id="last_month">
            <label class="custom-control-label" for="last_month">Mes anterior</label>
          </div>

          <div class="custom-control custom-radio mr-2">
            <input v-model="type" value="range" type="radio" class="custom-control-input" id="range">
            <label class="custom-control-label" for="range">Rango de fechas</label>
          </div>
        </div>				
                
        <div class="col-md-6" v-if="type=='range'">
          <div class="form-group">
            <label>Fecha inicial</label>
            <input v-model="from" type="date" class="form-control" placeholder="Seleccione una fecha" required>
          </div>
        </div>

        <div class="col-md-6" v-if="type=='range'">
          <div class="form-group">
            <label>Fecha Final</label>
            <input v-model="to" type="date" class="form-control" placeholder="Selecione una fecha" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="">Usuario resposable de las ordenes</label>
            <select @change="changeUser" v-model="user_id" name="" id="" class="custom-select" required>
              <option value="">seleccione un usuario</option>
              <option value="all">Todos</option>
              <option :key="key" v-for="(user, key) in users" :value="user.identificador">{{user.cedula}} - {{ user.nombre }}</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Estado de orden</label>
            <select v-model="status" name="" id="" class="custom-select" required>
              <option value="">Seleccione un estado</option>
              <option :key="key" v-for="(item, key) in statuses" :value="item.value">{{ item.name }}</option>
            </select>
          </div>
        </div>

      </div>
      <button type="submit" class="btn btn-success float-right">Consultar</button>
    </form>

    <div class="mt-3">
      <div class="table-responsive">
        <table class="table table-bordered text-center table-sm">
          <thead class="bg-dark text-white">
            <tr>
              <th>Estado Orden</th>
              <th>Fecha</th>
              <th>Técnico</th>
              <th>Cedula del cliente</th>
              <th>Nombre del cliente</th>
              <th>Dispositivo</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Bien nacional</th>
              <th>Estado de dispositivo</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!reports">
              <td colspan="10">No se encontraron resultados</td>
            </tr>
            <tr v-else :key="key" v-for="(report, key) in reports">
              <td>
                <span v-if="report.estado === 'pendiente'">Pendiente</span>
                <span v-else-if="report.estado === 'revisado'">Revisado</span>
                <span v-else>Entregado</span>
              </td>
              <td>{{report.fechaCreacion}}</td>

              <td>
                <span v-if="report.reparacion">{{report.reparacion.data.tecnico.data.cedula}}</span>
                <span v-else>{{report.tecnico.data.cedula}}</span>
              </td>

              <td>{{report.cliente.data.cedula}}</td>
              <td>{{report.cliente.data.nombres}} {{report.cliente.data.apellidos}}</td>
              <td>{{report.equipo.data.nombre}}</td>
              <td>{{report.equipo.data.marca}}</td>
              <td>{{report.equipo.data.modelo}}</td>
              <td> 
                <span v-if="report.equipo.data.bienNacional">{{report.equipo.data.bienNacional}}</span>
                <span v-else>Propio</span>
              </td>

              <td>
                <div v-if="report.reparacion">
                  <span v-if="report.reparacion.data.estado === 'repaired' ">Reparado</span>
                  <span v-else>Sin reparación</span>
                </div>
                <span v-else>No revisado</span>
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
    name: 'users',
    data() {
      return {
        from: '',
        to: '',
        status: '',
        user_id: '',
        type: 'today',
        filter_by: 'user',
        users: '',
        reports: [],
        statuses: []
      }
    },
    mounted() {
      this.getUsers()
    },
    methods: {
      getUsers() {
        axios
          .get("/api/users")
          .then(response => {
            this.users = response.data.data
          })
          .catch(error => {
            console.log(error)
          });
      },
      changeUser() {
        if (this.user_id == 'all') {
          this.filter_by = 'orders'
          this.statuses = [{
              value: 'pendiente',
              name: 'Pendiente'
            },
            {
              value: 'revisado',
              name: 'Revisado'
            },
            {
              value: 'entregado',
              name: 'Entregado'
            },
          ]
        } else {
          this.filter_by = 'user'
          this.statuses = [{
              value: 'pendiente',
              name: 'Recibidos'
            },
            {
              value: 'revisado',
              name: 'Revisados'
            },
            {
              value: 'entregado',
              name: 'Entregados'
            },
          ]

        }
      },
      getReport() {
        let filters = {
          from: this.from + ' 00:00',
          to: this.to + ' 24:00',
          status: this.status,
          user_id: this.user_id,
          filter_by: this.filter_by,
          type: this.type,
        }
        axios
          .post("api/reports", filters)
          .then(response => {
            this.reports = response.data.data
          })
          .catch(error => console.log(error))
      },
    }
  }
</script>

<style></style>