<?php 
 require_once "include.php";
 if (!isset($_COOKIE['username'])){
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
		exit;
	}
?>
<!DOCTYPE php>
<php>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Global Obesity Program</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="asset.css">
	<link rel="stylesheet" type="text/css" href="temp.css" />
	<style>
	#body{
	    background: #fff;
	    color: #000 !important;
	}
	</style>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style="color:white">Healthy Diet Affordability Evaluator</a>
			</div>

			<div id="user">
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
						echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li class="current"><a href="productBasket.php"><span>Basket Analysis</span></a></li>';
					} 
				?>
				<li><a href="about.php"><span>About Us</span></a></li>
				<li><a href="contactus.php"><span>Contact Us</span></a></li>
				<?php
					$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
					$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						$row = $result->fetch_assoc();
						if($row["isAdmin"] == 1){
							echo '<li><a href="admin.php"><span>Admin Panel</span></a></li>';
						}
					}	
				?>
			</ul>
		</div>
	</div>
	<div id="body" style="border: 3px solid #e0dacc;padding: 5px; width: 970px">
		<form action="" method="POST">
			<div style="float:left;width:475px">
				<table style="height:100px; width:100%; text-align:center;">
					<tr style="height:70px;">
						<td>
							Select a Household:
							<select name="basket">

								/* This code will create the drop downmenu for selecting the basket */
								<?php
							$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
							$command = "SELECT * FROM baskets";
							$result = $conn->query($command);
							if ($result->num_rows > 0){
								while ($row=$result->fetch_assoc()){
									if (isset($_POST["basket"]) and $_POST["basket"] == $row["basketName"]){
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
							<select name="BasketRating">
							<?php
								if (isset($_POST["BasketRating"]) and $_POST["BasketRating"] == "healthybasketrating"){
									echo '<option name="BasketRating" title="unhealthybasketrating"> Unhealthy';
									echo '<option name="BasketRating" title="healthybasketrating" selected> Healthy';
								}else{
									echo '<option name="BasketRating" title="unhealthybasketrating" slelected> Unhealthy';
									echo '<option name="BasketRating" title="healthybasketrating"> Healthy';
								}
							?>
							</select>
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
					<tr><td><a style="opacity:0">a</a></td></tr>
				</table>
				<?php
					if (isset($_POST["basket"]) and $_POST["basket"] != ""){
						echo '<h2>Break down of basket:</h2>';
						echo '<table class="fixed_header" style="margin-left:auto; margin-right:auto"><thead><th style="width:40%;">Food Name</th><th style="width:20%;">Collection Date</th><th style="width:20%;">Price</th><th style="width:20%;">Weighted Price</th></thead><tbody>';
						$tally = 0;
						$categories = array(0,0,0,0,0,0,0,0,0,0,0);
						$basket = $_POST["basket"];
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
						
						if ($_POST["BasketRating"] == "Healthy"){
							$basketRating="healthybasketrating";
						}else if($_POST["BasketRating"]=="Unhealthy"){
							$basketRating="unhealthybasketrating";
						}

						$sql = "SELECT foodID, ".$basketID." FROM ".$basketRating;
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
							echo "<tr><td style=width:40%;'>".$foodName."</td><td style=width:20%;'>".$collectionDate."</td><td style=width:20%;'>$".$price."</td><td style=width:20%;'>$".$weightedPrice."</td></tr>";
							$tally += $weightedPrice;
							$categories[$index] += $weightedPrice;
							
						}
						echo "</tbody></table>";
						echo "<h3>Total Basket Value: $".$tally."</h3>";
						if ($basketBudget * 0.3 > $tally){
							echo "<div style='height:50px;'><h4>At $".$tally." this basket is <u>affordable</u> for ".$basket."</h4></div>";
						}else{
							echo "<div style='height:50px;'><h4>At $".$tally." this basket is <u>not affordable</u> for ".$basket."</h4></div>";
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
			<div style="float:right;width:475px">
				<table style="height:100px;width:100%; text-align:center">
					<tr style="height:70;">
						<td>
							Select a Household:
							<select name="basket1">

								/* This code will create the drop downmenu for selecting the basket */
								<?php
									$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
									$command = "SELECT * FROM baskets";
									$result = $conn->query($command);
									echo "<option value='' selected>Select your option</option>";
									if ($result->num_rows > 0){
										while ($row=$result->fetch_assoc()){
											if (isset($_POST["basket1"]) and $_POST["basket1"] == $row["basketName"]){
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
							<select name="BasketRating1">
							<?php
								if (isset($_POST["BasketRating1"]) and $_POST["BasketRating1"] == "Healthy"){
									echo '<option name="BasketRating1" title="unhealthybasketrating"> Unhealthy';
									echo '<option name="BasketRating1" title="healthybasketrating" selected> Healthy';
								}else{
									echo '<option name="BasketRating1" title="unhealthybasketrating" selected> Unhealthy';
									echo '<option name="BasketRating1" title="healthybasketrating"> Healthy';
								}
							?>
							</select>
						</td>
						<td>
							Select a Date:
							<?php
						$sql = "SELECT MIN(collectionDate), MAX(collectionDate) FROM main";
						$result = $conn->query($sql);
						while ($row=$result->fetch_assoc()){
							if (isset($_POST["limitDate1"])){
								echo '<input type="date" name="limitDate1" value="'.$_POST["limitDate1"].'"min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MAX(collectionDate)"].'">';
							}else{
								echo '<input type="date" name="limitDate1" min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MAX(collectionDate)"].'">';
							}
						}
						
						?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:center"><a href="productBasket.php" name="clear" style="color: black;">clear     </a><button type="submit">Submit</button></td>
					</tr>
				</table>
				<?php
					if (isset($_POST["basket1"]) and $_POST["basket1"] != ""){
						echo '<h2>Break down of basket:</h2>';
						echo '<table class="fixed_header" style="margin-left:auto; margin-right:auto;overflow-x:auto"><thead><th style="width:40%">Food Name</th><th style="width=20%">Collection Date</th><th style="width=20%">Price</th><th style="width=20%">Weighted Price</th></thead><tbody>';
						$tally = 0;
						$categories = array(0,0,0,0,0,0,0,0,0,0,0);
						$basket = $_POST["basket1"];
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
						
						if ($_POST["BasketRating1"] == "Healthy"){
							$basketRating1="healthybasketrating";
						}else if($_POST["BasketRating1"]=="Unhealthy"){
							$basketRating1="unhealthybasketrating";
						}
						
						$sql = "SELECT foodID, ".$basketID." FROM ".$basketRating1;
						$result = $conn->query($sql);
						
						while ($row=$result->fetch_assoc()){
							$foodID = $row["foodID"];
							$foodWeight = $row["{$basketID}"];
							$sql2 = 'SELECT a.foodID, b.foodName, b.categoryID, a.collectionDate, a.servingSize, a.price FROM main AS a, foodDetails AS b WHERE a.foodID = '.$foodID.' AND a.foodID = b.foodID and a.collectionDate <= "'.$_POST["limitDate1"].'" ORDER BY a.collectionDate DESC LIMIT 1';
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
							echo "<tr><td style='width=40%'>".$foodName."</td><td style='width=20%'>".$collectionDate."</td><td>$".$price."</td><td style='width=20%'>$".$weightedPrice."</td></tr>";
							$tally += $weightedPrice;
							$categories[$index] += $weightedPrice;
							
						}
						echo "</tbody></table>";
						echo "<h3>Total Basket Value: $".$tally."</h3>	";
						if ($basketBudget * 0.3 > $tally){
							echo "<div style='height:50px;'><h4>At $".$tally." this basket is <u>affordable</u> for ".$basket."</h4></div>";
						}else{
							echo "<div style='height:50px;'><h4>At $".$tally." this basket is <u>not affordable</u> for ".$basket."</h4></div>";						
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
		</form>

	</div>
	<?php include('footer.php'); ?>         

</body>
</html>