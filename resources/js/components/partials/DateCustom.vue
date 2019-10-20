<template>
  <div v-if="isAdmin" class="form-group">
    <label>Fecha Personalizada</label>
    <input type="date" class="form-control" @change="setDate" v-model="dateCustom"/>
  </div>
</template>

<script>
	export default {
    name: 'date-custom',
    props: ['users'],
		data(){
			return {
				dateCustom: '',
				isAdmin: this.$session.get('isAdmin')
			}
		},
		methods:{
			setDate(event){
        eventBus.$emit('date-custom', this.dateCustom)
      },
		},
    mounted(){
      //
    }
	}
</script>