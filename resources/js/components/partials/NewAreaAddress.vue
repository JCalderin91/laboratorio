<template>
	<form class="row m-2" @submit.prevent="saveHandler">
		<div class="form-group col-12">
			<input type="text" class="form-control" :placeholder="placeholder">
		</div>
		<div class="form-group col-12 d-flex justify-content-end">
			<a @click.prevent="cancelHandler" href="" class="btn m-2 btn-secondary">Cancelar</a>

			<a @click.prevent="saveHandler" href="" class="btn m-2 btn-primary">Guardar</a>	
		</div>
		
	</form>
</template>

<script>
	export default {
		name: 'new-area-address',
		props: ['newAddress', 'placeholder', 'cancelHandler', 'saveHandler']
	}
</script>