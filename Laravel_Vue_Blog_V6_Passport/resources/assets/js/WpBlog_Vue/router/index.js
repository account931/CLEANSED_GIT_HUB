//https://github.com/hayanisaid/Vue-router
import Vue from 'vue';
import Router from 'vue-router';
import home from '../components/pages/home';
import blog from '../components/pages/blog';

import services from '../components/pages/services';
import contact from  '../components/pages/contact';
import details from  '../components/pages/details';
import blog_2021 from  '../components/pages/blog_2021';
import detailsInfo from  '../components/pages/details-info';
import loadNew1 from  '../components/pages/loadnew';

Vue.use(Router);

export default new Router({ 
  routes: [
    {
      path: '/',
      name: 'new_2021', //same as in component return section
      component: blog_2021,  //component itself
      props: { tokenZZ: 'i am set in router/index.js' },
    },
    
    //remove home ???
    {
      path: '/home',
      name: 'home',
      component: home
    },
    {
      path: '/blog',
      name: 'blog',
      component: blog
    },
	
    {
      path: '/services',
      name: 'services',
      component: services
    },
    {
      path: '/contact',
      name: 'contact',
      component: contact
    },
    {
      path: '/details/:Pid',
      name: 'details',
      component: details
    },
    {
      path: '/New_2021', 
      name: 'new_2021', //same as in component return section
      component: blog_2021,  //component itself
      props: { tokenZZ: 'I am set as tokenZZ in router/index.js' },
    },
    
    //Blog 2021 Routing
    {
      path: '/details-info/:Pidd', 
      name: 'details-info', //same as in component return section
      component: detailsInfo //component itself
    },
    
    
    {
      path: '/loadNew', 
      name: 'load-New', //same as in component return section
      component: loadNew1, //component itself
      props: true,
      //props: { categorrr: this.categoriesxx },
    },
	
  ]
})