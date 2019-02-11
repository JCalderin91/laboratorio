<template>
	<div>    
      <div class="form-group">
        <label>Cedula</label>
        <select class="custom-select" required @change="setNameUser" v-model="idUser">
          <option value="">Selecione una cedula</option>
          <option v-for="user in users" :value="user.identificador">{{ user.cedula }}</option>
        </select>
      </div>

      <div class="form-group">
        <label>Datos</label>
        <input disabled type="text" class="form-control" v-model="nameUser" required>   
      </div>
  </div>
</template>

<script>
	export default {
		name: 'set-user',
		props: ['users'],
		data(){
			return {
				idUser: '',
				nameUser: ''
			}
		},
		methods:{
			setNameUser(event){
        for (let i = 0; i <= this.users.length; i++) {
          if (this.users[i].identificador == this.idUser) {
            this.nameUser = this.users[i].apellido+', '+this.users[i].nombre
            this.idUser = this.users[i].identificador
            eventBus.$emit('idUser', this.users[i].identificador)
            break
          }
        } 
      },
		},
    mounted(){
      eventBus.$on('unsetUser', (value) => {
        this.nameUser = value
        this.idUser = value
      })
    }
	}
</script>