@extends('layouts.app')

@section('content')
<!-- Contenido -->
<!-- Widgets -->
<button data-toggle="modal" data-target="#add" type="button" class="btn bg-red waves-effect">
    <i class="material-icons">done</i>
</button>
@include('modals.cliente')


<div class="row clearfix">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">assignment_late</i>
            </div>
            <div class="content">
                <div class="text">PENDIENTES</div>
                <div class="number count-to" data-from="0" data-to="{{$data->pendientes}}" data-speed="1500"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">build</i>
            </div>
            <div class="content">
                <div class="text">REPARADOS</div>
                <div class="number count-to" data-from="0" data-to="{{$data->reparados}}" data-speed="1500"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">done_all</i>
            </div>
            <div class="content">
                <div class="text">ENTREGADOS</div>
                <div class="number count-to" data-from="0" data-to="{{$data->entregados}}" data-speed="1500"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>LISTA DE EQUIPOS</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" title="Restablecer">
                            <i class="material-icons">cached</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center datatable">
                        <thead class="bg-blue">
                            <tr>
                                <th class="text-center">Equipo</th>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th data-priority="1" class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-center">
                                <th class="text-center">Equipo</th>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th data-priority="1" class="text-center">Acción</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->Device->category->name }}</td>
                                <td>{{ $order->client->id }}</td>
                                <td>{{ $order->client->first_name }}</td>
                                <td>{{ $order->arrival_date }}</td>
                                <td>
                                    @switch($order->status)
                                        @case('PENDING')
                                        <div class="badge bg-red">Pendiente</div>
                                        @break

                                        @case('REVISED')
                                        <div class="badge bg-blue">Reparado</div>
                                        @break

                                        @default
                                        <div class="badge bg-green">Entregado</div>
                                    @endswitch
                                </td>
                                <td>
                                    @switch($order->status)
                                        @case('PENDING')
                                        <button title="Reparar" type="button" class="btn bg-orange waves-effect">
                                            <i class="material-icons">build</i>
                                        </button>
                                        @break

                                        @case('REVISED')
                                        <button title="Entregar" type="button" class="btn bg-green waves-effect">
                                            <i class="material-icons">send</i>
                                        </button>
                                        @break

                                        @default
                                        <button title="Ver" type="button" class="btn bg-blue waves-effect">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    @endswitch
                                </td>
                            </tr>
                            @endforeach
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>EQUIPOS</h2>
            </div>
            <div class="body">
                <canvas id="equipos" width="400" height="350"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Contenido -->


@endsection
@section('script')

<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('assets/plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- ChartJs -->
<script src="{{ asset('assets/plugins/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>


<script>
    
    $('.count-to').countTo();

    var ctx = document.getElementById("equipos").getContext('2d');
    var equipos = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Pendientes", "Reparados"],
            datasets: [{
                label: 'Equipos',
                data: [{{ $data->pendientes}},{{ $data->reparados}}],
                backgroundColor: [
                    'rgba(233, 30, 99, 0.9)',
                    'rgba(0, 180, 212, 0.9)'
                ],
                borderColor: [
                    'rgba(233, 30, 99, 1)',
                    'rgba(0, 180, 212, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });

    $.ajax({
        // la URL para la petición
        url: '/ajax',

        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data: {
            id: 123
        },

        // especifica si será una petición POST o GET
        type: 'GET',

        // el tipo de información que se espera de respuesta
        dataType: 'json',

        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
        success: function (json) {
            console.log(json);
        },

        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error: function (xhr, status) {
            console.log('Disculpe, existió un problema: ' + xhr);
        },

        // código a ejecutar sin importar si la petición falló o no
        complete: function (xhr, status) {
            console.log('Petición realizada');
        }
    });

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
        responsive: true,
        order: [[ 1, 'asc' ]],
        ordering: true,
        lengthChange: false
    });
</script>
@endsection
