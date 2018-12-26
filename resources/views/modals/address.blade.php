<!-- GUARDAR LOS DATOS DE UN NUEVO CLIENTE -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="deleteLabel">Ingresar datos del nuevo cliente</h2>
                <p>Registre los datos del nuevo cliente</p>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('clients.store') }}"  role="form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dni" required>
                                    <label class="form-label">Cedula</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="area_id"  class="form-control show-tick" data-live-search="true" required> 
                                        <option value="">Seleccione</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="first_name" required>
                                    <label class="form-label">Nombres</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="last_name" required>
                                    <label class="form-label">Apellidos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="phone" required>
                                    <label class="form-label">Teléfono</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group justify-between">
                                <button data-dismiss="modal" class="btn btn-primary waves-effect">
                                    <i class="material-icons">undo</i>
                                    <span>CANCELAR</span> 
                                </button>
                                <button class="btn btn-success waves-effect" type="submit">
                                    <i class="material-icons">save</i>
                                    <span>GUARDAR</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>