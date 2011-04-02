<!DOCTYPE html>

<html>
  <head>
  </head>
  <script src='<?php echo base_url(); ?>scripts/jquery.js'></script>
  <script>
  
  function savesite() {
  
	
	document.getElementById('password').value
	
	var params = { 'username' : document.getElementById('username').value,
						    'password' : document.getElementById('password').value }
	
	$.post('http://localhost/spindlous/api/test', params, function(data) {
		alert(data);
	});
			
  }
    
  
  </script>
  
  <body>
  
	
	<form action="javascript:savesite()">
		username: <input id="username" type="text" /> <br />
		password: <input id="password" type="password" />
		<input type="submit" value="Submit" />
	</form>
  </body>
 </html>