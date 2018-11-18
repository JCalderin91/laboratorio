@extends('layouts.app')

@section('title')| Editar un dispositivo @endsection

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
	@if(Session::has('success'))
	<div class="alert alert-info">
		{{Session::get('success')}}
	</div>
	@endif

	<div class="card">
		<div class="header">
			<h2 class="panel-title">Modifique los datos del dispositivo</h2>
			<p>Relize cambios en los datos que usted necesita</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('client.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <select name="category_id"  class="form-control show-tick" data-live-search="true" required> 
				            	<option value="">Seleccione</option>
							</select> 
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="name" value="Auriculares" required>
				                <label class="form-label">Nombre</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
	                    <div class="form-group justify-between">
	                        <a href="{{ route('devices.index') }}" class="btn btn-primary waves-effect">
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