import VueRouter from 'vue-router'

import routes from './routes'
import store from '../store'

const router = new VueRouter({
  mode: 'history',
  routes,
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('jwt-token')
    // if(to.path !== '/' && !token){
    //    next(false)
    //    return false
    // }
    if (!token) {
      //获取token
      Vue.http.get('/data/check').then(({data}) => {
        localStorage.setItem('jwt-token', data.token)
        store.dispatch('authSetInfo', {
          authenticated: true,
          id: data.user.id,
          email: data.user.email,
          name: data.user.name
        })
      }, ({data}) => {
        // next('/');
      })
    }else{
      Vue.http.get('/data/me')
      .then(({data}) => {
        store.dispatch('authSetInfo', {
          authenticated: true,
          id: data.id,
          email: data.email,
          name: data.name
        })
      }, ({data}) => {
        if (! data.refreshed_token) {
          localStorage.removeItem('jwt-token')
          console.error('Invalid user.')
          // next('/')
        }
      })
    }
    next()
})

export default router
