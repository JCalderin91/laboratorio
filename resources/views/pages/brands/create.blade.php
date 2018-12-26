@extends('layouts.app')

@section('title')| Registrar una nueva marca @endsection

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
			<h2 class="panel-title">Registrar una nueva marca</h2>
			<p>Registre los datos de una nueva marca en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('brands.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="title" required>
				                <label class="form-label">Titulo de la marca</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
		                <div class="form-group justify-between">
		                    <a href="{{ route('brands.index') }}" class="btn btn-primary waves-effect">
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