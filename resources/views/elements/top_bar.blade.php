    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ route('home') }}">
                    LABORATORIO DE FÍSICA
                    
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a title="Cerrar sesión" href="javascript:void(0);" data-toggle="modal" data-target="#logout">
                            <i class="material-icons">power_settings_new</i>
                        </a>                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <!-- Small Size -->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content modal-col-red">
                <div class="modal-header">
                    <h2 class="modal-title pb-2" id="deleteLabel">Advertencia</h2>
                </div>
                <div class="modal-body">
                    Realmente desea cerrar sesión?
                </div>
                <div class="modal-footer">

                    <a href="{{ route('logout') }}"
                        class="btn btn-link waves-effect"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();">CONTINUAR
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>