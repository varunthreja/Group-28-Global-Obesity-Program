<?php 
	require_once "include.php";
	if (isset($_COOKIE['username']) and ($_COOKIE['username']=='Admin' or $_COOKIE['username']=='admin')){
	}else{
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="asset.css">
	<style type="text/css">
		.nav{
			flex:0 0 10%;
		}

		.main{
		  width:100%;
		  
		  margin:20px auto;
		  border:2px solid ;
		  overflow:hidden;
		  display: flex;
		}

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

		.showBox{
			width: 100%;
		}

		body{
			padding:70px 0px;
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
				<a href="index.php"><img src="images/image_GlobalObesity.jpg" alt="Logo" /></a>
			</div>
			<ul>
				<li class="current"><a href="index.php"><span>Home</span></a></li>
				<?php  
					if(isset($_COOKIE["username"])){
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Product Basket</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
				<li><a href="contactus.php"><span>Contact Us</span></a></li>
				<?php
					if (isset($_COOKIE["username"]) and ($_COOKIE["username"]=="admin" or $_COOKIE["username"]=="Admin")){
						echo '<li><a href="admin.php"><span>Admin Panel</span></a></li>';
					}
				?>
			</ul>
		</div>
	</div>
<div class="main" id="showBox" >

<div class="showBox table-responsive" >
	
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>User Id</th>
			<th>User Name</th>
			<th>Name</th>
			<th>organisiation</th>
			<th>organisiationAddress</th>
			<th>position</th>
			<th>email</th>
			<th>contactNumber</th>
			<th>Status</th>
		</tr>
	</thead>
  
	<tbody id="table">
		<?php
			//$conn = new mysqli('localhost','root','','scrappertest');
			$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
			$sql = "SELECT * FROM users";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo '<tr><td>'.$row["userID"].'</td><td>'.$row["username"].'</td><td>'.$row["name"].'</td><td>'.$row["organisation"].'</td><td>'.$row["organisationAddress"].'</td><td>'.$row["position"].'</td><td>'.$row["email"].'</td><td>'.$row["contactNumber"].'</td><td><button onclick="changStatus('.$row["userID"].')" > '.$row["confirmed"].'</td></tr>';
				}
			} else {
				echo "0 results";
			}
		?>
	</tbody>
    </table>

</div>


</div>

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
	// var status=document.getElementById("status");
	// status.addEventListener("click",function(){
		// // var confirm=confirm("Do you want to change the status of users?");
		// // if(confirm){
			// // var username=status.parentNode.childNodes[0];
			// // alert(username);
		// // }
		// alert(1);
	// });
	
function changStatus(value){
	var url='doAction.php?act=update';
	var data={"userID":value};
	var success=function(respond){
		if(respond==1){
			alert("has changed");
			window.location="admin.php";
		}
		else if(respond==2){
			alert("has not change");
		}
	};
	$.post(url,data,success,"json");
}


// function freeze(value){
	// var url='doAction.php?act=freeze';
	// var data={"userID":value};
	// var success=function(respond){
		// if(respond==1){
			// alert("has freeze");
			// window.location="admin.php";
		// }
		// else if(respond==2){
			// alert("has not freeze");
		// }
	// };
	// $.post(url,data,success,"json");
// }
  
</script>
</body>
</html>