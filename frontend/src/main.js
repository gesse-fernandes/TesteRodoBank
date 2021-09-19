require('./bootstrap');
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './vuex/store'
import bootstrap from '../node_modules/bootstrap/dist/css/bootstrap.css'
import Snotify from 'vue-snotify'
import VueSwal from 'vue-swal'
Vue.config.productionTip = false
Vue.use(bootstrap);
Vue.use(Snotify, {
  toast: {
    showProgressBar: true
  }
})
Vue.use(VueSwal)
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent'))
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
store.dispatch('checkLogin')
  .then(() => {
    const type = localStorage.getItem('type');
    console.log(type);
    if (type == 'client')
    {
      router.push({
          name:'client'
        })
    } else if (type == 'admin')
    {
         router.push({
           name: 'admin'
         })
      }
  })
  .catch((error) => router.push({
    name: 'home'
  }))
