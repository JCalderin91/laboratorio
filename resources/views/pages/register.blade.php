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
        <div class="form-group">
            <div class="form-line">
                <select v-model="client.area_id" name="area_id" class="form-control" required>
                    <option value="" required>Seleccione</option>
                    <option v-on:click="loadUser('fdf')" value="1">Informatica</option>
                    <option v-on:click="loadUser('fdf')" value="2">Turismo</option>
                </select>
            </div>
        </div>
        <button title="Registrar" data-toggle="modal" data-target="#hour" type="button" class="btn bg-teal waves-effect">
            <i class="material-icons">edit</i>
        </button>

        <pre>@{{client}}</pre>
    </div>        
    <!-- IN -->
    <div class="modal fade" id="hour" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="" v-on:submit.prevent="">
                    <div class="modal-header ">
                        <h2 class="modal-title" id="deleteLabel">Registrar nuevo usuario</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input v-model="client.id" name="id" type="text" class="form-control" placeholder="Ingrese la cedula" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select v-model="client.area_id" name="area_id" class="form-control" required>
                                            <option value="" required>Seleccione</option>
                                            <option value="1">Informatica</option>
                                            <option value="2">Turismo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="fomr-line">
                                        <input v-model="client.first_name" name="first_name" type="text" class="form-control" placeholder="Nombres" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="from-line">
                                        <input v-model="client.last_name" name="last_name" type="text" class="form-control" placeholder="Apellidos" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="from-line">
                                        <input v-model="client.phone" name="phone" type="text" class="form-control" placeholder="Telefono" required>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select v-model="client.status" name="status" class="form-control" required>
                                        <option value="" required>Seleccione</option>
                                        <option value="ACTIVE">Activo</option>
                                        <option value="INACTIVE">Inactivo</option>
                                    </select> 
                                </div>
                            </div>
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
        users: '-',
        user_id: 'Empty',
        user: '',
        client: {
            id: '',
            area_id: '',
            first_name: '',
            last_name: '',
            phone: '',
            status: ''
        }
      },
      methods:{
        getUsers(){
            axios
                .get('/api')
                .then( (response) => {
                    this.users = response.data;
                })
                .catch( (error) => {
                    console.log(error);
                });
        },
        pushUser(){
            axios
                .post('/api',{
                    id: this.user_id
                })
                .then( (response) => {
                    this.user = response.data
                    $('#hour').modal('hide')
                })
                .catch( (error) => {
                    console.log(error);
                });
        },
        loadUSer:function(message){
            this.message = message
        }
      }
    })
</script>

@endsection