var scroll_file = require('./scrollZ.js'); 

function clear_fields(){
	
  this.clearFields = function(){
      $("#hiddenInstructions").hide(2000);
      $("#userSecretKey").val('');
	  $("#userDataX").val('');
	  $("#resultFinal").hide(1000);
      $("#resultFinal").html('');
	  $("#copyResultButton").hide(1000); //hide button COPY for Result
			
	  //scroll to top
	  var scrollX = new scroll_file();
	  scrollX.scroll_toTop();
   }

}

module.exports = clear_fields;
