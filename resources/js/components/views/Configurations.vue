<template>
	<div class="card col-11" style="margin: 10px;">
		<div class="card-content row">

			<div class="card-title col-12 p-0">
				<h4 >Configuraciones del sistema</h4>
			</div>
			<div class="card-body p-0">
				<table class="table">
        	<thead class="thead-dark">
        		<tr>
        			<th>Tipo de usuario</th>
        			<th>Contraseña</th>
        			<th>Acción</th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr>
        			<td>Profesor</td>
        			<td>*********</td>
        			<td></td>
        		</tr>
        		<tr>
        			<td>Técnico</td>
        			<td>*********</td>
        			<td></td>
        		</tr>
        	</tbody>
        </table>
			</div>
			
		</div>
	</div>
</template>

<script>
	export default {
		name: 'configurations',
		data() {
			return {
        ci: ''
			}
		}
	}
</script>

<style></style>