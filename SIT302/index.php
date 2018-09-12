<?php 
 require_once "include.php" 
?>
<!DOCTYPE php>
<php>
<head>
	<meta charset="UTF-8" />
    <title>Global Obesity Program</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
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
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
			</ul>
		</div>
	</div>
	<div id="body">
            <ul>
                <li>
                    <h1><a href="index.php">Global Obesity Program</a></h1>
                    <div>
                        <a href="index.php"><img src="images/GlobalObesity.jpg" alt="Image"  Height= "238"  width= "286"/></a>
                    </div>
                    <span>Mission: To provide healthy diet under budget and eliminate obesity.</span>
                    <p>We aim to provide a healthy and affordable diet to each and every citizen of Australia.</p>
                    <a href="index.php" class="readmore">Read more</a>
                </li>
                <li>
                    <h1><a href="products.php">Search Products</h1>
                    <div>
                        <a href="products.php"><img src="images/fruits.jpg" alt="Image" Height= "238"  width= "286" /></a>
                    </div>
                    <span>Select from a wide range of products</span>
                    <p>Here you can choose from a wide variety of healthy products for yourself and your family.</p>
                    <a href="products.php" class="readmore">Read more</a>
                        </li>
                <li>
                    <h1><a href="price.php">Compare <br>Prices </a></h1>
                    <div>
                        <a href="price.php"><img src="images/graphs.jpg" alt="Image"  Height= "238"  width= "286"/></a>
                    </div>
                    <span>Calculate an affordable price for your everyday diet</span>
                    <p>The data after price comparison is displayed in the form of graphs. You have the freedom to choose from several types of graphs for example, line graph, bar graph, pie-chart and so on.</p>
                    <a href="price.php" class="readmore">Read more</a>
                </li>
                
            </ul>
        </div>
        <div id="footer">
            <div>
                <p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
                <p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
            </div>
        </div>
    </div>

</body>
</php>