//NOT USED IN {Laravel_Vue_Blog_V6_Passport}, reassigned to /subcomponents/logged.vue
//How to Toggle Password Visibility //eye icon in Password input 

(function(){ //START IIFE (Immediately Invoked Function Expression)

$(document).ready(function(){
	
	
	//How to Toggle Password Visibility //eye icon
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     ** 
	    const togglePassword = document.querySelector('#togglePassword'); //eye icon
        const password       = document.querySelector('#password');
		
		togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash'); //HTML DOM property element.classList //classList.toggle => if css class exists, it acts as classList.remove (i.e remove class).  If class does not exist, it works as classList.add (i.e add class), 
        });
	
    // **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************	 
	
});
// end ready	
	
	
}()); //END IIFE (Immediately Invoked Function Expression)