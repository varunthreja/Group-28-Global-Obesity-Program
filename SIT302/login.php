<?php 
require "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<script
  src="https://code.jquery.com/jquery-2.1.1.min.js"
  integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ="
  crossorigin="anonymous"></script>
	<link rel="stylesheet" href="asset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" />


	<style>
		.error{
	      color: #CCDC6A;
	      position: relative;
	      top: 10px;
	      text-align: center;
	    }
		.registerTable {
	      width: 34%;
	      height: auto;
	      border: 1px solid;
	      display: flex;
	      align-items: center;
	      justify-content: center;
	      background: #1F487E;
	      margin: 0 auto;
	      margin-top: 30px;
	      padding-top: 10px;
	    }
	    .submit{
	      position:relative;
	      width:100%;
	      margin:10px auto;
	      text-align:center;
	    }
	    .form{
	      margin:10px;
	      width:96%;
	    } 
	    .button:hover{
	      background:#D8DC6A;
	      color: #fff;
	      padding: 5px;
	    } 
	</style>
</head>

<body bgcolor= "white">
	<?php include("header.php");?>

	<div class="registerTable" onKeyPress="return "> 

		<form method="post" action="doAction.php?act=login" id="loginForm" > 
			<div class="row">
				<h2 style="text-align:center; color:#7CDEDC">Login to your Account</h2>
				<div class="col-md-12 form">
					<div class="col-md-6">
						<label style="color:#D8DC6A; padding-top: 15px;">Username*</label>
					</div>
					<div class="col-md-6">
						<input type="text" name="username" id="1" placeholder=" Username" onblur="get(this.value)" class="required form-control h5-phone" required tabindex="1">
					</div>
				</div>
				<div class="col-md-12 form">
					<div class="col-md-6">
						<label style="color:#D8DC6A; padding-top: 15px;">Password*</label>
					</div>
					<div class="col-md-6">
						<input type="password" name="password" class="required form-control h5-phone" placeholder=" Password" id="123" onblur="show(this.value)"  required tabindex="2">
					</div>
				</div>
				<div class="col-md-12 form">
					<div class="submit">
						<button type="submit" id="loginButton" class="button btn btn-accent">Login</button>
					</div> 		
				</div> 
				<div id="loginSuggestion" class="error">
				
				</div>
			</div>
		</form>
	</div>
	<?php include("footer.php")?>                       
</body>

<script>
   
	var form=document.getElementById("loginForm");
	var username;
	var password;
	var suggestion=document.getElementById("loginSuggestion");
	// var a=document.getElementById("123");
	// a.focus();
	form.addEventListener("submit",function(e){
		url="doAction.php?act=login";
		data={"username":username,"password":password};
		var success=function(respond){
			if(respond==1){
				suggestion.innerHTML="";
				window.location="index.php";
			}else if(respond==2){
				suggestion.innerHTML="password was incorrect";
			}else if(respond==4){
				suggestion.innerHTML="User not confirmed"
			}

		}
		$.post(url,data,success,"json");
		e.preventDefault();
	});
	
	var input = document.getElementById("123");

	// Execute a function when the user releases a key on the keyboard
	input.addEventListener("keyup", function(event) {
		// Cancel the default action, if needed
		event.preventDefault();
		if (event.keycode == 13){
			document.getElementById("loginForm").submit();
		}
	}

	function show(a){
	password=a;

	}

	function get(a){
	username=a;

	}

</script>
</body>

</html>