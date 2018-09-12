
<!DOCTYPE html>
<html lang="en">

<head>
	<!--
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju Your Fashion Shop">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">-->
    
	<title>Login</title>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="asset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" />


	<style>
		.error{color:red;position:relative;
				top:10px;
		}

		.registerTable{
		  width:30%;
		  height:200px;
		  border:1px solid;
		  display:flex;
		  align-items:center;
		  justify-content:center;
		  // position:absolute;
		  top:0;
		  left:0;
		  right:0;
		  bottom:0;
		  margin:auto;
		  padding:10px;
		  background:#ffffff;
		 }

		.submit{
		  position:relative;
		  width:50%;
		  margin:10px auto;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid"> 
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style="color:white">Healthy Diets ASAP</a>
				<a class="navbar-brand" href="product_information_input.php" style="color:white">| Product Detail Input</a>
			</div>

			<div id="user" >
				<?php  


					if (isset($_COOKIE["username"])){
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.$_COOKIE["username"].'</a></li><li><a href="logout.php" style="color:white">Log out</a></li></ul>';
					}
					else{
						# echo  '<script>var c=confirm("We plan to use cookie to provide you a better shopping evironment,do you want to start cookie?");if(c==true){alert("cookie start")}else{alert("cookie banned")}</script>';
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li><li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
					}   
				?>
			</div>

			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">submit</button>
			</form>

		</div>
	</nav>
    
	<div id="page">
		<div id="header">
			<div>
				<a href="index.php"><img src="images/GlobalObesityLogo.png" alt="Logo" /></a>
			</div>
			<ul>
				<li class="current"><a href="index.php"><span>Home</span></a></li>
				<?php  
					if(isset($_COOKIE["username"])){
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
			</ul>
		</div>
	</div>
	<div class="registerTable"> 
		<form method="post" action="doAction.php?act=login" id="loginForm" > 
			<table>
				<tr><h1>Login to your Account</h1></tr>
				<tr><input type="text" name="username" id="1" placeholder="Username" onblur="get(this.value)" class="text" required ></tr>
				<p></p>
				<tr><input type="password" name="password" class="text" placeholder="Password" id="123" onblur="show(this.value)"  required></tr>
				<p></p>
			</table>
			<div class="submit">
				<button type="submit" id="loginButton">log in</button>
			</div> 		
			<div id="loginSuggestion" class="error">
			 
			</div> 
		</form>
	</div>	                       
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
			 }
			 else if(respond==2){
				  suggestion.innerHTML="password was incorrect";
			 }
			 else if(respond==3){
				 suggestion.innerHTML="";
				 window.location="admin.php";
			 }else if(respond==4){
				 suggestion.innerHTML="User not confirmed"
			 }
	
		 };
		 $.post(url,data,success,"json");
		
		 
		 e.preventDefault();
		 
	 })
	 
	 function show(a){
		 password=a;
		 
	 }
	 
	 function get(a){
		 username=a;
		 
	 }
	
</script>
</body>

</html>
