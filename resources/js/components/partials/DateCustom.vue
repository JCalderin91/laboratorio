<template>
  <div v-if="isAdmin" class="mb-2">
    <label for="dateCustom">Fecha</label>
    <div class="input-group">
      <button  @click.prevent="setStatus" type="submit" class="input-group-prepend btn" :class="{'btn-primary' : disabled, 'btn-danger' : !disabled} ">
        <i class="fas" :class="{'fa-pen' : disabled, 'fa-times' : !disabled} "></i>
      </button>
      <input id="dateCustom" :disabled="disabled" type="date" class="form-control" @change="setDate" v-model="dateCustom" />
    </div>
  </div>
</template>



<script>
	export default {
    name: 'date-custom',
    props: ['users'],
		data(){
			return {
        disabled: true,
				dateCustom: '',
				isAdmin: this.$session.get('isAdmin')
			}
		},
		methods:{
      setStatus(){
        this.disabled = !this.disabled
        if(this.disabled === true){
          this.setToday()
        }
      },
			setDate(event){
        eventBus.$emit('date-custom', this.dateCustom )
      },
      setToday(){
        this.disabled = true
        var today = new Date().toDateInputValue();
        this.dateCustom = today.toISOString().substr(0, 10);
        eventBus.$emit('date-custom', this.dateCustom )
      }
		},
    mounted(){
      this.setToday()
    },
    created(){
      eventBus.$on('modal-state', (value) => {
        this.setToday()
      })
    }
	}
</script>