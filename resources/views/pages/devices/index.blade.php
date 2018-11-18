@extends('layouts.app')

@section('title')| Lista de dispositivos @endsection

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
<div class="alert alert-success notification">
    <span>{{Session::get('success')}}</span>   
</div>
@endif

<div class="card">
	<div class="header">
		<h3>Lista de Equipos</h3>
		<p>Lista de los equipos en el sistema</p>
	</div>
	<div class="body">
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center datatable">
                <thead class="bg-blue">
                    <tr>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        @if(Auth::user()->role_id == 1)
                        <th class="text-center">Estado</th>
                        <th data-priority="1" class="text-center">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tfoot >
                    <tr class="text-center">
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        @if(Auth::user()->role_id == 1)
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acción</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($devices as $device)    
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td>{{ $device->brand->title }}</td>
                        <td>{{ $device->subDevice->name }}</td>
                        @if(Auth::user()->role_id == 1)
                        <td>
                            @if($device->status == 'ACTIVE')
                            <div class="badge bg-green">Activo</div>
                            @else
                            <div class="badge bg-gray">Inactivo</div>
                            @endif
                        </td>
                        <td>
                            <a title="Editar" href="{{ route('devices.edit', $device->id) }}" class="btn bg-blue waves-effect">
                                <i class="material-icons">create</i>
                            </a>
                            @if($device->status == 'ACTIVE')
                                <button data-title="-" data-id="{{ $device->id }}" title="Desactivar"
                                    data-toggle="modal" data-target="#disable" type="button" class="btn bg-red waves-effect">
                                    <i class="material-icons">lock_outline</i>
                                </button>
                            @else
                                <button data-title="-" data-id="{{ $device->id }}" title="Hablitar"
                                    data-toggle="modal" data-target="#enable" type="button" class="btn bg-green waves-effect">
                                    <i class="material-icons">lock_open</i>
                                </button>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>

<!-- DISABLE -->
<div class="modal fade" id="disable" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-red">
            <form action="{{ route('devices.destroy','test') }}" method="POST">
                {{method_field('delete')}}
                @csrf
                <div class="modal-header ">
                    <h2 class="modal-title" id="deleteLabel">Advertencia</h2>
                </div>
                <div class="modal-body">
                    Esta seguro de querer deshabilitar este dispositivo?
                    <input type="hidden" name="id" value="" id="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">CONTINUAR</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ENABLE -->
<div class="modal fade" id="enable" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-green">
            <form action="{{ route('devices.destroy','test') }}" method="POST">
                {{method_field('delete')}}
                @csrf
                <div class="modal-header ">
                    <h2 class="modal-title" id="deleteLabel">Advertencia</h2>
                </div>
                <div class="modal-body">
                    Esta seguro de querer hablitar este dispositivo?
                    <input type="hidden" name="id" value="" id="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">CONTINUAR</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $('.datatable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            order: [[ 1, 'asc' ]],
            ordering: true,
            lengthChange: false
        });
    </script>
@endsection
