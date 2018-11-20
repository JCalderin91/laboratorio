@extends('layouts.app')

@section('title')| Realizar orden de registro @endsection

@section('styles')
<style>

</style>
@endsection()

@section('content')
<div class="card">
    <div class="header">
        <h2 class="panel-title">Nueva Orden de Servicio</h2>
        <p>Registre los datos de una nueva Orden de Servicio en nuestro sistema</p>
    </div>
    <div class="body">
        <form method="POST" action="{{ route('clients.store') }}" role="form">
            {{ csrf_field() }}

            {{-- datos del cliente --}}
            <div class="row">
                <div class="col-md-12">
                    <h4>Datos del Cliente</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line autocomplete">
                            <input id="myInput" class="form-control" type="text" name="myCountry">
                            <label class="form-label">Cedula</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="first_name" required>
                            <label class="form-label">Nombre</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="last_name" required>
                            <label class="form-label">Apellido</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-10" style="padding-right: 0;">
                        <div class="form-group form-float ">
                            <div class="form-line">
                                <input type="text" class="form-control" name="area_name" required>
                                <label class="form-label">Area</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-2" style="padding: 0;">
                        <div class="dropdown">
                            <button class="btn btn-block btn-default wave-efect dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="caret"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="phone" required>
                            <label class="form-label">Direcci&oacute;n</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="phone" required>
                            <label class="form-label">Teléfono de Contacto</label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin datos del cliente --}}

            {{-- datos del equipo --}}

            <div class="row">
                <div class="col-md-12">
                    <h4>Datos del Equipo</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="brand_id" required>
                            <label class="form-label">Marca</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="last_name" required>
                            <label class="form-label">Modelo</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-right: 0;">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="area_name" required>
                            <label class="form-label">Serial</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" name="phone" required>
                            <label class="form-label">Bien Nacional</label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin datos del equipo --}}

            {{-- botones --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-float justify-between">
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
@section('script')
<script>
  var cis = {!! $cis !!};  
    autocomplete(document.getElementById("myInput"), cis);
</script>
@endsection