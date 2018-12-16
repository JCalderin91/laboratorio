<template>
	<div class="row">
		<div class="form-group col-6">
			<input type="text" class="form-control" placeholder="Nombre del area">
		</div>
		<div class="form-group col-6">
			<a @click.prevent="newAddress" href="" class="btn btn-danger">Cancelar</a>

			<a @click.prevent="newAddress" href="" class="btn btn-primary">Guardar</a>	
		</div>
		
	</div>
</template>

<script>
	export default {
		name: 'new-address',
		props: ['newAddress']
	}
</script>