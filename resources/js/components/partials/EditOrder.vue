<template>
	<div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Recepción</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Revición</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Entrega</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		  	<div class="card">
	        <div class="card-header bg-dark">
	          <h6 class="m-0 text-white">
	            Datos del cliente 
	          </h6>
	        </div>
	        <div class="card-body">
	          <div class="row">	       
	            <div class="col-6"><!-- Cedula Nuevo Cliente -->
	              <label>Cédula</label>
	              <div class="input-group">
	                <input
	                	v-model="order.cliente.data.nombres"
	                  type="text"
	                  class="form-control"
	                  placeholder="Cedula del cliente"
	                  aria-label="Cedula del cliente"
	                  disabled
	                  required>
	              </div>
	            </div><!-- Cedula Nuevo Cliente -->

	            <div class="col-6"><!-- Nombres -->
	              <div class="form-group">
	                <label>Nombres</label>
	                <input  type="text" class="form-control" required>
	              </div>
	            </div><!-- Nombres -->

	            <div class="col-6"><!-- Apellidos -->
	              <div class="form-group">
	                <label>Apellidos</label>
	                <input  type="text" class="form-control" required>
	              </div>
	            </div><!-- Apellidos -->

	            <div class="col-6"><!-- Teléfono -->
	              <div class="form-group">
	                <label>Teléfono</label>
	                <input type="text" class="form-control" required>
	              </div>
	            </div><!-- Teléfono -->
	    
	            <div class="col-6"><!-- Direcciones -->
	              <div class="form-group">
	                <label>Direcciones</label>
	                <select class="custom-select"  required>
	                  <option value="">Selecione una dirección</option>
	
	                </select>
	              </div>
	            </div><!-- Direcciones -->

	            <div class="col-6"><!-- Dirección -->
	              <div class="form-group">
	                <label>Dirección</label>
	                <input  type="text" class="form-control" required>
	              </div>
	            </div><!-- Dirección -->
	           
	            <div  class="col-6"><!-- Area -->
	              <div class="form-group" >
	                <label>Área</label>
	                <select class="custom-select" required>
	                  <option value="">Selecione una area</option>
	                </select>
	              </div>
	            </div><!-- Area -->

	            <div class="col-6"><!-- Area -->
	              <div class="form-group">
	                <label>Área</label>
	                <input type="text" class="form-control" required>
	              </div>
	            </div><!-- Area -->
	          </div>
	        </div>
	      </div>
		  	<a @click.prevent="finishEditing" href="#" class="btn btn-success">Guardar</a>
		  </div>
		  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
		  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
		</div>
		<pre>{{$data}}</pre>
	</div>
</template>

<script>
	export default {
		name: 'edit-order',
		props: ['order'],
		data(){
			return {
				data: ''
			}
		},
		mounted(){
			this.data = order
		},

		methods:{
			finishEditing(){
				eventBus.$emit('editingOrder', false).-,
			},			
		},
	}
</script>