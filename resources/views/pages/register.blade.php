@extends('layouts.app')

@section('title')| Realizar orden de registro @endsection

@section('content')
	<div class="card">
		<div class="header">
			<h2 class="panel-title">Nuevo Cliente</h2>
			<p>Registre los datos de un nuevo cliente en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('clients.store') }}"  role="form">
				{{ csrf_field() }}

				{{-- datos del  cliente --}}
				<div class="row">
					<div class="col-md-12">
						<h3>Datos del Cliente</h3>
					</div>
					<div class="col-md-6">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="id" required>
								<label class="form-label">Cedula</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="first_name" required>
								<label class="form-label">Nombre</label>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="last_name" required>
								<label class="form-label">Apellido</label>
							</div>
						</div>
					</div>
					
					<div class="col-md-5" style="padding-right: 0;">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="area_name" required>
								<label class="form-label">Area</label>
							</div>
						</div>
					</div>

					<div class="col-md-1" style="padding: 0;">
							<div class="dropdown">
								<button class="btn btn-block btn-default wave-efect dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="caret"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="phone" required>
								<label class="form-label">Direcci&oacute;n</label>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="phone" required>
								<label class="form-label">Teléfono de Contacto</label>
							</div>
						</div>
					</div>
				</div>
				{{-- fin datos del cliente --}}

				{{-- datos del equipo --}}

				{{-- fin datos del equipo --}}
				
				{{-- botones --}}
				<div class="row">
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
				{{-- fin botones --}}
			</form>
		</div>
	</div>
@endsection