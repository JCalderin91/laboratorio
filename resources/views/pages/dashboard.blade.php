@extends('layouts.app')

@section('title')| Bienvenido @endsection

@section('content')
<!-- Contenido -->

<!-- #END# Widgets -->

<div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <div class="header">
                <h5>LISTA DE EQUIPOS</h5>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="centered highlight" >
                        <thead class="blue white-text">
                            <tr>
                                <th>Equipo</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Computadora</td>
                                <td>22998438</td>
                                <td>Jesus Rafael</td>
                                <td>04/12/2018</td>
                                <td><div class="badge bg-red">Pendiente</div></td>
                                <td>
                                  <button title="Reparar" type="button" class="btn bg-blue waves-effect">
                                    <i class="fas fa-wrench"></i>
                                  </button>
                                </td>
                            </tr>
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contenido -->


@endsection
@section('script')
@endsection
