import Test from './components/partials/test'
import Address from './components/partials/address'
import Login from './components/Login'

const routes = [
	{
		path: '/login',
		name: 'login',
		component: Login
	},
	{
		path: '/',
		name: 'dashboard',
		component: Test,
	},
	{
		path: '/areas',
		name: 'addresses',
		component: Address,
	},
];

export default routes;