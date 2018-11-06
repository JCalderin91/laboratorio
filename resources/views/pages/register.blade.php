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


<div id="app" class="card">
    <div class="header">
        <h2>REGISTRO DE ENTRADA Y SALIDA</h2>
        <p>Con el selector podra indicar el tiempo que se encuentre activo en el laboratorio</p>
    </div>
    <div class="body">
        @{{ message }}
        <div class="form-group">
            <input type="text" class="form-control form-line" v-model="users.name">
        </div>
        <button title="Desactivar" data-toggle="modal" data-target="#hour" type="button" class="btn bg-red waves-effect">
            <i class="material-icons">lock_outline</i>
        </button>

        <pre>@{{users}}</pre>
    </div>        
    <!-- IN -->
    <div class="modal fade" id="hour" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content modal-col-green">
                <form action="" v-on:submit.prevent="getUsers()">
                    <div class="modal-header ">
                        <h2 class="modal-title" id="deleteLabel">Advertencia</h2>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="users.name" name="password" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">CONTINUAR</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    var app = new Vue({
      el: '#app',
      data: {
        message: 'Hello Vue!',
        users: {
            name: 'jesus'
        }
      },
      methods:{
        getUsers(){
            axios
            .post('/ajax',
            {
                name: 'Fred'
            })
            .then(function (response) {
                this.users = response.data
            })
            .catch(function (error) {
                console.log(error);
            });
        }
      }
    })
</script>

@endsection