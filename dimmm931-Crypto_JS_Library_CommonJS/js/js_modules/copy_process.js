function copy_process(){
	
  this.copy_to_clipboard = function(divID_toCopy, targetX){ //args(id of div to copy, use value(for input) or innerText(for div))
  
      //creating new textarea element and giveing it id 't'
      var t = document.createElement('textarea');
      t.id = 't';
      // Optional step to make less noise in the page, if any!
      t.style.height = 0;
      // You have to append it to your page somewhere, I chose <body>
      document.body.appendChild(t);
	  
      //POINT the div ID to copy. Copy whatever is in your div to our new textarea
	  t.value = eval('document.getElementById(divID_toCopy).' + targetX);  //eval() to execute the code
	 
      // Now copy whatever inside the textarea to clipboard;
      var selector = document.querySelector('#t');
      selector.select();
      document.execCommand('copy');
      // Remove the textarea;
      document.body.removeChild(t);
	
	  $('.flashMessage').html('<span class="errorX">Copied!!!!!!!</span>').fadeOut(4500);
	  setTimeout(function(){ $('.flashMessage').fadeIn().html(''); }, 1000); //reappear span with delay
   }

}

module.exports = copy_process;

