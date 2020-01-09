import Address from './components/views/Address'
import Brands from './components/views/Brands'
import Clients from './components/views/Clients'
import Dashboard from './components/views/Dashboard'
import Orders from './components/views/Orders'
import Login from './components/views/Login'
import Users from './components/views/Users'
import Service from './components/views/Service'
import Reports from './components/views/Reports'
import Configurations from './components/views/Configurations'
import Main from './components/views/Main'

const routes = [{
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/',
    name: 'main',
    component: Main,
    children: [{
        path: '/principal',
        name: 'dashboard',
        component: Dashboard,
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
        path: '/areas',
        name: 'areas',
        component: Address,
      },
      {
        path: '/ordenes',
        name: 'orders',
        component: Orders,
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
      {
        path: '/configuraciones',
        name: 'configurations',
        component: Configurations,
      },
    ]
  }

];

export default routes;