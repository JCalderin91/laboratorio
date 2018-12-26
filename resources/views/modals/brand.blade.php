<!-- GUARDAR LOS DATOS DE UN NUEVO CLIENTE -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="deleteLabel">Ingresar datos de la nueva marca</h2>
                <p>Registre los datos de la nueva marca</p>
            </div>
            <div class="modal-body">

            <form method="POST" action="{{ route('brands.store') }}"  role="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="title" required>
                                <label class="form-label">Titulo de la marca</label>
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