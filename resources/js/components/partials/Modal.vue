<template>
	<div class="modal-wrapper">
		<div class="modal" id="modal-component" tabindex="-1" role="dialog" style="display: block;">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">{{title}}</h5>
						<button 
							id="close-modal1"
							type="button"
							class="close"
							@click="closeHandler">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<slot></slot>
					</div>
					<div class="modal-footer">
						<button id="close-modal2" type="button" class="btn btn-secondary" @click="closeHandler">Cancelar</button>
						<button type="button" class="btn btn-primary" @click="acceptHandler" >Salir</button>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
</template>

<script>
	export default {
		name: 'modal',
		props: ['title', 'content', 'acceptHandler', 'closeHandler'],
		mounted() {

		}
	}
</script>

<style scoped>
.modal-wrapper {
	height: 100vh;
	width: 100vw;
	background: rgba(0,0,0,0.3);
	z-index: 1000;
	position: fixed;
	top: 0;
	left: 0
}
</style>