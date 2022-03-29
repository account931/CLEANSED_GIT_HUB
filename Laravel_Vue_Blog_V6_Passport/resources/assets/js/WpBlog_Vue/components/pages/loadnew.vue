<!-- create new post record -->
<template>
    <div :key="componentKey" class="card mt-4">
        <div class="card-header row">
            <div class="col-sm-5 col-xs-5">
                <p style="float:right;"><i class="fa fa-window-restore" style="font-size:84px"></i></p>
            </div>
            <div class="col-sm-7 col-xs-7">
                <h3 style="float:left;">Create New Post </h3>
            </div>
        </div>
    
    
        <!--------- Unauthorized/unlogged Section ------> 
        <div v-if="this.$store.state.passport_api_tokenY == null" class="col-sm-12 col-xs-12 alert alert-info"> <!--auth check if Passport Token is set, i.e user is logged -->
            <!-- Display subcomponent/you_are_not_logged.vue -->
            <you-are-not-logged-page></you-are-not-logged-page>         
        </div>
        
        
        <!--------- Authorized/Logged Section ----------> 
        <div v-else-if="this.$store.state.passport_api_tokenY != null">
            <div class="card-body">
                <div
                    v-if="status_msg"
                    :class="{ 'alert-success': status, 'alert-danger': !status }"
                    class="alert" role="alert"
                >
                    {{ status_msg }}
                </div>
        
        
                <!-- Display Validation errors if any come from Controller Request Back-end validator -->
                <div v-for="(book, i) in booksGet " :key="i" class="alert alert-danger"> 
                    Error: {{ book }} 
                </div>
        
	            <!-- Form -->
                <form id="myFormZZ">
	                <input type="hidden" name="_token" :value="tokenXX" /> <!-- csfr token -->
		
		            <!-- Post Title -->
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input id="title" v-model="title" type="text" class="form-control" placeholder="Post Title" required>
                    </div>
        
                    <!-- Post Body -->
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Post Content</label>
                        <textarea id="post-content" v-model="body" class="form-control" rows="3" placeholder="Body Title" required />
                    </div>
        
        
                    <!-- Select category -->
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Category</label>
        
                        <select name="category_sel" class="mdb-select md-form" v-model="selectV">
				            <option  disabled="disabled"  selected="selected">Choose category</option>
                            <!-- Loop -->
				            <option v-for="(book, i) in this.categoriesList " :key="i" :value="book.wpCategory_id"  > {{ book.wpCategory_name}} </option>
		                </select>
		            </div>					

                                
                    <div>  
                        <!-- Element-UI Upload element (contains "+" button to add new image and contains thumbnails views of loaded images) -->
                        <!--ref="upload" is used to fire  clearFiles() in <el-upload> on ajax success -->
                        <el-upload
                            action="https://jsonplaceholder.typicode.com/posts/"
                            ref="upload"
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :before-remove="beforeRemove"
                            :on-change="updateImageList"
                            :auto-upload="false"
                        >
                            <i class="el-icon-plus" />
                        </el-upload>
          
                        <!-- Element-UI Preview Uploaded element (if u hover over it, there appears "+"/"delete" icons, if u click "+" icon the full-screen image pop-up'll emerge, pop-up is hidden by dafault) -->
                        <el-dialog :visible.sync="dialogVisible">
                            <img width="100%" :src="dialogImageUrl" alt>
                        </el-dialog>
                    </div>
                </form>
            </div>
    
            <div class="card-footer">
                <!--Button to submit -->
                <button type="button" class="btn btn-success" @click="createPost">
                    {{ isCreatingPost ? "Posting..." : "Create Post" }}
                </button>
      
                <!--Button to clear the fields -->
                <button type="button" class="btn btn-success" @click="clearInputFieldsAndFiles">
                    Clear
                </button>
            </div>
        </div>
        <!--------- Authorized/Logged Section ----------> 
    </div>
</template>

<style>
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.avatar-uploader .el-upload:hover {
    border-color: #409eff;
}
.avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
}
.avatar {
    width: 178px;
    height: 178px;
    display: block;
}
</style>


