var crypt_CORE = require('./js_modules/crypto_core.js');
var switch_file = require('./js_modules/switch_windows.js');  //Switching windows between encrypt/decrypt to generating hash key
var instruct_file = require('./js_modules/instructionZ.js');  //Loads or hide Instructions
var copy_file = require('./js_modules/copy_process.js');      //Loads or hide Instructions
var reset_file = require('./js_modules/clear_fields.js');     //clear fields
var changeTheme_file = require('./js_modules/changeStyleTheme.js');           //change css Theme
var generateHash_file = require('./js_modules/generateHashOnSecondPage.js');  //generate hash key on the second hidden page

//Crypto library itself
var AES = require("crypto-js/aes");
var SHA256 = require("crypto-js/sha256");
var CryptoJS = require("crypto-js");


//Encrypt)

$(document).ready(function(){

 
//Core encrypting/decrypting  
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
    //Encrypt
    $("#encryptButton").click(function(){ 
        var encr = new crypt_CORE();  //Module
		encr.encryptXX();
	});
	  
	  
	//Decrypt
    $("#decryptButton").click(function(){ 
        var decr = new crypt_CORE();  //Module
		decr.decryptX();
	});
		
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
 

 
 
 
//Switching windows between encrypt/decrypt to generating hash key
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
   
    var switchModule = new switch_file();  //Module
    switchModule.changeWindowsAction();
		
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
 

 

 //Load or hide Instructions
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
    
	var instruct = new instruct_file();  //Module
	$("#instructionButton").click(function(){ 
		instruct.setInstruction();
	});
	
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************
 

 

 
 //Copy the secret hash key to clipboard
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
    $("#copyme").click(function(){ 
		var copy = new copy_file();  //Module
		copy.copy_to_clipboard('userSecretKey', 'value'); //args(id of div to copy, use value(for input) or innerText(for div))
	});
	
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************



//Copy the encrypted/decrypted RESULT data to clipboard
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
	$(document).on("click", '#copyResultButton', function() {   
		var copy = new copy_file();  //Module
		copy.copy_to_clipboard('resultFinal', 'innerText'); //args(id of div to copy, use value(for input) or innerText(for div))
	});
	
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************





 //Clearing the fields, i.e RESET
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
    $("#clearButton").click(function(){ 
		var reset = new reset_file();  //Module
		reset.clearFields();
	});
	
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************



 //Change the theme button
// **************************************************************************************
// **************************************************************************************
//                                                                                     **

	var changeThemeCss = new changeTheme_file();  //Module
	changeThemeCss.switchTheme();

// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************




//The second hidden page, Clic on "Generates random hash Key"
// **************************************************************************************
// **************************************************************************************
//                                                                                     **
    $("#generatehashKey").click(function(){ 
	    var hashKeyOnSecondPage = new generateHash_file();  //Module
		hashKeyOnSecondPage.generateRandomKey();
		
	});
	
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************


});