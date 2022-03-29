/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');//already imported in \assets\js\Menu_One_Item\one_menu_item_login_logged_start.js, [Vue warn]: $attrs is readonly.
import router from './router/index.js';

import store from '../store/index'; //import Vuex Store
import ElementUI from 'element-ui'; //import ElementUI pop-up modal window
//import 'element-ui/lib/theme-chalk/index.css'; //moved as sepearate CSS Fileto css in /layout/app.php

Vue.use(ElementUI); //connect Vue to use with ElementUI
//Vue.use(Router); //connect Vue to use with VueRouter

Vue.component('show-quantity-of-posts', require('./components/Div_with_Quantity.vue')); //register component displaying qunatity
//vue-router-menu
Vue.component('vue-router-menu-with-link-content-display',  require('./components/VueRouterMenu.vue')); //register component dispalying vue-router-menu (used in \resources\views\wpBlog_Vue\index.php)


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
  
//Component => Div with Vue route menu and area to dispaly selected menu (Blog list, create new, etc)   
const appMenu = new Vue({
	store, //connect Vuex store, must-have
	router, //must-have for Vue routing
    el: '#vue-menu'
});



