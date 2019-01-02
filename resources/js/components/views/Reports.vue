<template>
	<div class="card">
    <h2>Reportes y estadisticas</h2>
    <h6></h6>
    <div class="row mt-3">
    	<div class="col-md-6">
				<div class="form-group">
					<label >Fecha inicial</label>
					<input v-model="dateStart" type="date" class="form-control" placeholder="Seleccione una fecha">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label >Fecha Final</label>
					<input v-model="dateEnd" type="date" class="form-control" placeholder="Selecione una fecha">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Estado de orden</label>
					<select v-model="state" name="" id="" class="form-control">
						<option value="">Seleccione un estado</option>
						<option value="all">Todos</option>
						<option value="pending">Pendiente</option>
						<option value="repair">Reparado</option>
						<option value="sending">Entregado</option>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="">Usuario resposable de las ordenes</label>
					<select v-model="user" name="" id="" class="form-control">
						<option value="">seleccione un usuario</option>
						<option value="all">Todos</option>
						<option v-for="user in users" :value="user.identificador">{{user.cedula}} - {{ user.nombre }}</option>
					</select>
				</div>
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
				dateStart:'',			
				dateEnd:'',			
				state:'',			
				user:'',	
				users:''		
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
		}
	}
</script>

<style></style>