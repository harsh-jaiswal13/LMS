<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
	<script>
		
		$(document).ready(function(){
			//LOGIN
			$("#Login").click(function(){
			// event.preventDefault();
			$.ajax({
				url: '../controller/login_controller.php',
				type: 'POST',
				data: $('#LoginForm').serialize(),
				datatype : "json",
				success: function(response){
					// console.log(response);
					// console.log(typeof(response));
					result = JSON.parse(response);
					// console.log(JSON.parse(response));
					$('#LoginResult').html(result.message);
					
				}

			});	
				
		});
			
					
		});

	</script>
	<h2>Login</h2>
	<form id="LoginForm" method="post" >
		<label>Username/email:</label>
		<input type="text" name="username" required><br><br>
		<label>Password:</label>
		<input type="password" name="password" required><br><br>
	</form>
		<div >
		<button id="Login">Login</button>
		<div id="LoginResult"></div> 
	</div>
</body>
</html>

	