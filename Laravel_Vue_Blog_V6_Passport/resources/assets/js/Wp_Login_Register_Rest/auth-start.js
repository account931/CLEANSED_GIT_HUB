//Login and register components

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
import store from '../store/index'; //import Vuex Store

Vue.component('login-vue-component',        require('./components/Login_component.vue'));        //login component 
Vue.component('registration-vue-component', require('./components/Registration_component.vue')); //register component 


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */ 
  
//Component => Div with Vue Login form 
const appLogin = new Vue({
	store, //connect Vuex store, must-have
	//router, //must-have for Vue routing
    el: '#vue-login'
});


//Component => Div with Vue Register form 
const appRegister = new Vue({
	store, //connect Vuex store, must-have
    el: '#vueRegistrationRest'
});