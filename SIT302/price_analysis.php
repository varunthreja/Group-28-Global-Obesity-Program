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
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
  <script
  src="https://code.jquery.com/jquery-2.1.1.min.js"
  integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ="
  crossorigin="anonymous"></script>
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
  border:2px solid darkgray ;
  overflow:hidden;
  display: flex;

}

.button_line{
  width: 100%;
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


  
    <!--  <ul class="nav nav-pills">
    <li><a href="#">Log in</a></li>
    <li><a href="#">Log out</a></li>
  </ul> -->

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="color:white">Healthy Diets ASAP</a>
    <a class="navbar-brand" href="product_information_input.php" style="color:white">| Product Detail Input</a>
    </div>
  <div id="user" >
<?php  

  
    if (isset($_COOKIE["username"])){
       echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.$_COOKIE["username"].'</a></li>
            <li><a href="logout.php" style="color:white">Log out</a></li></ul>';
      }
    else{
    
      echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li>
            <li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
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
				echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li class="current"><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li>';
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
			<th>Product 1</th>
			<th>Product 2</th>			
		</tr>
	</thead>
  
    <tbody id="table1">
<?php 
	$sql="select * from foodDetails";
	$conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	$results=$conn->query($sql);

	echo '<tr><td><select name="product1" id="product1">';
	while($row=$results->fetch_assoc()){

    if(strpos($row["foodName"],'"')==-1)
		{
      echo '<option value="'.$row["foodName"].'">'.$row["foodName"].'</option>';
    }
    else {
      echo '<option value='.$row["foodName"].'>'.$row["foodName"].'</option>';
    }
	}
	echo '</select></td><td><select name="product2" id="product2"> <option value="none" selected></option>';
	$conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	$results=$conn->query($sql);

	while($row=$results->fetch_assoc()){
	echo '<option value="'.$row["foodName"].'">'.$row["foodName"].'</option>';
	}
	echo '</select></td></tr>';

?>


         </tbody>
    </table>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>
  </thead>

  <tbody id="table2">
 
        <tr>
        <td><input type="date" name="start"></td>
        <td><input type="date" name="end"></td>
        </tr>

  </tbody>
</table>

</div>





</div>


    

    

<div >
  <button class="Input_button" id="product_submit">Input</button>
</div>



        
        <div id="footer">
            
        
    
      
      <div>
        <p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
        <p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
      </div>
    </div>
  </div>


<script type="text/javascript">

</script>

</body>
</html>