import Test from './components/partials/test'
import Address from './components/partials/address'

const routes = [
	{
		path: '/',
		name: 'dashboard',
		component: Test,
	},{
		path: '/areas',
		name: 'addresses',
		component: Address,
	},
];

export default routes;