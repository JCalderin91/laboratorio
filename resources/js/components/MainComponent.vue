<template>
	<div class="container">
		<h1>Componente contenedor</h1>
		<!-- Dropdown Trigger -->
		  <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>{{ msg }}</a>

		    <div class="input-field col s12">
			    <select>
			      <option value="" disabled selected>Choose your option</option>
			      <option  v-for="dato in datos"  value="1">Option {{ dato.item}}</option>
			    </select>
			    <label>Materialize Select</label>
			  </div>
	</div>
</template>

<script>
	export default {
			name: 'Container',
			data: function () {
			    return {
			      msg: 'Drop Me!',
			      datos: [
			      	{item: '1'},
			      	{item: '2'},
			      	{item: '3'},
			      	{item: '4'},
			      	{item: '5'},
			      	{item: '6'},
			      	{item: '7'},
			      	{item: '8'}
			      ]
			    }
			  },
			mounted() {
					console.log('Component mounted.')
			}
	}
</script>
