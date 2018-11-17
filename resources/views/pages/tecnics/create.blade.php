@extends('layouts.app')

@section('content')


	<div class="card">
		<div class="header">
			<h2 class="panel-title">Registrar nuevo técnico</h2>
			<p>Registre un nuevo técnico en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('users.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="id" required>
				                <label class="form-label">Dni</label>
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