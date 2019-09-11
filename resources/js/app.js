require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify)

import VeeValidate from 'vee-validate';
const VueValidationEs = require('vee-validate/dist/locale/es');
Vue.use(VeeValidate, {
  locale: 'es',
  dictionary: {
    es: VueValidationEs
  }
});
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

window.toastr = require('toastr')

Vue.use(VueToastr2)
import router from './router'

// Componente Principal
import App from './App.vue'

const app = new Vue({
    el: '#app',
    router,
    components:{App},
});
