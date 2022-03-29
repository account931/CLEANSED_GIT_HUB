<!-- Uses /subcomponents/register_form.vue  -->
<!-- Uses Vuex store: this.$store.state.passport_api_tokenY -->

<template>

    <div class="col-sm-12 col-xs-12 alert alert-info borderX">
        <center> 
            <!--<p> Vuex Getter: {{this.$store.getters.isLoggedIn}}</p>-->
		    <p> Login(Vuex state): {{ this.ifPassportTokenSet }}  </p> 
            
            <!-- If user is logged View -->
            <div v-if="this.$store.state.passport_api_tokenY !== null"> <!--auth check if Passport Token is set, i.e user is logged -->
                <p>You are now Logged as </p>
                <p> <i class="fa fa-address-card-o" style="font-size:24px"></i> {{ this.$store.state.loggedUser.name }} </p>
                <p> <i class="fa fa-envelope-o" style="font-size:24px"></i>     {{ this.$store.state.loggedUser.email }} </p>
                <p> click to Log Out </br> <button class="btn btn-success" @click="logMeOut"> Log out </button> </p>
            </div>
            
            <!-- Register Form -->
            <div v-else class="col-sm-12 col-xs-12 alert alert-danger">
                Not Logged
                <registration-auth-page> </registration-auth-page> <!-- Vue subcomponent (Register form) -->                  
            </div>
        </center>
    </div>

</template>

<script>
//using other sub-component 
import RegistrationPage from './subcomponents/register_form.vue';
export default {
    name: 'all-posts',
    
    //using other sub-component 
	components: {
          'registration-auth-page' : RegistrationPage,
    },
    data() {
        return {
        };
    },
  
    computed: { 
        //just to form text information
        ifPassportTokenSet() {
            if(this.$store.state.passport_api_tokenY != null){
                return " Passport Token is set, User is logged";
            } else {
                return " Passport Token is not set, login first";
            }
        },
        
        isLoggedInn(){ return this.$store.getters.isLoggedIn },

    },
    beforeMount() {},
    created(){
        //console.log("passport_api_tokenY type is " + typeof this.$store.state.passport_api_tokenY);
    },
    
    methods: {
        logMeOut(){
            this.$store.dispatch('LogUserOut'); //trigger Vuex function LogUserOut(), which is executed in Vuex store
            //drop store localStorage.setItem('tokenZ' + localStorage.setItem('loggedStorageUser' + this.$store.state.ifLogged
        },
    },
}
</script>