//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
  state: {
	  //posts used in Vue blog
	  posts: [],
      //posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1", ,"wpBlog_category":4,"wpBlog_status":"1", "get_images":[{"wpImStock_id":16,"wpImStock_name":"product6.png","wpImStock_postID":1,"created_at":null,"updated_at":null}],"author_name":{"id":1,"name":"Admin","email":"admin@ukr.net","created_at":null,"updated_at":null},"category_names":{"wpCategory_id":4,"wpCategory_name":"Geeks","created_at":null,"updated_at":null}}, 
              //{"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
      
      api_tokenY: '', //api_token is passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  and uplifted here to this store in VueRouterMenu in beforeMount() Section
      
	  //products are used in Router example. NOT USED IN CLEANSED Version. Set via seeder to DB and extracted via store/index.js ajax
      /*	 
      products:[
	      {productTitle:"ABCN", image: 'product1.png', productId:1},
          {productTitle:"KARMA",image: 'product2.png', productId:2},
          {productTitle:"Tino", image: 'product3.png', productId:3},
          {productTitle:"EFG",  image: 'product4.png', productId:4},
          {productTitle:"MLI",  image: 'product5.png', productId:5},
          {productTitle:"Banan",image: 'product6.png', productId:6}
        ],
        */
  },
  

    computed: {
       BASE_URL () {
          return this.$store.state.api_tokenY;  
       }
    },
  
    actions: {
		/*
	    async getAllPosts({ commit }) { 
	      return commit('setPosts', await fetch('http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all') )
          //return commit('setPosts', await api.get('/post/get_all'))
      }, */
	  
          
       //working example how to change Vuex store from child component //Catch a passed api token from VueRouterMenu, triggered in beforeMount()
	    changeVuexStoreTokenFromChild({ commit }, dataTestX) { 
	      //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	      console.log('store token ' + dataTestX);
		  return commit('setApiToken', dataTestX ); //sets dataTestX to store via mutation
	    },
      
	  //ajax request, get REST API located at => WpBlog_VueContoller/ function getAllPosts()
	  getAllPosts({ commit, state  }) {  //state is a fix
	      $('.loader-x').fadeIn(800); //show loader
          
          setTimeout(function(){ //dont need
          alert('start (True) Disable 2nd alert in AllPosts beforeMount');
          alert( "store1 " + state.api_tokenY);
		  //alert( "store2 "  + this.BASE_URL() );
          fetch('api/post/get_all'/*?token=' + state.api_tokenY*/, { //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
              method: 'get',
              //pass Bearer token in headers ()
              headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + state.api_tokenY },
              //contentType: 'application/json',

   
   
          }).then(response => {
              $('.loader-x').fadeOut(800);  //hide loader
              return response.json();
          }).then(dataZ => {
              console.log("Here STORE => " + dataZ);
		      //core rewritten async getAllPosts, trigger mutation setPosts()
              
              if(dataZ.error == true|| dataZ.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                  alert(dataZ.data);
                  swal("Unauthenticated", "Check Bearer Token", "error");
                  
              } else if(dataZ.error == false){
              
                swal("Done", "Articles are loaded.", "success");
	            return commit('setPosts', dataZ ); //sets ajax results to store via mutation
              }
          })
	      .catch(/*err => */ function(err){
              alert("Getting articles failed ( in store/index.js). Check if ure logged =>  " + err);
              swal("Crashed", "You are in catch", "error");
          }); // catch any error
      
        }, 40);
      
      },
	  
	  //working example how to change Vuex store from child component
	  /*
	  changeVuexStoreFromChild({ commit }, dataTestX) { 
	      //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	      console.log(dataTestX);
		  return commit('setPosts', dataTestX ); //sets dataTestX to store via mutation
	  } 
	  */
      
	  
	},



  mutations: {
    setPosts(state, response) {  alert('Set posts mutation successfully');
        state.posts = response.data/*.data*/;
	    console.log('setPosts executed in store' + response);
        
    },
    
     setApiToken(state, response) {   
        state.api_tokenY = response;
	    console.log('setApiToken executed in store' + response + ' Store => ' + state.api_tokenY);
        alert('set apiToken mutation is done');
    },
  },
  strict: debug
});




  


	 
 
 
