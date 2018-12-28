<template>
	<div class="container-fluid">
		<div class="row">
			<widget type="pendientes" icon="exclamation-triangle"></widget>
			<widget type="revisados" icon="wrench"></widget>	
			<widget type="entregados" icon="check-double"></widget>
		</div>
	</div>
</template>

<script>
	import Widget from '../partials/Widget'
	export default {
		name: 'dashboard',
		components: {
			Widget,
		},
		mounted(){
			this.getOrders()
		},
		methods: {
			getOrders(){
				axios
        .get("api/orders", {
            headers: {
              'Authorization': `Bearer ${this.$session.get('token')}`
            }
          })
          .then(response => (
              console.log(response.data.data)
            ))
          .catch(error => {
            console.log(error)
          });
			}
		}
	}
</script>

<style>
</style>