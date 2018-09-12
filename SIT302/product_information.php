<?php 
 require_once "include.php" 
 
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
  width:50%;
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

.input{
  width: 100%;
  height: 30px;
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
            <li><a href="javascript:userOut()" style="color:white">Log out</a></li></ul>';
      }
    else{
    
      echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li>
            <li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
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
				echo '<li><a href="account_setting.php"><span>My Account</span></a></li>';
			} 
		?>
		<li><a href="product_detail.php"><span>Product input</span></a></li>
		<li><a href="price_analysis.php"><span>Price Analysis</span></a></li>
		<li><a href="product_information.php"><span>Products</span></a></li>
		<li><a href="about.php"><span>About Us</span></a></li>
      </ul>
            
    </div>
        



<div class="main" id="showBox" >

<div class="showBox table-responsive" >

  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Food Name</th>
    </tr>
  </thead>
  
<!--
  var id=parseInt(window.location.search.slice(12));
    if(id == ""){
    
    }
-->
 
  <tbody id="table">
 <?php 
	if (isset($_REQUEST['page'])){
		$page=$_REQUEST['page'];
	}else{
		$page=1;
	}
    if($page==2){
    $sql="select * from foodDetails where foodID > 20 and foodID <=40";
    }elseif($page==3){
    $sql="select * from foodDetails where foodID > 40 and foodID <=60";
    }elseif($page==4){
    $sql="select * from foodDetails where foodID > 60 and foodID <=75";
    }else{
    $sql="select * from foodDetails where foodID <= 20";
    }
    $connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	$result=$connect->query($sql);
	
	while($row=$result->fetch_assoc()){
		echo '<tr><td>'.$row["foodName"].'</td></tr>';
	};

    $table="<script>";
      $table+='</script>';
  ?>
  </tbody>
</table>

        
</div>

 

</div>

     <!--    <div class="input">
          <button class="Input_button" id="product_submit">Input</button>
        </div> -->

  <ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="product_information.php?page=1">1</a></li>
    <li><a href="product_information.php?page=2">2</a></li>
    <li><a href="product_information.php?page=3">3</a></li>
    <li><a href="product_information.php?page=4">4</a></li>
    <li><a href="#">&raquo;</a></li>
  </ul><br>




        
    <div id="body">
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