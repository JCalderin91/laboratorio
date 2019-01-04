<template>
	<div class="card">
    <h2>Reportes y estadisticas</h2>
    <h6></h6>
    <form @submit.prevent="getReport" action="post">
	    <div class="row mt-3">
	    	<div class="col-md-6">
					<div class="form-group">
						<label >Fecha inicial</label>
						<input v-model="from" type="date" class="form-control" placeholder="Seleccione una fecha">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label >Fecha Final</label>
						<input v-model="to" type="date" class="form-control" placeholder="Selecione una fecha">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Estado de orden</label>
						<select v-model="status" name="" id="" class="form-control">
							<option value="">Seleccione un estado</option>
							<option value="all">Todos</option>
							<option value="pending">Pendiente</option>
							<option value="repair">Reparado</option>
							<option value="delivered">Entregado</option>
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="">Usuario resposable de las ordenes</label>
						<select v-model="user_id" name="" id="" class="form-control">
							<option value="">seleccione un usuario</option>
							<option value="all">Todos</option>
							<option v-for="user in users" :value="user.identificador">{{user.cedula}} - {{ user.nombre }}</option>
						</select>
					</div>
				</div>
	    </div>
	    <button type="submit" class="btn btn-success">Consultar</button>
		</form>

			<div v-if="reports != ''" class="row">
				<div class="col-12 mt-3">
					<table class="table">
						<thead>
							<tr>
								<th>Estado Orden</th>
								<th>Fecha</th>
								<th>Técnico</th>
								<th>Cliente</th>
								<th>Equipo</th>
								<th v-if="status != 'pending'">Estado dispositivo</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="report in reports">
								<td>{{report.estado}}</td>
								<td>{{report.fechaCreacion}}</td>
								<td>{{report.tecnico.data.cedula}}</td>
								<td>{{report.cliente.data.cedula}}</td>
								<td>{{report.equipo.data.nombre}}</td>
								<td v-if="status != 'pending'">{{report.reparacion.data.estado}}</td>
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
				from:'',			
				to:'',			
				status:'',			
				user_id:'',	
				filter_by: 'user',
				users:'',
				reports:'',
			}
		},
		mounted(){
			this.getUsers()
		},
		methods: {
			getUsers(){
        axios
        .get("/api/users", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => {
            this.users = response.data.data
          })
          .catch(error => (
            console.log(error)
          ));
      },
			getReport(){
				if(this.users=='all') this.filter_by='order'
        axios
        .post("api/reports", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            },
            from: this.from+' 00:00',
						to: this.to+' 24:00',
						status: this.status,
						user_id: this.user_id,
						filter_by: this.filter_by,
          })
          .then(response => {
            this.reports = response.data.data
          })
          .catch(error => (
            console.log(error)
          ));
      },
		}
	}
</script>

<style></style>