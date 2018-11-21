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
                            <input id="ci" class="form-control" type="text" name="ci">
                            <label class="form-label">Cedula</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" id="first_name" name="first_name" required disabled>
                            <label class="form-label">Nombre</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                            <label class="form-label">Apellido</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" id="address" name="address" required>
                            <label class="form-label">Direcci&oacute;n</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line autocomplete">
                            <input id="area_name" class="form-control" type="text" name="area_name">
                            <label class="form-label">Area</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <input type="text" class="form-control" id="phone" name="phone" required>
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
                        <div class="form-line autocomplete">
                            <input id="brand" class="form-control" type="text" name="brand">
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

            {{-- Observaciones de orden --}}
            <div class="row clearfix">
                <div class="col-md-12">
                    <h4>Observaciones</h4>
                </div>

                <div class="col-md-12">
                    <div class="form-group form-float ">
                        <div class="form-line">
                            <textarea rows="4" class="form-control no-resize" placeholder="Observaciones preliminares"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin Observaciones de orden --}}

            {{-- Selecionar usuario --}}
            <div class="row">
                <div class="col-md-12">
                    <select class="form-control show-tick">
                        <option value="">-- Seleccione --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->ci }}">{{ $user->ci }} - {{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Fin selecionar usuario --}}

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
    autocomplete(document.getElementById("ci"), {!!$cis!!});

    autocomplete(document.getElementById("area_name"), {!!$areas_name!!});

    autocomplete(document.getElementById("brand"), {!!$brands_name!!});

    autocomplete(document.getElementById("address"), {!!$addresses_name!!});
</script>
@endsection
