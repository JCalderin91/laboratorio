<!-- <template>
  <ul id="slide-out" class="sidenav sidenav-fixed">
	  <li>
	  	<div class="user-view">
		    <div class="background">
		      <img :src="'assets/img/background.jpg'">
		    </div>
		    <a href="#user"><img class="circle" src="assets/avatars/001-man.png" style="margin: auto;"></a>
		    <a href="#name" class="center"><span class="white-text name">{{ name }}</span></a>
		    <a href="#email" class="center"><span class="white-text email">{{ email }}</span></a>
		  </div>
		</li>

	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Principal</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Registrar servicio</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Clientes</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Equipos</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Marcas</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Usuarios</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Areas y direcciones</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Reportes</router-link></li>
	  <li class="sidenav-close" ><router-link to="/"><i class="fas fa-home"></i>Configuraciones</router-link></li>
	  <li class="sidenav-close" ><router-link to="/areas">Direciones</router-link></li>
	  <li class="sidenav-close" ><router-link to="/">Test</router-link></li>
  </ul>
</template> -->



<template>
	<div>
		<div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">laboratorio</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="assets/avatars/001-man.png" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            {{ name }}
                        </span>
                        <span class="user-role">Administrator</span>
                    </div>
                </div>
                 <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>Menu</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Principal</span>
                                <span class="badge badge-pill badge-danger">New</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Dashboard 1
                                            <span class="badge badge-pill badge-success">Pro</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Dashboard 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>E-commerce</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Products

                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Orders</a>
                                    </li>
                                    <li>
                                        <a href="#">Credit cart</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="far fa-gem"></i>
                                <span>Components</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">General</a>
                                    </li>
                                    <li>
                                        <a href="#">Panels</a>
                                    </li>
                                    <li>
                                        <a href="#">Tables</a>
                                    </li>
                                    <li>
                                        <a href="#">Icons</a>
                                    </li>
                                    <li>
                                        <a href="#">Forms</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-chart-line"></i>
                                <span>Charts</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Pie chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Line chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Bar chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Histogram</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-globe"></i>
                                <span>Maps</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Google maps</a>
                                    </li>
                                    <li>
                                        <a href="#">Open street map</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
        	<h2>Main</h2>           
        </main>
        <!-- page-content" -->
     </div>
	</div>
</template>

<script>
export default {
	name: 'sidebar',
	props: ['name', 'email', 'avatarUrl'],
	mounted () {
		$('.sidenav').sidenav()
	}
}	
</script>

<style lang="css">
	.background img{
		height: 100%;
	}
</style>