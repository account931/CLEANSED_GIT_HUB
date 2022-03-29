import Vue from 'vue';
import Router from 'vue-router';
import services from '../components/pages/services';
import contact from  '../components/pages/contact';
import blog_2021 from  '../components/pages/blog_2021';
import detailsInfo from  '../components/pages/details-info';
import loadNew1 from  '../components/pages/loadnew';

Vue.use(Router);
export default new Router({ 
  routes: [
    {
      path: '/',
      name: 'new_2021', 
      component: blog_2021,  
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
      path: '/New_2021', 
      name: 'new_2021',      //same as in component return section
      component: blog_2021,  //component itself
    },
    
    //Blog One item Routing
    {
      path: '/details-info/:Pidd', 
      name: 'details-info', 
      component: detailsInfo 
    },
    
    
    {
      path: '/loadNew', 
      name: 'load-New', 
      component: loadNew1, 
      props: true,
    },
	
  ]
})