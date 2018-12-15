import Dashboard from './components/partials/Dashboard'
import AddressList from './components/partials/AddressList'
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
		component: Dashboard,
	},
	{
		path: '/areas',
		name: 'addresses',
		component: AddressList,
	},
];

export default routes;