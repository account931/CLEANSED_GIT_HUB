//Admin Part

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue'); 
import router from './router/index.js'

// Blog
import store from '../store/index'; //import Vuex Store
import ElementUI from 'element-ui'; //import ElementUI pop-up modal window
Vue.use(ElementUI); //connect Vue to use with ElementUI
Vue.component('show-quantity-of-posts', require('./components/Div_with_Quantity.vue')); //register component dispalying qunatity
//vue-router-menu
Vue.component('vue-router-menu-with-link-content-display',  require('./components/VueRouterMenu.vue')); //register component dispalying vue-router-menu


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Component to Show div with Blogs' quantity
const appQuant = new Vue({
	store, //connect Vuex store, must-have
    el: '#quant'
});
  
  
//Component => Div with Vue route menu and area to dispaly selected menu    
const appMenu = new Vue({
	store, //connect Vuex store, must-have
	router, //must-have for Vue routing
    el: '#vue-menu'
});