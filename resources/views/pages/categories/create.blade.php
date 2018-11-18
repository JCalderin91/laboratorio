@extends('layouts.app')

@section('title')| Registrar una nueva categoria @endsection

@section('content')

	<div class="card">
		<div class="header">
			<h2 class="panel-title">Registrar nueva categoria</h2>
			<p>Registre los datos de un nueva categoria en nuestro sistema</p>
		</div>
		<div class="body">
			<form method="POST" action="{{ route('categories.store') }}"  role="form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group form-float">
				            <div class="form-line">
				                <input type="text" class="form-control" name="name" required>
				                <label class="form-label">Nombre</label>
				            </div>
				        </div>
					</div>
					<div class="col-md-12">
	                    <div class="form-group justify-between">
	                        <a href="{{ route('categories.index') }}" class="btn btn-primary waves-effect">
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