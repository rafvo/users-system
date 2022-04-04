import Vue from 'vue'
import VueRouter from 'vue-router'
import Users from '@/views/users/Users.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Users',
    component: Users,
    meta: {
      title: 'Usuários'
    }
  },
]

const router = new VueRouter({
  routes: routes,
  mode: 'history',
})

export default router