<?php 
 require_once "include.php" 
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
				<li><a href="index.php"><span>Home</span></a></li>
				<?php  
					if(isset($_COOKIE["username"])){
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li class="current"><a href="productBasket.php"><span>Product Basket</span></a></li>';
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
	<div id="body">
		<form action="" method="post">
			<table style="width:100%; text-align:center">
				<tr style="color:#D8DC6A">
					<td>
						Select a Household:
						<select name="baskets">

							/* This code will create the drop downmenu for selecting the basket */
							<?php
							$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
							$command = "SELECT * FROM baskets";
							$result = $conn->query($command);

							if ($result->num_rows > 0){
								while ($row=$result->fetch_assoc()){
									if (isset($_POST["baskets"]) and $_POST["baskets"] == $row["basketName"]){
										echo '<option name="'.$row["basketID"].'" title="'.$row["basketDescription"].'" selected>'.$row["basketName"].'</option>';
									}else{
										echo '<option name="'.$row["basketID"].'" title="'.$row["basketDescription"].'">'.$row["basketName"].'</option>';								
									}
								}
							}else{
								echo "<option>No Results</option>";
							};
						?>
						</select>
					</td>
					<td>
						Select a Basket:
						<?php
						if (isset($_POST["BasketRating"]) and $_POST["BasketRating"] == "healthybasketrating"){
							echo '<input type="radio" name="BasketRating" value="unhealthybasketrating"> Unhealthy';
							echo '<input type="radio" name="BasketRating" value="healthybasketrating" checked> Healthy';
						}else{
							echo '<input type="radio" name="BasketRating" value="unhealthybasketrating" checked> Unhealthy';
							echo '<input type="radio" name="BasketRating" value="healthybasketrating"> Healthy';
						}
					?>
					</td>
					<td>
						Select a Date:
						<?php
						$sql = "SELECT MIN(collectionDate), MAX(collectionDate) FROM main";
						$result = $conn->query($sql);
						while ($row=$result->fetch_assoc()){
							if (isset($_POST["limitDate"])){
								echo '<input type="date" name="limitDate" value="'.$_POST["limitDate"].'"min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MAX(collectionDate)"].'">';
							}else{
								echo '<input type="date" name="limitDate" min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MAX(collectionDate)"].'">';
							}
						}
						
					?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td style="text-align:center"><button name="submit">Submit</button>
						<a href="testBasketAnalysis.php" name="clear">clear</a></td>
				</tr>
			</table>
		</form>

		<?php
			if (isset($_REQUEST["submit"])){
				echo '<h2>Break down of basket:</h2>';
				echo '<table class="fixed_header" style="margin-left:auto; margin-right:auto"><thead><th>Food Name</th><th>Collection Date</th><th>Serving Size</th><th>Price</th><th>Weighted Price</th></thead><tbody>';
				$tally = 0;
				$categories = array(0,0,0,0,0,0,0,0,0,0,0);
				$basket = $_POST["baskets"];
				$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
				$sql = 'SELECT basketID, basketBudget FROM baskets WHERE basketName = "'.$basket.'"';
				$result = $conn->query($sql);
				
				if ($result->num_rows == 1){
					while ($row=$result->fetch_assoc()){
						$basketID = $row["basketID"];
						$basketBudget = $row["basketBudget"];
					}
				}else{
					echo "ERROR";
				};

				$sql = "SELECT foodID, ".$basketID." FROM ".$_POST["BasketRating"];
				$result = $conn->query($sql);
				
				while ($row=$result->fetch_assoc()){
					$foodID = $row["foodID"];
					$foodWeight = $row["{$basketID}"];
					$sql2 = 'SELECT a.foodID, b.foodName, b.categoryID, a.collectionDate, a.servingSize, a.price FROM main AS a, foodDetails AS b WHERE a.foodID = '.$foodID.' AND a.foodID = b.foodID and a.collectionDate <= "'.$_POST["limitDate"].'" ORDER BY a.collectionDate DESC LIMIT 1';
					$result2 = $conn->query($sql2);
					while ($row2=$result2->fetch_assoc()){
						$foodName = $row2["foodName"];
						$collectionDate = $row2["collectionDate"];
						$servingSize = $row2["servingSize"];
						$price = $row2["price"];
						$index = $row2["categoryID"] - 1;
					}
					$pricePer = round($price / $servingSize, 8);
					$weightedPrice = round($pricePer * $foodWeight, 2);
					echo "<tr><td>".$foodName."</td><td>".$collectionDate."</td><td>".$servingSize."</td><td>".$price."</td><td>".$weightedPrice."</td></tr>";
					$tally += $weightedPrice;
					$categories[$index] += $weightedPrice;
					
				}
				echo "</tbody></table>";
				echo "Total Basket Value: ".$tally."<br>";
				if ($basketBudget * 0.3 > $tally){
					echo "At ".$tally." this basket is affordable for ".$basket;
				}else{
					echo "At ".$tally." this basket is not affordable for ".$basket;						
				}
				
				echo "<h2>Distribution of food categories:</h2>";
				echo "<table><thead><th>Category Name</th><th>Category Total</th></thead><tbody>";
				$sql = "SELECT categoryName FROM foodCategories";
				$result = $conn->query($sql);
				while ($row=$result->fetch_assoc()){
					$categoryAmount = 0;
					$sql2 = 'SELECT * FROM foodCategories WHERE categoryName = "'.$row["categoryName"].'"';
					$result2 = $conn -> query($sql2);
					while ($row2 = $result2->fetch_assoc()	){
						$categoryId = $row2["categoryID"] - 1;
					}
					$categoryAmount = $categories[$categoryId];
					echo "<tr><td>".$row["categoryName"]."</td><td>".$categoryAmount."</td></tr>";
				}
				echo "</tbody></table>";
			}
		?>
	</div>
	<div id="footer">
		<div>
			<p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
			<p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
		</div>
	</div>

</body>
</php>