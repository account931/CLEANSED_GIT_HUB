<!-- Most up-to-date version (CLEANSED Version) -->
<template>
	<div class="contact">
		<h1> {{title}} </h1> 
		
        <!--------- Unauthorized/unlogged Section ------> 
        <div v-if="this.$store.state.passport_api_tokenY == null" class="col-sm-12 col-xs-12 alert alert-info"> <!--auth check if Passport Token is set, i.e user is logged -->
            <h3> <p>Sorry, you are not logged. Login first </p>
            <i class="fa fa-minus-circle" style="font-size:48px;color:red"></i> 
            </h3>
                
        </div>
        
        
        
        <!--------- Authorized/Logged Section ----------> 
        <div v-else-if="this.$store.state.passport_api_tokenY != null">
        
		<div class="contact">
		    <h3> Blog Vue,  <b> {{tokenZZ}}</b> <p>Token (from Vuex STORE): {{this.$store.state.passport_api_tokenY}}</p> </h3>
            <p>{{this.ifMakeAjax}}</p>
		</div>
         
        
        <div class="row">
        
            <!-- Original part, Displays post articles from Vuex Store /store/index.js -->
            <div v-for="(post, i) in posts" :key=i> <!-- or this.$store.state.posts -->
                
                <!-- is rendered only if i % 2 == 0 -->
                <div class="col-sm-12 col-xs-12"  style="border: 1px solid black;" v-if="i % 2 == 0"> 
                    banner 
                </div>
                
                <!-- is rendered always -->
                <div class="col-sm-6 col-xs-6">
	
                    <!-- Show 1st image if exists. HasMany Relation. {get_images} is a model {function getImages()}  HasMany Relation -->		 
                    <!--<img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />-->
		
		            <!-- Image with LightBox -->
	                <a v-if="post.get_images.length" :href="`images/wpressImages/${post.get_images[0].wpImStock_name}`"   title="image" :data-lightbox="`roadtrip${post.wpBlog_id}`" > <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
                        <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />
	                </a>
                    <!-- End Image with LightBox -->
		
                    <!-- If image does not exist. ELSE -->
                    <img v-else class="card-img-top my-img" :src="`images/no-image-found.png`" />

        
                    <div class="card-body">
                        <p class="card-text"><strong>{{ post.wpBlog_title }}</strong> <br>
                           {{ truncateText(post.wpBlog_text) }}
                        </p>
                    </div>
                    <button class="btn btn-success m-2 z-overlay-fix-2" v-on:click="viewPost(i)">View   <i class="fa fa-crosshairs" style="font-size:14px"></i></button>
                    <button class="btn btn-info m-2 z-overlay-fix-2"    @click="goTodetail(i)" > Router <i class="fa fa-tag" style="font-size:14px"></i></button>
		            <hr>
                </div>
            </div>
	     </div> <!-- end class="row"-->
	
	
	<!-- Hidden modal window {ElementUI 'element-ui}(installed separately by npm) , will pop-up visible on click showing 1 full article -->
    <el-dialog v-if="currentPost" :visible.sync="postDialogVisible" width="80%" class="z-overlay-3">
      <span>
        <h3>{{ currentPost.wpBlog_title }}</h3>
        <div class="row">
		  
          
		  <!-- Show all article images via FOR LOOP. HasMany Relation -->
          <div class="col-md-12" v-for="(img, i) in currentPost.get_images" :key=i>
              <p><img :src="`images/wpressImages/${img.wpImStock_name}`" class="img-thumbnail" alt=""></p>
          </div>
		  
        </div>
        <hr>
        <p> Text:    {{ currentPost.wpBlog_text }}</p>
		<p> Author:  {{ currentPost.author_name.name }}</p>                 <!-- {author_name}    is a model {function authorName}    BelongsTo relation -->
        <p>Category: {{ currentPost.category_names.wpCategory_name  }}</p>  <!-- {category_names} is a model {function categoryNames} BelongsTo relation -->

	  </span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="postDialogVisible = false">Okay</el-button>
      </span>
    </el-dialog>
    <!-- END Hidden modal window {ElementUI 'element-ui}(installed separately by npm) , will pop-up visible on click showing 1 full article -->



        </div>
        <!------------ END Authorized/Logged Section -----------------> 

	</div>
</template>

<script>
    import { mapState } from 'vuex';
	export default{
		name:'new_2021',
        props: ['tokenZZ'],
		data (){
			return{
				title:'Blog_931_2021',
                postDialogVisible: false,
                currentPost: '',
                ifMakeAjax: true,
			}
		},
        
          
         
        //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.
        computed: {
            ...mapState(['posts']), //is needed for Vuex store, after it u may address Vuex Store value as {posts} instead of {this.$store.state.posts}
	
	        //mine test, not must-have, CONFIRM DELETE?????
	        checkStore() {
                console.log('Go');
                console.log("This => " .this.$store.state.posts);
		        return this.$store.state.posts;
		        //return [{"wpBlog_id":1,"wpBlog_title":"Article 1", "wpBlog_text":"Text 1"}, {"wpBlog_id":2,"wpBlog_title":"Article 2", "wpBlog_text":"Text 2"}]
            },
	        //mine  
        },
  
        //before mount
        beforeMount() {
            //Passport token check
            if(this.$store.state.passport_api_tokenY == null){
                swal("Access denied", "You not logged", "error");
                return false;
            }
            console.log("beforeMount");
            //if(this.ifMakeAjax === true /*!this.$store.state.posts*/){
            if(Object.keys(this.$store.state.posts).length < 1){ //if {posts} already exists in Vuex Store
               //run ajax in Vuex store
                console.log('BeforeMount: Making ajax is authorized');
                this.$store.dispatch('getAllPosts'); //trigger ajax function getAllPosts(), which is executed in Vuex store to REST Endpoint => /public/post/get_all
	        } else{
                console.log("BeforeMount: Alreday loaded");
            }
            
        },
  
  
  
        //CONFIRM DELETE THIS SECTION
        //check if prev URL was '/details-info/2', if True, don't make ajax request again, as u are back from details-info
        beforeRouteEnter (to, from, next) { //the target Route Object being navigated to,  the current route being navigated away from., this function must be called to resolve the hook
            console.log("beforeRouteEnter " + from.path);

    
            next(vm => {
                var patternX = /details-info\/[0-9]+/g;  //RegExp
                if (patternX.test(from.path)){ 
                    vm.ifMakeAjax = false;
                    console.log("I'm from details. Dont do ajax!!!"); //vm.show = true;
                } else {
                    vm.ifMakeAjax = true;
                    console.log("From Details. Make ajax"); //vm.show = false; 
                }
                next();
            });
        }, 


        methods: {
            truncateText(text) {
                if (text.length > 24) {
                    return `${text.substr(0, 24)}...`;
                }
            return text;
            },
    
	        //set currentPost for viewing one article
            viewPost(postIndex) {
                const post = this.posts[postIndex];
                this.currentPost = post;
                this.postDialogVisible = true;
            },
    
            //Router
            goTodetail(prodId) {
                let proId = prodId+1;
                this.$router.push({name:'details-info',params:{Pidd:proId}}) //creates route like "/wpBlogVueFrameWork#/details/3"
            }, 
    



        },
    }


</script>

<style scoped>
.contact form{
	max-width: 40em;
	margin: 2em auto;
}
.contact form .form-control{
	margin-bottom: 1em;
}
.contact form textarea{
	min-height: 20em;
}	
</style>