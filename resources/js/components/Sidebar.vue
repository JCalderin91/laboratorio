<template>
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
</template>

<script>
	export default {
		name: 'sidebar',
		props: ['name', 'email', 'avatarUrl'],
	}	
</script>

<style lang="css">
.background img{
	height: 100%;
}
</style>