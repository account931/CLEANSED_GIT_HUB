//Loads or hide Instructions-------------------------------	
var scroll_file = require('./scrollZ.js'); 

function instructionX(){ 	
    this.setInstruction = function(){ 
        $("#hiddenInstructions").toggle(1000); //hideor show instructions
	  
        if ($("#instructionButton").attr("value")=="instructions") {
            $("#instructionButton").val(" _Close_ ");
        } else { 
		    $("#instructionButton").val("instructions");
	    }	
		
	    //scroll to div
	    var scrollX = new scroll_file();
	    scrollX.scrollResults("#hiddenInstructions");
   }
}

module.exports = instructionX;
	
	
	
	
