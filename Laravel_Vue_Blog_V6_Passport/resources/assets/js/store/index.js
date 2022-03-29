//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
    state: {
	    posts              : [], //posts used in Vue blog, posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1", ,"wpBlog_category":4,"wpBlog_status":"1", "get_images":[{"wpImStock_id":16,"wpImStock_name":"product6.png","wpImStock_postID":1,"created_at":null,"updated_at":null}],"author_name":{"id":1,"name":"Admin","email":"admin@ukr.net","created_at":null,"updated_at":null},"category_names":{"wpCategory_id":4,"wpCategory_name":"Geeks","created_at":null,"updated_at":null}}, {"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
        adm_posts_qunatity : 0, //quantity of posts found
        loggedUser         : JSON.parse(localStorage.getItem('loggedStorageUser')) || {name: 'not set', email: 'errorMail'}, //logged user data (JS type:Object), set by Login ajax, {name: '', email: ''}  use {JSON.parse} to convert string to JS type: OBJECT
        passport_api_tokenY: localStorage.getItem('tokenZ') || null , // is set by ajax in /subcomponents/login.vue {thatX.$store.dispatch('changeVuexStoreLogged', data); and mutated here by { changeVuexStoreLogged({ commit }, dataTestX) } }
        //api_tokenY       : localStorage.getItem('tokenZ') || '' , //api_token is passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  and uplifted here to this store in VueRouterMenu in beforeMount() Section. Was true in prev project
    },
  
    getters: {
        //minor getter, can delete (both from Login_component)
        getCart(state) { 
            return state.passport_api_tokenY;
        },
        
        isLoggedIn: state => !!state.passport_api_tokenY, //get value (true/false) based on other state   
    },
    
    actions: {
		
        //on Login success save data to Store (trigger mutation)
        changeVuexStoreLogged({ commit }, dataTestX) { 
            return commit('setLoginResults', dataTestX ); //sets dataTestX to store via mutation
        },
       
           
        /*
        |--------------------------------------------------------------------------
        | Ajax request, get REST API located at => WpBlog_VueContoller/ function getAllPosts(), get all blog posts (non-admin section)
        |--------------------------------------------------------------------------
        |
        |
        */
	    getAllPosts({ commit, state  }) {  
        
            var thatX = this; //to fix context issue
	        $('.loader-x').fadeIn(800); //show loader
  
            //Axios method http variant 
            axios({
                method: 'get', 
                url: 'api/post/get_all',
                headers: {
                    'Content-Type': 'application/json', 'Authorization': 'Bearer ' + state.passport_api_tokenY
                },
            })
            .then(dataZ => {
                //console.log(dataZ);
                $('.loader-x').fadeOut(800);  //hide loader
          
                //change for Axios
                if (dataZ.data.error == false){ 
                    swal("Done", "Articles are loaded (axios) (Vuex store).", "success");
	                return commit('setPosts', dataZ.data ); //sets ajax results to store via mutation
                }
            })
	        .catch(function(err){ 
                $('.loader-x').fadeOut(800);  //hide loader
                //console.log("Getting articles failed ( in store/index.js). Check if ure logged =>  " + err);
                swal("Crashed", "You are in catch", "error");
                
                //changes for Axios //Unlogg the user 
                if(err == "Error: Request failed with status code 401" ||  err == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                    //console.log("dataZ.data.error 2 " + err.error);
                    swal("Unauthenticated2", "Check Bearer Token2", "error");
                    
                    //Unlog the user if  dataZ.error == "Unauthenticated." || 401, otherwise if user has wrong password token saved in Locals storage, he will always recieve error and never logs out                  
                    //store.dispatch('LogUserOut');//this.$store.dispatch('LogUserOut'); //trigger Vuex function LogUserOut(), which is executed in Vuex store
                    localStorage.removeItem('tokenZ'); //clear localStorage
                    localStorage.removeItem('loggedStorageUser');
                    commit('LogOutMutation'); //reset state vars (state.passport_api_tokenY + state.loggedUser) via mutation
                    state.passport_api_tokenY = null;
                }
            }); 
            //End Axios http variant
      
        },
        
        
       /*
        |--------------------------------------------------------------------------
        | Logging user out, triggered in /subcomponents/logged.vue (subcomponent of Login_component.vue )
        |--------------------------------------------------------------------------
        |
        |
        */
        
        LogUserOut ({ commit }) { 
            localStorage.removeItem('tokenZ'); //clear localStorage
            localStorage.removeItem('loggedStorageUser');
            commit('LogOutMutation'); //reset state vars to store via mutation
            
        },
      
      
      
        /*
        |--------------------------------------------------------------------------
        | Mutation section
        |--------------------------------------------------------------------------
        |
        |
        */
        //For mutation to set a quantity of found posts(in Admin Part). Fired in list_all. passedArgument is an arg passed in list_all.vue
        setPostsQuantity ({ commit, state  }, passedArgument) {  
            return commit('setQuantMutations', passedArgument ); //to store via mutation
        },	  
	},

    mutations: {
        setPosts(state, response) {  
            state.posts = response.data;
	        //console.log('setPosts executed in store' + response);
        },
     
        //mutation to quantity of Blog to STORE
        setQuantMutations(state, myPassedArg) {
            state.adm_posts_qunatity = myPassedArg;        
        },
        
        
        //on Login success save data to Store (trigger mutation)
        setLoginResults (state, response) { 
            
            //sets user's array to Vuex store object(state.state.loggedUser). Is gotten from /subcomponents/login.vue ajax 
            localStorage.setItem('loggedStorageUser', JSON.stringify(response.user)); //use {JSON.stringify} to save JS type:Object (i.e converts Object to string) //saves to localStorage to not reset data on every F5        
            state.loggedUser = response.user;  //sets Vuex user Object (JS type:Object) {name: '', email: ''} 

            //sets the passport api token to Vuex store(state.passport_api_tokenY). Is gotten from /subcomponents/login.vue ajax 
            localStorage.setItem('tokenZ', response.token); //saves to localStorage to not reset data on every F5        
            state.passport_api_tokenY = response.token;

	        //console.log('setApiToken executed in store' + response + ' Store => ' + state.passport_api_token);
            //console.log('set apiToken mutation is done. localStorage is ' + localStorage.getItem('tokenZ'));
        },
        

        //Log out mutation (clear state.passport_api_tokenY +  state.loggedUser vars) 
        LogOutMutation(state) {
            state.passport_api_tokenY = null;
            state.loggedUser          = {}; 
        },
    },
    strict: debug
});
