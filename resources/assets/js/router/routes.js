import IndexView from '../views/Index.vue'
import ManageView from '../views/Manage.vue'
import CategoryView from '../views/Category.vue'

import LoginView from '../views/Login.vue'
import RegisterView from '../views/Register.vue'

const routes = [
  {
    path: '/', 
    name: 'index',     
    component: resolve => resolve(IndexView)
  },
  {
    path: '/category',
    name: 'category',
    component: resolve => resolve(CategoryView)
  },
  {
    path: '/login',
    name: 'login',
    component: resolve => resolve(LoginView)
  },
  {
    path: '/register',
    name: 'register',
    component: resolve => resolve(RegisterView)
  },
  {
    path: '/manage',
    name: 'manage',    
    component: resolve => resolve(ManageView)
  }
]

export default routes
