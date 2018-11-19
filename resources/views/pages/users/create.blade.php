@extends('layouts.app')

@section('title')| Registrar nuevo usuario @endsection

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
			<h2 class="panel-title">Registrar nuevo usuario</h2>
			<p>Registre un nuevo usuario en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('users.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="ci" required>
				                <label class="form-label">Cedula</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="first_name" required>
				                <label class="form-label">Nombres</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="last_name" required>
				                <label class="form-label">Apellidos</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="password" class="form-control" name="password" required>
				                <label class="form-label">Contraseña</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group">
				            <div class="form-line">
				                <label class="form-label">Genero</label>
				                <select name="gender" class="form-control" required>
									<option value="F">Femenino</option>
									<option value="M">Masculino</option>
								</select> 
				            </div>
				        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group">
				            <div class="form-line">
				                <label class="form-label">Rol</label>
				                <select name="role_id" class="form-control" required>
									<option value="1">Profesor</option>
									<option value="2">Técnico</option>
								</select> 
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
                    <div class="form-group justify-between">
                        <a href="{{ route('users.index') }}" class="btn btn-primary waves-effect">
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