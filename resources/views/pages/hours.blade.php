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
    <div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-green p-r-35 animated fadeInDown" role="alert" data-notify-position="top-center" style="display: inline-block; position: absolute; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 50%; transform: translateX(-50%);">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button>
        <span data-notify="icon"></span>
        <span data-notify="title"></span>
        <span data-notify="message">{{Session::get('success')}}</span>
        <a href="#" target="_blank" data-notify="url"></a>
    </div>
@endif


<div class="card">
    <div class="header">
        <h2>REGISTRO DE ENTRADA Y SALIDA</h2>
        <p>Con el selector podra indicar el tiempo que se encuentre activo en el laboratorio</p>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
                <thead class="bg-blue">
                    <tr>
                        <th class="text-center">Nombres</th>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tfoot >
                    <tr class="text-center">
                        <th class="text-center">Nombres</th>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($hourOfUser as $user )
                    <tr>
                        <td>{{ $user->user->first_name }}</td>
                        <td>{{ $user->user->last_name }}</td>
                        <td>
                         @if($user->hourIN->operation == 'IN')
                            <button data-operation="IN" data-user_id="{{ $user->user->id }}" title="Iniciar"
                                    data-toggle="modal" data-target="#hour" type="button" class="btn bg-green waves-effect">
                                    <i class="material-icons">play_arrow</i>
                            </button>
                            @else
                            <button data-operation="OUT" data-user_id="{{ $user->user->id }}" title="Terminar"
                                    data-toggle="modal" data-target="#hour" type="button" class="btn bg-red waves-effect">
                                    <i class="material-icons">stop</i>
                            </button>
                            @endif 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>        
</div>
<!-- IN -->
<div class="modal fade" id="hour" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-green">
            <form action="{{ route('hours.store') }}" method="POST">
                @csrf
                <div class="modal-header ">
                    <h2 class="modal-title" id="deleteLabel">Advertencia</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <input type="hidden" name="user_id" value="" id="user_id">
                    <input type="hidden" name="operation" value="" id="operation">
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
