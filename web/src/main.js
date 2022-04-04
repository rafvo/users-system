import '@/assets/scss/app.scss'
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store.js'
import vuetify from './plugins/vuetify/vuetify'
import {
  ValidationObserver,
  ValidationProvider,
  extend,
  localize
} from "vee-validate";
import pt_BR from "vee-validate/dist/locale/pt_BR.json";
import * as rules from "vee-validate/dist/rules";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import VueMask from 'v-mask'
Vue.use(VueMask);

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

localize("pt_BR", pt_BR);

Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);

Vue.use(Toast);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')

/**
 * Exemplo: 1732556543 => (17) 3255-6543
 *
 * @param {String} value
 * @return {String}
 */
Vue.filter('phone', function (value) {
  if (!value) return null;

  return value.replace(/[^0-9]/g, '')
    .replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
});

/**
 * Exemplo: 17986743566 => (17) 98674-3566
 *
 * @param {String} value
 * @return {String}
 */
Vue.filter('celphone', function (value) {
  if (!value) return null;

  return value.replace(/[^0-9]/g, '')
    .replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
});


/**
 *
 * @param {String} value
 * @return {String}
 */
Vue.filter('phoneCelphone', function (value) {
  if (!value) return null;

  const celphoneLength = 11;
  const phoneLength = 10;

  /*apenas números*/
  value = value.replace(/[^0-9]/g, '');

  if (value.length == celphoneLength)
    return value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');

  else if (value.length == phoneLength)
    return value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');

  return null;
});