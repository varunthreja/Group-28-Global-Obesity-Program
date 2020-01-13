<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid"> 
			<div class="navbar-header" >
				<a class="navbar-brand" href="index.php" style="color:white">Healthy Diet Affordability Evaluator</a>
			</div>

			<div id="user" >
				<?php  


					if (isset($_COOKIE["username"])){
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.ucfirst($_COOKIE["username"]).'</a></li><li><a href="logout.php" style="color:white">Log out</a></li></ul>';
					}
					else{
						# echo  '<script>var c=confirm("We plan to use cookie to provide you a better shopping evironment,do you want to start cookie?");if(c==true){alert("cookie start")}else{alert("cookie banned")}</script>';
						echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li><li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Login</a></li></ul>';
					}   
				?>
			
		
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
						echo '<li><a href="Account.php"><span>My Account</span></a></li><li><a href="Product Input.php"><span>Product input</span></a></li><li><a href="Price Analysis.php"><span>Price Analysis</span></a></li><li><a href="Products.php"><span>Products</span></a></li><li><a href="Basket Analysis.php"><span>Basket Analysis</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
				<li><a href="contactus.php"><span>Contact Us</span></a></li>
				
				<?php
					if (isset($_COOKIE["username"])){
						$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
						$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
						$result = $conn->query($sql);
						if($result->num_rows > 0){
							$row = $result->fetch_assoc();
							if($row["isAdmin"] == 1){
								echo '<li><a href="Admin.php"><span>Admin Panel</span></a></li>';
							}
						}
					}
				?>
			</ul>
		</div>
	</div>