@extends('layouts.app')

@section('content')


@if(Session::has('success'))
    <div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        El area ha sido almacenada satisfactoriamente
    </div>
@endif


<div class="card">
	<div class="header">
		<a href="{{ route('areas.create') }}" class="btn btn-primary waves-effect pull-right" title="Agregar nueva area">
			<i class="material-icons">add_circle</i>
		</a>
		<h3>Lista de areas o dependencias</h3>
		<p>Lista de las areas o dependencias a la cuales pertenecen los clientes</p>
	</div>
	<div class="body">
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center datatable">
                <thead class="bg-blue">
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tfoot >
                    <tr class="text-center">
                        <th class="text-center">Nombre</th>
                        @if(Auth::user()->role_id == 1)
                        <th class="text-center">Acción</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($areas as $area)
                    <tr>
                        <td>{{ $area->name }}</td>
                        @if(Auth::user()->role_id == 1)
                        <td>
                            <a title="Editar" href="{{ route('areas.edit', $area->id) }}" class="btn bg-blue waves-effect">
                                <i class="material-icons">create</i>
                            </a>
                            @if($area->status == 'ACTIVE')
                                <button data-title="{{ $area->name }}" data-id="{{ $area->id }}" title="Desactivar"
                                    data-toggle="modal" data-target="#disable" type="button" class="btn bg-red waves-effect">
                                    <i class="material-icons">lock_outline</i>
                                </button>
                            @else
                                <button data-title="{{ $area->name }}" data-id="{{ $area->id }}" title="Hablitar"
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

<!-- Small Size -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-red">
            <div class="modal-header ">
                <h2 class="modal-title" id="deleteLabel">Advertencia</h2>
            </div>
            <div class="modal-body">
                Esta seguro de querer eliminar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" onclick="delete();" class="btn btn-link waves-effect">CONTINUAR</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
            </div>
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
        order: [[ 0, 'asc' ]],
        ordering: true,
        lengthChange: false
    });
</script>
@endsection