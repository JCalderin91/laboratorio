<template>
	<div class="row m-2 ">
		<div class="form-group col-12">
			<input type="text" class="form-control" placeholder="Nombre de la dirección">
		</div>
		<div class="form-group col-12 d-flex justify-content-end">
			<a @click.prevent="newAddress" href="" class="btn m-2 btn-secondary">Cancelar</a>

			<a @click.prevent="newAddress" href="" class="btn m-2 btn-primary">Guardar</a>	
		</div>
		
	</div>
</template>

<script>
	export default {
		name: 'new-address',
		props: ['newAddress']
	}
</script>