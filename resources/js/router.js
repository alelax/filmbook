import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import Browse from './pages/user/Browse'
import MyList from './pages/user/MyList'
import Watched from './pages/user/Watched'

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    redirect: '/dashboard/browse',
    children: [
      {        
        path: 'browse',
        name: 'Browse',
        component: Browse
      },
      {        
        path: 'my-list',
        name: 'myList',
        component: MyList
      },
      {        
        path: 'watched',
        name: 'Watched',
        component: Watched      
      }      
    ],
    meta: {
      meta: {auth: {roles: 'admin', redirect: {name: 'default'}, forbiddenRedirect: '/403'}},
    }
  },
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router