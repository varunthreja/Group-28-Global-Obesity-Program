<?php 
 require_once "include.php" ;
 error_reporting(0);
?>
<!DOCTYPE php>
<php>
<head>
	<meta charset="UTF-8" />
    <title>Global Obesity Program</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<link rel="stylesheet" href="asset.css">
</head>
<body onload="alert_cookie()">
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
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Product Basket</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
				<li class="current"><a href="contactus.php"><span>Contact Us</span></a></li>
                

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
	<div id="body">
    <!-- New code -->
		<div class="container">
<div class="contact-section">
<h2 class="ct-section-head" style="color:#7CDEDC">
   CONTACT US 
</h2>
<div class="row contact-fields">
<div class="col-md-8 left-form">
   <form method="post" action="">
      <div class="form-group">
         <label class="sr-only" for="fname">First Name *</label>
         <input class="required form-control" id="fname" name="fname" placeholder="First Name&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="lname">Last Name *</label>
         <input class="required form-control" id="lname" name="lname" placeholder="Last Name&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contactEmail">Email *</label>
         <input class="required form-control h5-email" id="contactEmail" name="contactEmail" placeholder="Email&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contactPhone">Phone *</label>
         <input class="required form-control h5-phone" id="contactPhone" name="contactPhone" placeholder="Phone&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="comment">Type your message here</label>
         <textarea class="required form-control" id="comment" name="comment" placeholder="Type your message here&nbsp;*" rows="6"></textarea>
      </div>
      <button class="button btn btn-accent" type="submit">Submit</button>  
   </form>
</div>
<div class="col-md-4 contact-info">
<div class="phone" style="color:#7CDEDC">
   <h2>Call</h2>
   <a href="tel:+4046872730" style="color:white">0300000000</a>
</div>
<div class="email" style="color:#7CDEDC">
   <h2>Email</h2>
   <a href="mailto:info@decidedekalb.com" style="color:white">kathryn@deakin.edu.au</a>
</div>
<div class="location" >
   <h2 style="color:#7CDEDC">Visit</h2>
   <p style="color:white">Global Obesity Center </br>
      Deakin University </br>
      Burwood </br>
      VIC 3125
      <br>
     
   </p>
</div>
   <!--  New Code -->
	</div></div></div></div></div>
	 <div id="footer">
            <div>
                <p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
                <p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
            </div>
	</div>

</body>
</php>