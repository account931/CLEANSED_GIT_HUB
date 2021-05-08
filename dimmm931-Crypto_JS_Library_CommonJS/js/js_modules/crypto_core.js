//This is the core Module.

var CryptoJS = require("crypto-js");
var scroll_file = require('./scrollZ.js'); 
var UUID_file = require('./generate_uuid.js'); //my funct to generate random numbers

function crypto_core(){

 this.finalTextt = "";
 this.encr ="";
 this.comparePrevState = ""; //var to save prev user's input 
 
  //encrypting text data from user's input and using user's secret hash key
  this.encryptXX = function(){
	  
	   //If user has not input any data to encrypt
	   if (!$.trim($("#userDataX").val())){
		   swal("Failed, No input!", "Check your input!", "error"); 
		   return false;
	   }
	   
	    //If user has not input secret hash key, generate some random
	   if (!$.trim($("#userSecretKey").val())){
		   
		   //Sweet alert. Uses CallBack instead of Promise, to make sure it runs after clicking OK 
		   swal({ title: "You did not provide a secret hash key!", 
		       text: "Secret hash key will be generated automatically.", 
		       type: "warning", 
			   //button: "OK", 
		       showCancelButton: true, 
			   confirmButtonClass: "btn-danger",
		   },
		   function(valueX){
			   if(valueX){ //if click OK
			       var UUID = new UUID_file();
	               var randomKey = UUID.generate_UUID();
		           $("#userSecretKey").val(randomKey);
				   proceedCrypting();
				   
			   } else {//if click cancel
			   }
           });
		   //end Swall callback 
       
       //if user printed  secret hash key   
	   } else {   
		   proceedCrypting();
	   }
		   
		
	   //core CryptoJS is here
	   function proceedCrypting (){
	       //prevent user to encrypt the encrypted result, when users encrypted and then instead of DECRYPT button mistakenly press ENCRYPT
	       if(crypto_core.comparePrevState == $.trim($("#userDataX").val())){
		       swal({title: "Are you sure?", 
			         text: "Are you Sure you want to encrypt again the already encrypted data instead of decryption?  May be you want to Decrypt?",
			         type: "warning", 
					 showCancelButton: true,
					 confirmButtonClass: "btn-danger",
               },
			   function(valueConfirm){
			       if(valueConfirm){ //if click OK
				       goProceed_Part_2();
			       } else {   
			          alert('Request terminated');
			       }
               });
		   
		   } else { //when result & input are not the same
			   goProceed_Part_2();
		   }
	    } 
		   
        function goProceed_Part_2(){  //used inside proceedCrypting()
	        var my_encrypted = CryptoJS.AES.encrypt($("#userDataX").val(), $("#userSecretKey").val()); //message to encrypt, your secret Key
	        crypto_core.comparePrevState = my_encrypted; //assign encrypted message to global var to access it from this.decryptX = function(){
	        crypto_core.finalTextt = "<h3 style='word-break: break-all'>" + my_encrypted + "</h3>";
	   
	        if ($("#copyResultButton").length > 0) { //if Button "Copy" already exsits, remove it. To prevent multiple appending
               //it doesn't exist
			   $("#copyResultButton").remove();
            }
		  
		    if ($(".flashMessage").length > 1) { //if .flashMessage more than 1, remove the rest, except for the first
                  //it doesn't exist
	              $(".flashMessage:not(:eq(0))").remove(); 
            }
	   
	        //html the results
	        $("#resultFinal").stop().fadeOut("slow",function(){ //with animation
               $(this).css({border: "1px solid black", padding:"1em"});		   
	           $(this).html(crypto_core.finalTextt);
		       $(this).after('<div class="col-sm-12 col-xs-12"><button type="button" id="copyResultButton">Copy<i class="fa fa-files-o"></i></button> <span class ="flashMessage"></span></div>'); //append button "Copy"
		    }).fadeIn(2000); //html the result 
	   
	        //scroll to
	        var scrollX = new scroll_file();
	        scrollX.scrollResults("#resultFinal");
		} //End function goProceed_Part_2()  
      
   },
   
   
   
   //decrypting text data from user's encrypted input and using user's secret hash key
   this.decryptX = function(){
	    //If user has not input any data to encrypt
	   if (!$.trim($("#userDataX").val()) || !$.trim($("#userSecretKey").val()) ){
		   swal({ title: "No sufficient input detected for decryption!", text: "Enter your decrypted data and secret key", type: "error", button: "OK",}); //Sweet alert 
		   //alert("No input");
		   return false;
	   }
	   
	  //var descr2 = CryptoJS.AES.decrypt(crypto_core.encr.toString(), "SecretKey"); 
	  var descr2 = CryptoJS.AES.decrypt($.trim($("#userDataX").val()).toString(), $("#userSecretKey").val()); //message to decrypt, your secret Key
      var descryptedFinal = descr2.toString(CryptoJS.enc.Utf8);
	  
	  if(!descryptedFinal){descryptedFinal = "<span class='errorX'>Error, secret key doesn't match your encrypted data  <i class='fa fa-battery-1'></i></span> ";}
	  crypto_core.finalTextt = "<h3 style='word-break: break-all'>" + descryptedFinal + "</h3>";
	  $("#resultFinal").stop().fadeOut("slow",function(){ $(this).html(crypto_core.finalTextt)}).fadeIn(2000);
      
	  var scrollX = new scroll_file();
	   scrollX.scrollResults("#resultFinal");;
   } 

} 

module.exports = crypto_core;