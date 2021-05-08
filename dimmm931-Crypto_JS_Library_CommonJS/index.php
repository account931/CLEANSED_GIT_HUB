<!doctype html>
    <html lang="en-US">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="Content-Type" content="text/html">
            <meta name="description" content="Crypto-js" />
            <meta name="keywords" content="Crypto-js, encrypt Crypto-js, decrypt ">
            <title>Crypto-js</title>
  
            <!--Favicon-->
            <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Fa fa lib -->

            <link rel="stylesheet" type="text/css" media="all" href="css/myEncryptCss.css">
	        <link rel="stylesheet" type="text/css" media="all" href="css/changeTheme.css">
	        <link rel="stylesheet" type="text/css" media="all" href="css/sideNavFullScreenMenu.css"> <!-- sideNavFullScreenMenu CSS -->
	  
	        <!--  use SweetAlert for Bootstrap  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
            <!--use SweetAlert for Bootstrap-->
	  
            <script src="dist/js/bundle_js.js"></script><!--  Core  COMMON JS-->
	        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
            <!-----------------------------------   sideNavFullScreenMenu ----------------------------------> 	
            <span class="buttonX" style="font-size:30px;cursor:pointer; position:absolute; top:0px; left:0px;" onclick="openNav()">&#9776; </span> <!-- button to open menu-->

            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content">
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Clients</a>
                    <a href="#">Contact</a>
                </div>
            </div>
	

            <script>
            function openNav() {
                document.getElementById("myNav").style.height = "100%";
            }

            function closeNav() {
               document.getElementById("myNav").style.height = "0%";
            }
            </script>
            <!----------------------------------- END sideNavFullScreenMenu ---------------------------------->    
	 

            <div id="headX" class="jumbotron text-center gradient head-style"> <!--#2ba6cb;-->
                <h1 id="h1Text"> <span id="textChange"> Crypto-js</span></h1>
                <p class="header_p">generates encrypted and decrypted data based on secret key, etc <span class="glyphicon glyphicon-wrench"></span></p> 
	        </div>

            <div class="item contact padding-top-0 padding-bottom-0" id="contact1">
                <div class="wrapper grey">
    	            <div class="container">
                        <div class="checkbox"> <!-- Checkbox ID will be used in JS to form div ids (randListDiv,etc) -->
                            <label><input type="checkbox" value="" name="r" id="randList" checked >Encrypt/decrypt</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                <label><input type="checkbox" value="" name="r" id="randInteger">Generate hash key</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
			
			            <!--------------- START PAGE 1 (main page with form)  ------------------------>
			            <div class="col-md-12 col-sm-12 col-xs-12 random" id="randListDiv">      

                            <!----------- TextArea Form  Start -------------------->
    		                <p> Encrypt <span class="span-small"> &nbsp;</span>&nbsp;<span class='glyphicon glyphicon-retweet'></span></p>
    		                <form role="form">  	
    		                    <div class="form-group">
				                    <label for="intMin">Your secret key:</label>
					                <input type="text" class="form-control" id="userSecretKey" placeholder="Your Key"/><!--User's secret key-->
					                <button type="button" id="copyme">Copy key <i class="fa fa-space-shuttle"></i></button> <span class ="flashMessage"></span>
				                </div>
				                <div class="form-group"> <!--User's data input to encrypt-->
    		                        <textarea class="form-control" rows="6" placeholder= "Your data here...." id="userDataX"></textarea><!-- open and close tag must be on the same line, otherwise placeholder won't work-->  		  				  			
    		                    </div>
    			            </form>	  		
 
                            <!---------------------------- BUTTONS ------------------------------------>
					        <br>
					         <div class="col-md-8"  id="" style="margin-top:33px;">   				
    				            <button id="encryptButton" type="button" class="btn btn-primary btn-embossed btn-lg btn-wide bt-mobile-mine">Encrypt</button>
						        <button id="decryptButton" type="button" class="btn btn-danger btn-embossed btn-lg btn-wide bt-mobile-mine">Decrypt</button>
                                <button id="clearButton" type="button"  class="btn btn-success btn-embossed btn-lg btn-wide bt-mobile-mine">Reset</button >
                                <button id="instructionButton" type="button" class="btn btn-warning btn-embossed btn-lg btn-wide bt-mobile-mine">Instructions</button>
    				        </div>
    		            </div><!-- /.col-md-5 --> 
                        <!--------------------------  END PAGE 1 (main page with form)  -------=----------------------->
  
  
                        <!----------------------- START PAGE 2 (hidden by default)  -------------------------------------->
    		            <!-- Each div should have id = randInteger + "Div", input should be randInteger + "_Input" to automate it in JS -->
			            <div class="col-md-12 random" id="randIntegerDiv">
    		                <p> Generate hash key <span class='glyphicon glyphicon-list-alt'></span></p>
			                <button id="generatehashKey" type="button" class="btn btn-primary btn-embossed btn-lg btn-wide bt-mobile-mine">Generate hash</button>
    		            </div><!-- END  <div class="col-md-5">-->


                        <!-------------------------------- INSTRUCTIONS  ------------------------------->
                        <br>
                        <div class="col-md-12 col-sm-12 col-xs-12 jumbotron"  id="hiddenInstructions" style="display:none;margin-top:2%;"> 
                            <br>
                            A tool to encrypt/decrypt your any data with your secret key  &nbsp; <span class='glyphicon glyphicon-user'></span>
                            <br><br>How to proceed:</hr>
                            <br>1.Enter your data you want to Encrypt or Decrypt.
                            <br>2.Enter yor secret hash key. Don't divulge your secret hask key to the third parties. If you don't enter, the secret key will be autogenerated.
                            <br>3.Click "Encrypt" or "Decrypt" button in order to Encrypt or Decrypt the data.
                            <br>4.Use "Copy" button to copy your hash key or to copy the ecrypted/decrypted result.
                        </div>
				
                        <!-------------------------------- RESULTS ------------------------------------->
	                    <br><br>
	                    <div class="col-md-8"  id="resultFinal" style="margin-top:33px;">...</div> <br><br><br>

    	            </div><!-- /.container -->
    		    </div><!-- /.wrapper -->

                <div style="height:177px;"></div>
    	    </div><!-- /.item -->

		    <!------- Footer ---------->     
	        <div class="footer" style="flex: 0 0 auto;"> <!-- navbar-fixed-bottom -->
		        Contact: <strong>dimmm931@gmail.com</strong><br>
		        <?php  echo date("Y"); ?>
		    </div>
		    <!------- END Footer ------->
		
	        <!-----------------  Button to change Style theme------------------------->
	        <input type="button" class="btn" value=">>" id="changeStyle" style="position:absolute;top:0px;right:0px;" title="click to change theme"/>
	        <!-----------------  Button to change Style theme------------------------->
	   
           <script>
          //To adjsut footer to bottom
          function footerX(){
              var main = document.getElementById('contact1');
              var footer = document.getElementsByClassName('footer')[0];
              footerHeight = footer.clientHeight;
              main.style.paddingBottom = (footerHeight*2)+'px';
          }

          window.addEventListener('load',footerX);
          window.addEventListener('resize',footerX);
          </script>	   
   
    </body>
</html>

<!--
<?php
// Record (with CLASS) all the  input  to  txt;  //;
      include("Classes/RecordTxt.php");
      RecordTxt::RecordAnyInput(array(), 'recordText/myEncrypt.txt');
//End  Record;
?>-->