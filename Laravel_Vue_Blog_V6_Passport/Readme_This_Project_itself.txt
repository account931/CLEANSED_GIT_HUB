 TABLE OF CONTENT:
 1. This project {Laravel_Vue_Blog_V6_Passport} 
 2. {CLEANSED_GIT_HUB/Laravel_Vue_Blog}                        



-------------------------------------------------------

 1. This project {Laravel_Vue_Blog_V6_Passport} 
     => see Passport ReadMe at =>  13.2.1 REST API authentication via Passport package  at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/ReadMe_Laravel_Com_Commands.txt
 
 Main features:
     # Stack: Laravel 6, Vue 2, Passport package, Spatie Laravel Permission RBAC, token check
     # Login, register are now Vue component, work via REST API (ajax): \resources\assets\js\Wp_Login_Register_Rest
     # Auth verification is performed on Passport token (issued on login) and this Passport roken is sent on every ajax request in headers
     # Api routes use 'middleware' => ['auth:api', 'myJsonForce'], 'auth:api' automatically checks if a token is passed in request (though passing token u must implement by yourself), 'myJsonForce' forces response in JSON, 
     # Admin api routes additionally use  Route::group(['middleware' => ['myRbacCheck']] (RBAC check by Spatie)
   -------------------
   How it works:
   1. Login
   2. Differences and similarities between {CLEANSED_GIT_HUB/Laravel_Vu e_Blog_V6_Passport} and {CLEANSED_GIT_HUB/Laravel_Vue_Blog}
   3. Get Article posts
   4. Create an Article post
   5. Edit   one Article post (Admin Part)
   6. Delete one Article post (Admin Part)
   
   ------------------
   1. Login
   
   Login works on Vue component, to init it in login.blade.php we insert <login-vue-component> <login-vue-component/>, which actually is  ./components/Login_component.vue
   Login_component.vue is bind to div id="vue-login" in views/auth/login.blade.php in a start script \resources\assets\js\Wp_Login_Register_Rest\auth-start.js. 
   auth-start.js is the one added in mix.js + added as js src in app.blade.php
   
   #Login_component.vue uses 2 subcomponents (/subcomponents/login.vue + /subcomponents/logged.vue)
   #Login implementation itself (/subcomponents/login.vue) => 
       1. Email and password input are used as Vue data (appended to formData) and on submit, Vue sends ajax to \Controllers\Auth_API\UserAuthController (public function login(Request $request)).
       2. If login/password are correct, Rest Controller issues a token via Passport($token = auth()->user()->createToken('API Token')->accessToken;) and json return this token and user data(name, email) to user.
       3. In (/subcomponents/login.vue in ajax success section we get response data and trigger Vuex store changes =>  thatX.$store.dispatch('changeVuexStoreLogged', data);
       5. In Vuex store changeVuexStoreLogged trigger mutation
          changeVuexStoreLogged({ commit }, dataTestX) { 
             return commit('setLoginResults', dataTestX ); //sets dataTestX to store via mutation
          },
       6. In mutation { setLoginResults (state, response) } we save issued Passport token to {state.passport_api_token} and to avoid refereshing/loosing state.passport_api_token on F5, save it localStorage. Same do with user data(name, email) => 
           setLoginResults (state, response) { 
               //sets the passport api token
               state.passport_api_token = response.token;
               localStorage.setItem('tokenZ', response.token);
   
        7.Auth check (if user is logged) is performed in JS based on if { state.passport_api_tokenY } is not null:
            <div v-if="this.$store.state.passport_api_tokenY != null"> <!--auth check if Passport Token is set, i.e user is logged -->
                HTML for Logged 
            </div>
    
            <div v-else> HTML for Unlogged </div>
   
   
   
   
   

     
    --------------------------------------------------

    2. Differences and similarities between {CLEANSED_GIT_HUB/Laravel_Vue_Blog_V6_Passport} and {CLEANSED_GIT_HUB/Laravel_Vue_Blog}

          => See README.md
  
    

   
    --------------------------------------------------
    3. Get Article posts
        1. Logic is in \resources\assets\js\WpBlog_Vue\components\pages\blog_2021.vue
        2. In beforeMount() {} we 1stly make Passport token check
            if(this.$store.state.passport_api_tokenY == null){ return false;}
        then trigger action in Vuex store (resources\assets\js\store\index.js) => this.$store.dispatch('getAllPosts');
        3.  In Vuex store we run ajax request to REST API (WpBlog_Rest_API_Contoller /function getAllPosts()), get articles in JSON response and save them to Vuex Store state.posts[]
        4.  Further In \pages\blog_2021.vue we display posts from Vuex store
     
     
     
   
    --------------------------------------------------
    
    4. Create an Article post
    
    --------------------------------------------------
    5. Edit   one Article post (Admin Part)
    
    --------------------------------------------------
    6. Delete one Article post (Admin Part)
    
    --------------------------------------------------
    
    
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
===============================================================================================================


 2. {CLEANSED_GIT_HUB/Laravel_Vue_Blog}        
     => see additional ReadMe at => 13.2   REST API authentication via token (Token Bearer, String Query) at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/ReadMe_Laravel_Com_Commands.txt
 
 Main features:
     # Stack: Laravel 5.4, Vue 2, Entrust RBAC, token check by {user} table column
     # Login/register actions work via regular http sessions, while CRUD operations (read, create, delete, etc) uses access token for auth (sent as header in Vue ajax)
     # Auth verification(except for login) is performed via token (token is issued manually when user clicks button "Generate token" and saved to table {users} -> column {api_token}) and this token is sent with every ajax request in headers

     # This WpRess Vue.js Blog uses 3-table DB (same as Wpress Image Blog and {Laravel_Vue_Blog_V6_Passport}):
         wpressimages_blog_post
         wpressimage_category
         wpressimage_imagesstock => each row contains one image and Foreign Key id {wpImStock_postID} to what Blog post {wpressimages_blog_post} it relates to
     
     # Api routes use 'middleware' => ['auth:api', 'myJsonForce'], 'auth:api' automatically checks if a token is passed in request (though passing token u must implement by yourself), 'myJsonForce' forces response in JSON, 
     # Admin api routes additionally use  Route::group(['middleware' => ['myRbacCheck']] (RBAC check by Entrust)

   -------------------
   How it works:
   1. Login
   2. *******
   
   -------------------
   
   1. Login
   Login/register actions work via regular http sessions (as built in framework)



