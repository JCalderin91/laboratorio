<template>
	<div class="card">
    <h2>Reportes y estadisticas</h2>
    <h6></h6>
    <form @submit.prevent="getReport" action="post">
	    <div class="row mt-3">
	    	<div class="col-md-6">
					<div class="form-group">
						<label >Fecha inicial</label>
						<input v-model="from" type="date" class="form-control" placeholder="Seleccione una fecha" required>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label >Fecha Final</label>
						<input v-model="to" type="date" class="form-control" placeholder="Selecione una fecha" required>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="">Usuario resposable de las ordenes</label>
						<select @change="changeUser" v-model="user_id" name="" id="" class="form-control" required>
							<option value="">seleccione un usuario</option>
							<option value="all">Todos</option>
							<option v-for="user in users" :value="user.identificador">{{user.cedula}} - {{ user.nombre }}</option>
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Estado de orden</label>
						<select v-model="status" name="" id="" class="form-control" required>
							<option value="">Seleccione un estado</option>
							<option v-for="item in statuses" :value="item.value">{{ item.name }}</option>
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
								<th>Dispositivo</th>
								<th>Estado de dispositivo</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="report in reports">
								<td>{{report.estado}}</td>
								<td>{{report.fechaCreacion}}</td>
	
								<td v-if="report.reparacion" >{{report.reparacion.data.tecnico}}</td>
								<td v-else >{{report.tecnico.data.cedula}}</td>

								<td>{{report.cliente.data.cedula}}</td>
								<td>{{report.equipo.data.nombre}}</td>

								<td v-if="report.reparacion" >{{report.reparacion.data.estado}}</td>
								<td v-else >No revisado</td>

							</tr>
						</tbody>
					</table>
				</div>				
			</div>

	<pre>{{$data}}</pre>
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
				statuses:[]
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
      changeUser(){
      	if (this.user_id == 'all') {
      		this.statuses = [
						{value:'pending',name:'Pendiente'},
						{value:'revised',name:'Revisado'},
						{value:'delivered',name:'Entregado'},
					]
      	} else {
      		this.statuses = [
						{value:'pending',name:'Recibidos'},
						{value:'revised',name:'Revisados'},
						{value:'delivered',name:'Entregados'},
					]

      	}
      },
			getReport(){
				if(this.user_id=='all') this.filter_by='orders'
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