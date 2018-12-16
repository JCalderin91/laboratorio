import Dashboard from './components/views/Dashboard'
import Address from './components/views/Address'
import Login from './components/views/Login'

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
		name: 'addresses',
		component: Address,
	},
];

export default routes;