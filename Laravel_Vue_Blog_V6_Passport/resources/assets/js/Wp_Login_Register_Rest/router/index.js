//Not used
import Vue from 'vue';
import Router from 'vue-router';
import home from '../components/pages/home';
import contact from  '../components/pages/contact';
import list_all from  '../components/pages/list_all';
import editItem from  '../components/pages/editItem';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'List_all',
            component: list_all
        },
        
        {
            path: '/home',
            name: 'home',
            component: home
        },
 
        {
            path: '/contact',
            name: 'contact',
            component: contact
        },
    
        {
            path: '/list_all',
            name: 'List_all',
            component: list_all
        },
    
        //Edit one item Routing
        {
            path: '/edit-one-item/:PidMyID', 
            name: 'edit-one-item', 
            component: editItem //component itself
        },
	
    ]
})