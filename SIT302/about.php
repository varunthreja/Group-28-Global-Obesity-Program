<?php 
 require_once "include.php" 
?>
<!DOCTYPE php>
<php>
<head>
	<meta charset="UTF-8" />
    <title>Global Obesity Program</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<link rel="stylesheet" href="asset.css">
</head>
<body onload="alert_cookie()">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid"> 
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style="color:white">Healthy Diets ASAP</a>
			</div>

			<div id="user" >
				<?php  


					if (isset($_COOKIE["username"])){
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.ucfirst($_COOKIE["username"]).'</a></li><li><a href="logout.php" style="color:white">Log out</a></li></ul>';
					}
					else{
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li><li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
					}   
				?>
			</div>

			
		</div>
	</nav>
    
	<div id="page">
		<div id="header">
			<div>
				<a href="index.php"><img src="images/image_GlobalObesity.jpg" alt="Logo" /></a>
			</div>
			<ul>
				<li><a href="index.php"><span>Home</span></a></li>
				<?php  
					if(isset($_COOKIE["username"])){
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Basket Analysis</span></a></li>';
					} 
				?>
				<li class="current"><a href="about.php"><span>About Us</span></a></li>
				<li><a href="contactus.php"><span>Contact Us</span></a></li>
                                
				<?php
					if (isset($_COOKIE["username"])){					
						$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
						$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
						$result = $conn->query($sql);
						if($result->num_rows > 0){
							$row = $result->fetch_assoc();
							if($row["isAdmin"] == 1){
								echo '<li><a href="admin.php"><span>Admin Panel</span></a></li>';
							}
						}	
					}
				?>
			</ul>
		</div>
	</div>
	<div id="body" style="text-align:center">
		<h1 style="color:#7CDEDC">Our Mission</h1>
		<p style="color:#A9B3CE">WE aim to provide healthy diet on an affordable price to everyone. </p>
		<h1 style="color:#7CDEDC">About Us</h1>
		<p style="color:#A9B3CE">What we eat and how much we eat influences our risk for disease and death. Poor diet is a leading cause of disease burden in Australia and 
		globally. The price of foods and beverages is a critical driver of food choice, particularly among individuals with limited food budgets. 
		Changing the price ratio between healthy and unhealthy foods is likely to be a critical leverage point for the improvement of population 
		health, as has been the case with tobacco and alcohol. But actions to rebalance the price of foods towards healthier options are currently 
		limited by a lack of understanding of the relative price and affordability of healthy and unhealthy foods and diets in Australia. Our aim 
		is to rigorously and systematically advance the evidence required for the uptake and successful implementation of effective and equitable
		healthy food pricing policies.</p>
	</div>
	
	
	<div id="footer">
	
		<div>
			<p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
			<p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
		</div>
	</div>

</body>
</php>