<script>
    import { mapActions } from 'vuex';
    import { mapState } from 'vuex';
    //using other sub-component 
    import youAreNotLogged  from '../subcomponents/you_are_not_logged.vue';
    export default {
        name: 'CreatePost',
        //using other sub-component 
	    components: {
            'you-are-not-logged-page' : youAreNotLogged,
        },
        //props: ['categorrrv'], //passed in view 
        data () {
        return {
            dialogImageUrl: '',
            dialogVisible: false, //flag
            imageList: [],        //stores uploaded images
            status_msg: '',
            status: '',
            isCreatingPost: false,//flag
            title: '',  //form input "Title"
            body: '',   //form input "Body"
            selectV: '',//form input <select> 
            componentKey: 0,
	        tokenXX:'',
            errroList: [], //list of validations errors of server-side validator
            categoriesList: [], //contains Categories from DB (loaded with ajax)
        }
        },
        computed: {
            //...mapState(['errroList']), 
            booksGet () { //compute Back-end validation errors
                return this.errroList;
            }      
        },
    
        //before mount
        beforeMount() { },
    
    
        mounted () {
            //Passport token check
            if(this.$store.state.passport_api_tokenY == null){
                swal("LoadNew says: Access denied", "You are not logged", "error");
                return false;
            }
            let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta tag with csrf //NOT USED?????
	        this.tokenXX = token.content; //gets csrf token and sets it to data.tokenXX //NOT USED?????
            this.getAjaxCategories(); //get /GET all DB table categories (to build <select> in loadnew.vue)
        },
        created(){
        },
  
        methods: {
            ...mapActions(['getAllPosts']),
    
    
    
        // =============== Start of Element-UI Upload element METHODS ============
    
        //on adding new image to form, do update array {this.imageList} (used to store all form uploaded images & appended to form)
        updateImageList (file) {
             this.imageList.push(file.raw);
             //console.log(this.imageList);
        },
	    
        //if u click "Preview" icon in Element-UI image Layout
        handlePictureCardPreview (file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;//show pop-up with image
        },
    
        //if u click "Delete" icon in Element-UI image Layout
        handleRemove(file){
            //alert("Delete " + file.uid); //https://www.programmersought.com/article/73755547037/
            for(var i = 0; i < this.imageList.length; i++){
                if(file.uid == this.imageList[i].uid){
                    this.imageList.splice(i, 1);
                }
            }
        },
    
        beforeRemove(file){
        },
	
        // =============== End  of Element-UI Upload element METHODS ============

    
    
    
       
              
           
        /*
        |--------------------------------------------------------------------------
        | When user clicks Form submitting (create new post)
        |--------------------------------------------------------------------------
        |
        |
        */
        createPost (e) {
            e.preventDefault();
            if (!this.validateForm()) {
                return false;
            }
	  
	        //Form 
            this.isCreatingPost = true;
      
            //Use Formdata to bind inpts and images upload
            var that = this; 
            var formData = new FormData(); 
            formData.append('title', this.title);
            formData.append('body',  this.body);
            formData.append('selectV', this.selectV);
      
            var imagesUploaded = {};
            $.each(this.imageList, function (key, imageV) {
                formData.append(`imagesSet[${key}]`, imageV);
                //imagesUploaded.push(`images[${key}]`, imageV);
                //imagesUploaded.test = imageV;
            });
	        
            //console.log(this.imageList)
	        //console.log(formData);

            //Add Bearer token to headers
            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer '  + this.$store.state.passport_api_tokenY
                }
            }); 
      
		    $.ajax({
		        url          : 'api/post/create_post_vue', 
                type         : 'POST', //POST is to create new post
                cache        : false,
                dataType     : 'json',
                processData  : false,
                contentType  : false,
			    //passing the data
                data: formData, //dataX//JSON.stringify(dataX)  ('#createNew').serialize()
                success: function(data) {
                    if(data.error == true ){ //if Rest API endpoint returns any predefined validation error
                        var text = data.data;
                        swal("Check", text, "error");
                    
                        //if validation errors (i.e if REST Contoller returns json ['error': true, 'data': 'Attention, validation failed', 'validateErrors': title['Validation err text'],  body['Validation err text']])
                        if(data.validateErrors){
                            var tempoArray = []; //temporary array
                            for (var key in data.validateErrors) { //Object iterate
                                var t = data.validateErrors[key][0]; //gets validation err message, e.g validateErrors.title[0]
                                tempoArray.push(t);
                            }
                            that.errroList = tempoArray; 
                        }
                        
                    //if load new is OK
                    } else if(data.error == false){
                        var tempoArray = []; 
                        that.errroList = tempoArray; //clears validationn errors if any. Simple that.errroList = [] won't work
                        //swal("Good", "Bearer Token is OK", "success");
                        swal("Good",  data.data, "success");
                        
                        //clear the form fields after successfull saving
                        that.clearInputFieldsAndFiles();
                    }
			        that.isCreatingPost = false; //change button text            
                },  
            
			    error: function (errorZ) {
                    console.log(errorZ);
              
                    //Unlog (log out) the user if  dataZ.error == "Unauthenticated." || 401, otherwise if user has wrong password token saved in Locals storage, he will always recieve error and neber log out                  
                    //{responseJSON} is an object property, formed by Passport (if no token is sent, ie. unauthorized), i.e response is like =>  responseJSON: {error: "Unauthenticated."}  
                    //use responseJSON as error section does not return my predifinied json, but automatic by Laravel
					if(errorZ.responseJSON != null){
						if (errorZ.responseJSON.error == "Error: Request failed with status code 401" ||  errorZ.responseJSON.error == "Unauthenticated."){ //if Rest endpoint returns 401 error
                            //Unlog the user if dataZ.error == "Unauthenticated." || 401, otherwise if user has wrong password token saved in Locals storage, he will always recieve error and neber log out                  
                            //store.dispatch('LogUserOut');//this.$store.dispatch('LogUserOut'); //trigger Vuex function LogUserOut(), which is executed in Vuex store
                            that.$store.dispatch('LogUserOut'); //reset state vars (state.passport_api_tokenY + state.loggedUser) via mutation
                            swal("Unauthenticated", "Check Bearer Token", "error");
                        } else { 
                            swal("Error", "Something crashed", "error"); 
                        }
                    }
                    that.isCreatingPost = false; //change button text   
			    }	  
            });                             
        },
	
        
        /*
        |--------------------------------------------------------------------------
        |GET all DB table categories (to build <select> in loadnew.vue)
        |--------------------------------------------------------------------------
        |
        |
        */
	    getAjaxCategories(){
            fetch('api/post/get_categories', { /* /public/post/get_categories */
                method: 'get',
                //pass Bearer token in headers ()
                headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + this.$store.state.passport_api_tokenY },

            }).then(response => {
                $('.loader-x').fadeOut(800);  //hide loader
                return response.json();
            }).then(dataZ => {
                //console.log("Categories => " + dataZ); 
                if(dataZ.error == true|| dataZ.error == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                    swal("Unauthenticated", "Check Bearer Token", "error");
                } else if(dataZ.error == false){
                    swal("Done", "Categories are loaded.", "success");
                    this.categoriesList = dataZ.data;
                    //console.log("Categ " + this.categoriesList[0].wpCategory_name);
                }
            })
	        .catch(function(err){
                swal("Crashed", "You are in catch", "error");
            }); 
      
        },
    
	
	    /*
        |--------------------------------------------------------------------------
        |Client-side form validation
        |--------------------------------------------------------------------------
        |
        |
        */
        validateForm () {
            // no vaildation for images - it is needed
            if (!this.title) {
                this.status = false
                this.showNotification('Post title cannot be empty')
                return false
            }
            if (!this.body) {
                this.status = false
                this.showNotification('Post body cannot be empty')
                return false
            }
            
            if (!this.selectV) {
                this.status = false;
                this.showNotification('Select cannot be empty');
                return false;
            }
      
            this.showNotification(''); //clears error messages if any
            return true
        },
        
        
        showNotification (message) {
            this.status_msg = message;
            setTimeout(() => {  //clears message in n seconds
                this.status_msg = ''
            }, 3000 * 155)
        },
        
        //clears inputs including uploaded files
        clearInputFieldsAndFiles(){
            this.title    = '';
            this.body     = '';
            this.selectV  = '';
            this.imageList = '';
            this.$refs.upload.clearFiles(); //clears the <el-upload> uploaded files <el-upload> must contain {ref="upload"}
                        
        }
    },
  
  
    mutations: {
    },
     
}
</script>
