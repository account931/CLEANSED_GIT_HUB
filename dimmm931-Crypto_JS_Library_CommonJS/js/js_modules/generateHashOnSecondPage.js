//The second hidden page, Clic on "Generates random hash Key"

var UUID_file = require('./generate_uuid.js'); //my funct to generate random numbers
var scroll_file = require('./scrollZ.js'); 

function generateHashOnSecondPage(){

  this.generateRandomKey = function(){ 
     var UUID = new UUID_file();
	 var randomKey = UUID.generate_UUID();

	 if ($("#copyResultButton").length > 0) { //if Button "Copy" already exsits, remove it. To prevent multiple appending
         //it doesn't exist
	     $("#copyResultButton").remove();
      }
	   
	 if ($(".flashMessage").length > 1) { //if .flashMessage more than 1, remove the rest, except for the first
         //it doesn't exist
	     $(".flashMessage:not(:first)").remove(); 
      }
	  
	  $("#resultFinal").stop().fadeOut("slow",function(){ //with animation
           $(this).css({border: "1px solid black", padding:"1em"});		   
	       $(this).html(randomKey);
		   $(this).after('<div class="col-sm-12 col-xs-12"><button type="button" id="copyResultButton">Copy<i class="fa fa-files-o"></i></button> <span class ="flashMessage"></span></div>'); //append button "Copy"
	 }).fadeIn(2000); //html the result 
	 
	 //scroll to
	  var scrollX = new scroll_file();
	  scrollX.scrollResults("#resultFinal");
   }

} 

module.exports = generateHashOnSecondPage;