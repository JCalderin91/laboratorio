@extends('layouts.app')

@section('title')| Editar un cliente @endsection

@section('content')

	@if (count($errors) > 0)
	<div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
		<strong>Error!</strong> Revise los campos obligatorios.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="card">
		<div class="header">
			<h2 class="panel-title">Modifique los datos del cliente</h2>
			<p>Relize cambios en los datos que usted necesita</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('clients.update', $client->id) }}"  role="form">
			{{ csrf_field() }}
          	<input name="_method" type="hidden" value="PATCH">
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="id" value="{{ $client->id }}" required>
				                <label class="form-label">Cedula</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <select name="area_id"  class="form-control show-tick" data-live-search="true" required> 
					            	<option value="">Seleccione</option>
					            	@foreach($areas as $area)
					            		@if($client->area->name === $area->name )
					            			<option selected value="{{ $area->id }}">{{ $area->name }}</option>
					            		@else
					            			<option value="{{ $area->id }}">{{ $area->name }}</option>
					            		@endif				            	
					            	@endforeach
								</select> 
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="first_name" value="{{ $client->first_name }}" required>
				                <label class="form-label">Nombres</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="last_name" value="{{ $client->last_name }}" required>
				                <label class="form-label">Apellidos</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="phone" value="{{ $client->phone }}" required>
				                <label class="form-label">Teléfono</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
						<div class="form-group justify-between">
		                    <a href="{{ route('clients.index') }}" class="btn btn-primary waves-effect">
								<i class="material-icons">undo</i>
								<span>VOLVER</span>	
							</a>
		                    <button class="btn btn-success waves-effect" type="submit">
								<i class="material-icons">save</i>
								<span>GUARDAR</span>
							</button>
		                </div>
					</div>
				</div>
			</form>
		</div>
	</div>

	

@endsection