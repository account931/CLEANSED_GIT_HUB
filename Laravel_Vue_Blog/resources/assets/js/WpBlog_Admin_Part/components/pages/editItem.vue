<template>
	<div class="services">
		<h1>{{title}} number <b> {{this.currentDetailID}}</b></h1>
        <!-- Ling go back -->
		<p class="z-overlay-fix-2"> <router-link class="nav-link" to="/list_all"><button class="btn">Back to List all <i class="fa fa-tag" style="font-size:14px"></i></button></router-link></p>

        
        <!-- V loop over ajax success data -->
        <p> You are editing item with title:  <i class="text-danger"><b> {{this.inputTitleValue}}  </b></i></p>
        <!-- End V loop over ajax success data -->
        
        
        <!-- Display Loaded images -->
        <div v-for="(imageXX, i) in imggGet " :key="i" class="alert alert-success"> 
            <div class="col-sm-12 col-xs-12"  v-if="i  == 0"> <p> Item's images </p></div>
            <img v-if="imggGet.length" class="card-img-top my-adm-img" :src="`images/wpressImages/${imageXX}`"/>
            <button style="font-size:11px" class="btn btn-danger"  @click="deleteBDImage(imageXX)"> Delete <i class="fa fa-trash-o"></i></button>

        </div>
        
       
      
        
        
        <!------- INJECTED ------->
        <div class="card-body">
        <div
          v-if="status_msg"
          :class="{ 'alert-success': status, 'alert-danger': !status }"
          class="alert" role="alert"
        >
            {{ status_msg }}
		
        </div>
        
	  
        <!-- Display errors if any come from Controller Request Php validator -->   
        <div v-for="(book, i) in ValidorErrorGet " :key="i" class="alert alert-danger"> 
            Error: {{ book }} 
        </div>
        
        
	    
	  
      <form id="myFormZZ">
	    <input type="hidden" name="_token" :value="tokenXX" /> <!-- csfr token -->
		<!--<input type="hidden" name="_token" value="4gyBcsEYlPibNHfhi1r55rRQAZkBWepxCmVLlqAW" />-->
		
		<!-- Title -->
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input id="title" type="text" class="form-control" placeholder="Post Title" v-model="inputTitleValue" required>
        </div>
        
        <!-- Body -->
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Post Content</label>
          <textarea id="post-content" v-model="inputBodyValue" class="form-control" rows="3" required />
        </div>
        
        <div class>
          
          <!-- Element-UI Upload element -->
          <el-upload
            action="https://jsonplaceholder.typicode.com/posts/"
            list-type="picture-card"
            :on-preview="handlePictureCardPreview"
            :on-change="updateImageList"
            :auto-upload="false"
          >
            <i class="el-icon-plus" />
          </el-upload>
          
          <!-- Element-UI Preview Uploaded element -->
          <el-dialog :visible.sync="dialogVisible">
            <img width="100%" :src="dialogImageUrl" alt>
          </el-dialog>
          
        </div>
      </form>
    </div>
    <div class="card-footer">
      <button
        type="button"
        class="btn btn-success"
        @click="editOnePost"
      >
        {{ isCreatingPost ? "Updating..." : "Edit Post" }}
      </button>
    </div>
  </div>
  
  
   
   <!-- INJECTED -->
  
  
  
     
       
        
  
	</div>
</template>

