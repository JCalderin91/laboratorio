
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('assets/images/avatars/')}}/{{Auth::user()->avatar }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="material-icons">home</i>
                        <span>Principal</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('hours*') ? 'active' : '' }}">
                    <a href="{{ route('hours.index') }}">
                        <i class="material-icons">access_time</i>
                        <span>Registro de tiempos</span>
                    </a>
                </li> --}}
                <li class="{{ Request::is('register*') ? 'active' : '' }}">
                    <a href="{{  url('/test') }}">
                        <i class="material-icons">assignment</i>
                        <span>Registrar servicio</span>
                    </a>
                </li>
                <li class="{{ Request::is('client*') ? 'active' : '' }}">
                    <a href="{{ route('clients.index') }}">
                        <i class="material-icons">face</i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li class="{{ Request::is('devices*') ? 'active' : '' }}">
                    <a href="{{ route('devices.index') }}">
                        <i class="material-icons">devices_other</i>
                        <span>Equipos</span>
                    </a>
                </li>
                <li class="{{ Request::is('brands*') ? 'active' : '' }}">
                    <a href="{{ route('brands.index') }}">
                        <i class="material-icons">local_offer</i>
                        <span>Marcas</span>
                    </a>
                </li>
                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="material-icons">person</i>
                        <span>Técnicos</span>
                    </a>
                </li>
                <li class="{{ Request::is('areas*') ? 'active' : '' }}">
                    <a href="{{ route('areas.index') }}">
                        <i class="material-icons">map</i>
                        <span>Areas</span>
                    </a>
                </li>
                <li class="{{ Request::is('addresses') ? 'active' : '' }}">
                    <a href="{{ route('addresses.index') }}">
                        <i class="material-icons">directions</i>
                        <span>Direcciones</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">format_list_bulleted</i>
                        <span>Reportes</span>
                    </a>
                 </li>
                @if(Auth::user()->role_id == 1)
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">settings</i>
                        <span>Configuraciones</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
