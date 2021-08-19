<!-- This is a Sub-component of Login_component.vue, used in \resources\assets\js\Wp_Login_Register_Rest\components -->
<!-- Uses Vuex store: this.$store.state.ifLogged -->

<template>

    <div class="col-sm-12 col-xs-12 alert alert-info borderX">
        <center>
		    <p> Login Vue </p>
        </center>
        
        
        <div class="form-group">
            <div v-if="status_msg" class="alert-danger alert" role="alert">
                {{ status_msg }}
            </div>
            
            <!-- Login Form -->
            <form class="login" @submit.prevent="loginSubmit">
                <h1>Sign in</h1>
                <p><i class="fa fa-external-link" style="font-size:36px"></i></p>
                
                <!-- Login: email -->
                <div class="col-md-6 form-group">
                    <label for="email" class="col-md-6 control-label">E-Mail Address</label>
                    <input required v-model="email" type="email" placeholder="Name"  class="form-control"/>
                </div>
                
               
                <!-- Password -->
                <div class="col-md-6 form-group">
                    <label for="password" class="col-md-6 control-label">Password</label>
                    <input required v-model="password" type="password" placeholder="Password" id="passwordd"  class="form-control"/>
                    <i class="fa fa-eye" id="passEye" @click="togglePassword" style="cursor:pointer;"></i>
                </div>
                
                <hr><br><br>
                <button type="submit" class="btn btn-info">Login <i class="	fa fa-folder-open-o" style="font-size:12px"></i></button>
            </form>
        </div>

    </div>

</template>

<script>

export default {
    name: 'all-posts',
    data() {
        return {
            email : "",
            password : "",
            status_msg: "", //validate error message
            status: "",
        };
    },
  
    //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.
    computed: { 
    },
    beforeMount() {

    },
    methods: {
    
        /*
        |--------------------------------------------------------------------------
        |Rest Api Login submit
        |--------------------------------------------------------------------------
        |
        |
        */
        loginSubmit (e) {
            e.preventDefault();
            if (!this.validateForm()) {
                return false;
            }
            
            let emailX    = this.email; 
            let passwordX = this.password;
            
            //Use Formdata to bind inpts 
            var thatX = this; //Fix for ajax //Explaination => if you use this.data, it is incorrect, because when 'this' reference the vue-app, you could use this.data, but here (ajax success callback function), this does not reference to vue-app, instead 'this' reference to whatever who called this function(ajax call)
            var formData = new FormData(); //new FormData(document.getElementById("myFormZZ"));
            formData.append('email',     this.email);
            formData.append('password',  this.password);
            
            $.ajax({
		        url: 'api/api_login', 
                type: 'POST', //POST is to create a new user
                cache : false,
                dataType    : 'json',
                processData : false,
                contentType: false,
                //contentType:"application/json; charset=utf-8",						  
                //contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                //contentType: 'multipart/form-data',
			    //crossDomain: true,
			    //headers: {'Content-Type': 'application/x-www-form-urlencoded', 'Authorization': 'Bearer ' + this.$store.state.api_tokenY},
                //headers: { 'Content-Type': 'application/json',  },
			    //contentType: false,
			    //dataType: 'json', //In Laravel causes crash!!!!!// without this it returned string(that can be alerted), now it returns object
           
			    //passing the data
                data: formData, 
		    
                success: function(data) {
                    //alert("success"); 
                    alert("success " +  JSON.stringify(data, null, 4));
                    
                    if(data.error_message){
                        swal("Failed", data.error_message, "error");
                        thatX.status_msg = data.error_message;
                    } else {
                        thatX.$store.dispatch('changeVuexStoreLogged', data); //working example how to change Vuex store from child component  
                    }
                     
                },  //end success
            
			    error: function (errorZ) {
                    alert("Crashed");
                    alert("error " +  JSON.stringify(errorZ, null, 4));                    
			  
			    }	  
            });                             
            //END AJAXed  part 
        },
        
        
        /*
        |--------------------------------------------------------------------------
        |Client-side form validation
        |--------------------------------------------------------------------------
        |
        |
        */
        validateForm () {
          
            if (!this.email) {
                this.status = false;
                this.showNotification('Email title cannot be empty');
                return false;
            }
            if (!this.password) {
                this.status = false;
                this.showNotification('Password cannot be empty');
                return false;
            }
      
            this.showNotification(''); //clears error messages if any prev
            return true;
        },
        
        
        showNotification (message) {
            this.status_msg = message;
            setTimeout(() => {  //clears message in n seconds
                this.status_msg = ''
            }, 3000 * 155)
        },
        
        
         
        /*
        |--------------------------------------------------------------------------
        |Toggles Password Visibility //eye icon in Password input 
        |--------------------------------------------------------------------------
        |
        |
        */
        togglePassword(){
            const password       = document.querySelector('#passwordd');
            const type           = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            document.getElementById("passEye").classList.toggle('fa-eye-slash');//HTML DOM property element.classList //classList.toggle => if css class exists, it acts as classList.remove (i.e remove class).  If class does not exist, it works as classList.add (i.e add class), 
        },
        
        
    },
}
</script>