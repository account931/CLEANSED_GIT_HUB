//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
    state: {
	    //posts used in Vue blog
	    posts              : [], //posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1", ,"wpBlog_category":4,"wpBlog_status":"1", "get_images":[{"wpImStock_id":16,"wpImStock_name":"product6.png","wpImStock_postID":1,"created_at":null,"updated_at":null}],"author_name":{"id":1,"name":"Admin","email":"admin@ukr.net","created_at":null,"updated_at":null},"category_names":{"wpCategory_id":4,"wpCategory_name":"Geeks","created_at":null,"updated_at":null}}, {"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
        //api_tokenY       : localStorage.getItem('tokenZ') || '' , //api_token is passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  and uplifted here to this store in VueRouterMenu in beforeMount() Section. Was true in prev project
        adm_posts_qunatity : 0, //quantity of posts found
        loggedUser         : JSON.parse(localStorage.getItem('loggedStorageUser')) || {name: 'not set', email: 'errorMail'}, //logged user data (JS type:Object), set by Login ajax, {name: '', email: ''}  use {JSON.parse} to convert string to JS type: OBJECT
        passport_api_tokenY: localStorage.getItem('tokenZ') || null , // is set by ajax in /subcomponents/login.vue {thatX.$store.dispatch('changeVuexStoreLogged', data); and mutated here by { changeVuexStoreLogged({ commit }, dataTestX) } }
        //ifLogged           : this.getters.fruitsCount,//true,  //() =>ifTokenExists(), //state based on computed //false, //flag whether user logged or not (Passport changes here)
        test: 'mmmm',
        
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
  
    
    getters: {
        //minor getter, can delete (both from Login_component)
        getCart(state) {
            return state.passport_api_tokenY;
        },
        
        isLoggedIn: state => !!state.passport_api_tokenY, //get value (true/false) based on other state
        /*
        fruitsCount (state) { 
            
            if(state.passport_api_tokenY !=''){
                return true;
            } else {
                return true;
            }
             //(state.passport_api_tokenY !='') ?  true :  false;
            
        },
        */
    },
    
 

    /*
    computed: {
        //not used here
        BASE_URL () {
            return this.$store.state.passport_api_tokenY;  
        },
        
     
        //compute state.ifLogged based on state.passport_api_tokenY
        /*
        ifTokenExists(){
            if(state.passport_api_tokenY !=''){ 
                alert('good');
                return true;
            } else { 
                alert('bad');
                return false; 
            }            
        }
        
    }, 
    */
    
    /*
    created() {
        //state.ifLogged = (state.passport_api_tokenY !='') ? true : false;
        return commit('Fire', 'dataTestX' ); //fire muation
    },
    
    watch: {
        myZZZ() {
           //state.ifLogged = (state.passport_api_tokenY !='') ? true : false;
           return commit('Fire', 'dataTestX' ); //fire muation
        }
    },
    */
    
    actions: {
		/*
	    async getAllPosts({ commit }) { 
	        return commit('setPosts', await fetch('http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all') )
            //return commit('setPosts', await api.get('/post/get_all'))
        }, */
	  
        //on Login success save data to Store (trigger mutation)
        changeVuexStoreLogged({ commit }, dataTestX) { 
            return commit('setLoginResults', dataTestX ); //sets dataTestX to store via mutation
        },
        
        //NOT USED HERE??????      
        //working example how to change Vuex store from child component //Catch a passed api token from VueRouterMenu, triggered in beforeMount()
	    changeVuexStoreTokenFromChild({ commit }, dataTestX) { 
	        //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	        alert('store token ' + dataTestX);
		    return commit('setApiToken', dataTestX ); //sets dataTestX to store via mutation
	    },
      
      
           
        /*
        |--------------------------------------------------------------------------
        | Ajax request, get REST API located at => WpBlog_VueContoller/ function getAllPosts()
        |--------------------------------------------------------------------------
        |
        |
        */
	    getAllPosts({ commit, state  }) {  //state is a fix
	        $('.loader-x').fadeIn(800); //show loader
            alert('start (True) Disable 2nd alert in AllPosts beforeMount');
            alert( "Vuex store Passport token " + state.passport_api_tokenY);
            fetch('api/post/get_all'/*?token=' + state.api_tokenY*/, { //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
                method: 'get',
                //pass Bearer token in headers ()
                headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + state.passport_api_tokenY },
                //contentType: 'application/json',

            }).then(response => {
                $('.loader-x').fadeOut(800);  //hide loader
                return response.json();
            }).then(dataZ => {
                console.log("Here STORE => " + dataZ);
		        //core rewritten, async getAllPosts, trigger mutation setPosts()
              
                if(dataZ.error == true|| dataZ.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                    console.log(dataZ.data);
                    swal("Unauthenticated", "Check Bearer Token", "error");
                  
                } else if(dataZ.error == false){
              
                    swal("Done", "Articles are loaded (Vuex store).", "success");
	                return commit('setPosts', dataZ ); //sets ajax results to store via mutation
                }
            })
	        .catch(/*err => */ function(err){
                console.log("Getting articles failed ( in store/index.js). Check if ure logged =>  " + err);
                swal("Crashed", "You are in catch", "error");
            }); // catch any error
      
      
        },
        
        
       /*
        |--------------------------------------------------------------------------
        | Logging user out, triggered in /subcomponents/logged.vue (subcomponent of Login_component.vue )
        |--------------------------------------------------------------------------
        |
        |
        */
        
        LogUserOut ({ commit }) { 
            alert('Vuex log out');
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
        setPostsQuantity ({ commit, state  }, passedArgument) {  //state is a fix
            return commit('setQuantMutations', passedArgument ); //to store via mutation
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
        setPosts(state, response) {  
            console.log('Set posts mutation successfully');
            state.posts = response.data/*.data*/;
	        console.log('setPosts executed in store' + response);
        },
     
        //mutation to set api token to STORE. NOT USED?????
        setApiToken(state, response) {   
            state.api_tokenY = response;
	        console.log('setApiToken executed in store' + response + ' Store => ' + state.api_tokenY);
            console.log('set apiToken mutation is done');
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
            //Vue.set(state, passport_api_token, response.token);
            localStorage.setItem('tokenZ', response.token); //saves to localStorage to not reset data on every F5        
            state.passport_api_tokenY = response.token;

            
            alert('Logged successfully');
            alert("passport_api_tokenY type is " + typeof state.passport_api_tokenY);
	        console.log('setApiToken executed in store' + response + ' Store => ' + state.passport_api_token);
            console.log('set apiToken mutation is done. localStorage is ' + localStorage.getItem('tokenZ'));
        },
        
        
        
        
        //Log out mutation (clear state.passport_api_tokenY +  state.loggedUser vars) 
        LogOutMutation(state) {
            state.passport_api_tokenY = null;
            state.loggedUser          = {}; 
            alert("passport_api_tokenY type is " + typeof state.passport_api_tokenY);            
        },
    },
    strict: debug
});




  


	 
 
 
