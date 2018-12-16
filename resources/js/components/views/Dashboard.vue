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
		}
	}
</script>

<style>
</style>