//Switching windows between encrypt/decrypt to generating hash key
var reset_file = require('./clear_fields.js');  //clear fields

function switch_windows(){
	
  this.changeWindowsAction = function(){
      // On CheckBox change
      $('input[type="checkbox"]').on('change', function() { 
		  // Make sure that the oly checkbox is not unselected
		if ($('input:checked', $(this).parent()).length === 0) {
			$(this).prop('checked', true);
            return false; // this prevents from event triggering-> html-ing the div again
        }
		
		// Start Allow  to  checkBox  only  one  itembox at once;
        $('input[name="' + this.name + '"]').not(this).prop('checked', false); // });       
	   
	    //USING DIFFERENT FUNCTION INSIDE
	    //Init the drawing the relevant window, //Switching windows between encrypt/decrypt to generating hash key
		var changeWindow = new showRelevantWindow();
		changeWindow.traceCheckBoxSelection(this.id);

	   //reset fields on changing
		var reset = new reset_file();  //Module
		reset.clearFields();
		
	   });
   }

} //END function switch_windows()


//Switching windows between encrypt/decrypt to generating hash key
function showRelevantWindow(){
	
  this.traceCheckBoxSelection = function(passedID){
	 
		$(".random").fadeOut(1100); // hide all classes
		$("#" + passedID + "Div").show(2000); // show a div that matches checkbox ID + "Div" (i.e randListDiv, randIntegerDiv)
  }
}

module.exports = switch_windows;



