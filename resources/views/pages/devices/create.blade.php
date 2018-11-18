@extends('layouts.app')

@section('title')| Registrar un nuevo dispositivo @endsection

@section('content')

	<div class="card">
		<div class="header">
			<h2 class="panel-title">Nuevo equipo</h2>
			<p>Registre los datos de un nuevo equipo en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('devices.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <select name="category_id"  class="form-control show-tick" data-live-search="true" required> 
				            	<option value="">Seleccione</option>
				            	@foreach($categorys as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select> 
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="name" required>
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