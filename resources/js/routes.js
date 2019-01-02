import Address from './components/views/Address'
import Areas from './components/views/Areas'
import Brands from './components/views/Brands'
import Clients from './components/views/Clients'
import Dashboard from './components/views/Dashboard'
import Devices from './components/views/Devices'
import Login from './components/views/Login'
import Users from './components/views/Users'
import Service from './components/views/Service'
import Reports from './components/views/Reports'

const routes = [
	{
		path: '/login',
		name: 'login',
		component: Login
	},
	{
		path: '/',
		name: 'dashboard',
		component: Dashboard,
	},
	{
		path: '/areas',
		name: 'areas',
		component: Address,
	},
	{
		path: '/marcas',
		name: 'brands',
		component: Brands
	},
	{
		path: '/clientes',
		name: 'clients',
		component: Clients,
	},
	{
		path: '/direcciones',
		name: 'addresses',
		component: Address,
	},
	{
		path: '/dispositivos',
		name: 'devices',
		component: Devices,
	},
	{
		path: '/usuarios',
		name: 'users',
		component: Users,
	},
	{
		path: '/servicio',
		name: 'service',
		component: Service,
	},
	{
		path: '/reportes',
		name: 'reports',
		component: Reports,
	},
];

export default routes;