@extends('layouts.app')

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
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif

<div class="card">
	<div class="header">
		<a href="{{ route('categories.create') }}" class="btn btn-primary waves-effect pull-right" title="Agregar nuevo cliente">
			<i class="material-icons">add_circle</i>
		</a>
		<h3>Lista de categorias</h3>
		<p>Lista de las categorias de los equipos</p>
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
                        <th class="text-center">Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->name }}</td>
                        <td>
                        	<a href="{{route('categories.edit','categorie->id')}}" title="Editar" class="btn bg-blue waves-effect">
                                <i class="material-icons">create</i>
                            </a>
                            <button title="Borrar" data-toggle="modal" data-target="#delete" type="button" class="btn bg-red waves-effect">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
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
                <button type="button" class="btn btn-link waves-effect">CONTINUAR</button>
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