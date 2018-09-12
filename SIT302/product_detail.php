<?php 
	require_once "include.php"; 
	if (!isset($_COOKIE['username'])){
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Global Obesity Program</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="asset.css">
	<style type="text/css">

		.header{
			width:50%;
			height:500px;
			margin:0 auto;
			border-radius:10px;
			border-bottom:2px solid ;
			text-align:center;
			line-height:100px;
			overflow: hidden;
		}
		.nav{
			flex:0 0 10%;
		}
		.showBox{
			width: 100%;
		}
		.main{
			width:100%;
			margin:20px auto;
			border:2px solid ;
			overflow:hidden;
			display: flex;
		}

		.Input_button{
			width: 100px;
			float: right;
			position: relative;
			right:20px;
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
			<li><a href="index.php"><span>Home</span></a></li>
			<?php  
				if(isset($_COOKIE["username"])){
					echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li class="current"><a href="product_detail.php"><span>Products</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li>';
				} 
			?>
			<li><a href="about.php"><span>About Us</span></a></li>
		</ul>
		
	</div>
        
<div class="main" id="showBox" >

<div class="showBox table-responsive" >
	<form action="doAction.php?act=input" method="post">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Food Name</th>
			<th>Specific brand</th>
			<th>Your brand</th>
			<th>Specific size</th>
			<th>Your size</th>
		</tr>
		</thead>

	 
		<tbody id="table">
			<?php 
				$sql="select * from foodDetails";
				$conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
				$results=$conn->query($sql);
				$table="<script>";

				echo '<tr><td><select name="foodName" id="foodName">';

				while($row=$results->fetch_assoc()){
					echo '<option value="'.$row["foodName"].'">'.$row["foodName"].'</option>';
				}

				echo '</select></td><td><input type="text" name="sbrand" id="specificBrand"></td><td><input type="text" name="ybrand"></td><td><input type="text" name="ssize" id="specificSize"></td><td><input type="text"  name="ysize"><select name="foodSize" id="foodSizee"><option value="ml">ml</option><option value="L">L</option><option value="kg">per kg</option><option value="g">g</option></select></td></tr>';

				$table+='</script>';
			?>
		</tbody>
	</table>



	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Your cost</th>
				<th>Comments</th>
				<th>Price promoted</th>
			</tr>
		</thead>
		<p id="userSuggestion"></p>
		<tbody id="table2">
			<tr>
				<td><input type="text" name="yourCost"></td><td><input type="text" name="comments"></td><td><input type="text" name="pricePromote"></td>
			</tr>
		</tbody>
	</table>
</div>
</div>
<div class="button_line">
	<button type="submit" class="Input_button" id="button">Input</button>
</div>
       
<div id="body">
	<div>
		<p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
		<p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
	</div>
</div>


<script type="text/javascript">
  var brand=document.getElementById("specificBrand");
  var size=document.getElementById("specificSize");

	brand.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  alert(1);
     time=setTimeout(function(){
     check(brand.value,3);
      },1000);
  

  });

  size.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  alert(1);
     time=setTimeout(function(){
     check(size.value,3);
      },1000);
  

  });
  
  
function check(value,type){
    var url="checkinfo.php";
    var data={"text":value,"type":type};
    
    
    
    var success=function(respond){
      
     
      if(respond==30){
        
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==31){
        
        document.getElementById("userSuggestion").innerHTML="more than 5 less than 30";
        document.getElementById("button").disabled=true;
      }
      else if(respond==32){
        document.getElementById("userSuggestion").innerHTML="letters numbers spaces - only";
        document.getElementById("button").disabled=true;
      }
      
    }
    $.post(url,data,success,"json");
  }

</script>

</body>
</html>