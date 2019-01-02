<template>
	<div class="card col-11" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4 v-if="!deviceForm">Lista de los dispositivos</h4>
			</div>
			<div class="col-12 row" v-if="!deviceForm">
		
				<input type="text" class="form-control col-4 ml-auto" placeholder="Buscar...">
				<device-list></device-list>
			</div>
		</div>
	</div>
</template>

<script>
	import DeviceList from '../partials/DeviceList'
	export default {
		name: 'devices',
		data() {
			return {
        device: {
          ci: '',
          first_name: '',
          last_name: '',
          phone: '',
          area: '',
          address: '',
        }
			}
		},
		components: {
			DeviceList
		}
	}
</script>

<style></style>