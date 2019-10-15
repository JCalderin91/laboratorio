<template>
	<div>    
      <div class="form-group">
        <label>Responsables</label>
        <select class="custom-select" required @change="setNameUser" v-model="idUser">
          <option value="">Selecione un responsable</option>
          <option v-for="user in users" :value="user.identificador">{{ user.cedula }} - {{user.apellido}}, {{ user.nombre }}</option>
        </select>
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
        let user = this.users.find(item=>item.identificador === this.idUser)
        this.nameUser = user.nombre+' '+user.apellido
        this.idUser = user.identificador
        eventBus.$emit('idUser', user.identificador)
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