<script>
    import { mapState } from 'vuex';
	export default{
		name:'edit-one-item',
		data (){ 
			return{
				title:'Edit one item',
                ajaxOneItem: [], /*[{wpBlog_title:'bl', wpBlog_text:'bl-text', wpBlog_author:1, get_images:[{wpImStock_id:56, wpImStock_name:"product2.png"}] ],*/
			    currentDetailID: 0, //Id of edited blog
                tokenXX:'', //csrf token
                imageList: [], //store form uploaded images
                isCreatingPost: false, //flag
                dialogVisible: false, //flag
                dialogImageUrl: [{uid: 1625318532554, name: "2254.png", size: 30871, type:"image/png", uid: 1625318532554, lastModified: 1613050553593}], //'',   //contains images to display as loaded
                status_msg: '',
                status: '',
                errroList: ['validation error 1'], //list of errors of php validator
                inputTitleValue: "",  //contains loaded edited item's title (from DB)
                inputBodyValue: "",   //edited item's body (from DB)
                inputImagesValueX: [],   //edited item's images (loaded from DB)
            }
		},
        
        
        computed: {
            
            ValidorErrorGet() { //make reactive ajax response 
                return this.errroList;
            },
            
            //Not used???
            booksGet() { //make reactive ajax response 
                return this.ajaxOneItem;
            },
            //images already loaded to DB
            imggGet() { //make reactive ajax response 
                return this.inputImagesValueX;
            }
           
        },
        
        
        beforeMount() {
            //getting route ID => e.g "wpBlogVueFrameWork#/details/2", gets 2. {Pid} is set in 'pages/home' in => this.$router.push({name:'details',params:{Pid:proId}})
	        var ID = this.$route.params.PidMyID; //gets 2
	        this.currentDetailID = ID; // 
            alert(this.currentDetailID);
            
            //get the csrf token
            let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta tag with csrf
            this.tokenXX = token.content; //gets csrf token and sets it to data.tokenXX
            
             
            
            //run ajax to get One item
            this.runAjaxToGetOneItem(this.currentDetailID);            
        }, 
        
        
        methods: {
        
            //INJECTED
            updateImageList (file) {
                this.imageList.push(file.raw);
                console.log(this.imageList);
            },
	
            handlePictureCardPreview (file) {
                alert('preview');
                this.dialogImageUrl = file.url;
                this.imageList.push(file);
                this.dialogVisible = true;
            },
            //END INJECTED
            
            deleteBDImage(imageName){
                alert(imageName);
                //implement updating images List to append
            },
            
            //ajax to get 1 item data (to use in edit form)
            runAjaxToGetOneItem(idZ) {     
                var that = this;
                alert('start one');
                $('.loader-x').fadeIn(800); //show loader
               
                //Add Bearer token to headers
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + this.$store.state.api_tokenY
                    }
                }); 
      
		        $.ajax({
		            url: 'api/post/admin_get_one_blog/' + idZ , 
                    type: 'GET', //
            
                    cache : false,
                    dataType    : 'json',
                    processData : false,
                    contentType: false,
                    //contentType:"application/json; charset=utf-8",						  
                    //contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                    //contentType: 'multipart/form-data',

			
			        //passing the data
                    //data: {  _token: this.tokenXX, }, //csrf token, though here is not required
		    
                    success: function(data) {
                        alert("success");            
                        alert("success" + JSON.stringify(data, null, 4));
                
                        if(data.error == true ){ //if Rest endpoint returns any predefined error
                            var text = data.data;
                            swal("Check", text, "error");
              
                  
                        } else if(data.error == false){
                            //return commit('setPosts', data ); //sets ajax results to store via mutation
                            that.ajaxOneItem = data.data; 
                            that.inputTitleValue = data.data[0].wpBlog_title; //gets blog title
                            that.inputBodyValue  = data.data[0].wpBlog_text; //gets blog text
                            
                            //adding images loaded from DB
                            $.each(data.data[0].get_images, function (key, imageV) {
                                that.dialogImageUrl   = "images/wpressImages/" + imageV.wpImStock_name;
                                var b = /*"images/wpressImages/" +*/ imageV.wpImStock_name;
                                that.inputImagesValueX.push(b); 
                            });
                            //that.dialogVisible = true;
                            console.log(that.dialogImageUrl);
                            console.log("imVal " + that.inputImagesValueX);
                            
                            
                            console.log("LISTT1: " + data.data);
                            var tempoArray = []; 
                            swal("Good", "Bearer Token is OK", "success");
                            swal("Good",  data.data, "success");
                        }
                        $('.loader-x').fadeOut(800); //show loader
                    },  //end success
            
			        error: function (errorZ) {
                        alert("Crashed"); 
			            alert("error" +  JSON.stringify(errorZ, null, 4));
                        console.log(errorZ.responseText);
                        console.log(errorZ);
                
                        /*
                        if (errorZ.status == 422) {
                            swal("Error", "Validation crashed", "error");  
                        }*/
                
                        if(errorZ.responseJSON != null){
                            if(errorZ.responseJSON.error == true || errorZ.responseJSON.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                                swal("Error: Unauthenticated", "Check Bearer Token", "error");  
                            } 
                        }
                        swal("Error", "Something crashed", "error");  
                        $('.loader-x').fadeOut(800); //hide loader
                
			        }	  
                });                             
                //END AJAXed  part
            
            },
            
            //ajax to update one post
            editOnePost(){
            },
            
     
        },
        
        
        mutations: {
        },
        
	}
</script>

<style scoped>
	
</style>