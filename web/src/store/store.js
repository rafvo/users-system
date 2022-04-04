import Vue from 'vue'
import Vuex from 'vuex'
import users from './modules/users.js'
// import createPersistedState from 'vuex-persistedstate';
// import SecureLS from "secure-ls";

// var ls = new SecureLS({ encodingType: 'rc4', isCompression: false, encryptionSecret: 's3cr3tPa$$w0rd@123' });

Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    users,
  },

  // plugins: [
  //   createPersistedState({
  //     key: 'vuex',
  //     storage: {
  //       getItem: (key) => {
  //         try {
  //           return ls.get(key);
  //         } catch (_) {
  //           ls.clear();
  //         }
  //       },
  //       setItem: (key, value) => ls.set(key, value),
  //       removeItem: (key) => ls.remove(key)
  //     },
  //   })
  // ],
})
