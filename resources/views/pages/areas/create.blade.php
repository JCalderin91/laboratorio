@extends('layouts.app')

@section('title')| Registrar una nueva area @endsection

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
			<h2 class="panel-title">Registrar una nueva area</h2>
			<p>Registre los datos de una nueva area en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('areas.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">

					<div class="col-md-6">
		        <div class="form-group form-float">
		            <select name="address_id"  class="form-control show-tick" data-live-search="true" required>
		            	<option selected="true" value="">Seleccione una Direcci&oacute;n</option>
		            	@foreach($addresses as $address)
		            	<option value="{{ $address->id }}">{{ $address->name }}</option>
		            	@endforeach
		            	{{-- <option value="new_address">Nueva Direcci&oacute;n</option>  --}}
					</select> 
		        </div>
					</div>
					<div class="col-md-6">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="name" required>
				                <label class="form-label">Titulo de el area</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
		                <div class="form-group justify-between">
		                    <a href="{{ route('areas.index') }}" class="btn btn-primary waves-effect">
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

@section("script")
<script type="text/javascript">
	document.querySelector("select").addEventListener("change", (e) => {
		if (e.target.value == "new_address") {
			window.location = "/addresses/create"
		}
	})
</script>
@endsection