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
  <link rel="stylesheet" type="text/css" href="temp.css" />
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
  width:50%;
  margin:20px auto;
  border:2px solid darkgray ;
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
       echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.ucfirst($_COOKIE["username"]).'</a></li><li><a href="logout.php" style="color:white">Log out</a></li></ul>';
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
				echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li class="current"><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Basket Analysis</span></a></li>';
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
<div class="search_form">    
 <div class="navbar-form search_box" role="search">
        <div class="form-group">
            <input type="text" id="search_input" name="name" class="form-control search_input" placeholder="Search">
            <button id="search_btn" class="btn btn-default">submit</button>
        </div>
        
        
</div>    
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
 
<?php
  $foodName=array();
  $sql="select * from foodDetails";
  $connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
  $result=$connect->query($sql);
  while($row=$result->fetch_assoc()){
     array_push($foodName, $row["foodName"]);
  }
 ?>


  <tbody id="table">
 <?php
	if (isset($_REQUEST['page'])){
		$page=$_REQUEST['page'];
	}else{
		$page=1;
	}
   	
	$sql="SELECT foodName FROM foodDetails ORDER BY foodName LIMIT 20 OFFSET ".(($page - 1) * 20);
    $connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	$result=$connect->query($sql);
	
	while($row=$result->fetch_assoc()){
		echo '<tr><td>'.$row["foodName"].'</td></tr>';
	};
?>
  </tbody>
</table>

        
</div>

 

</div>

     <!--    <div class="input">
          <button class="Input_button" id="product_submit">Input</button>
        </div> -->
<div id='pagination'>
  <ul class="pagination" >
    <li><a href="product_information.php?page=1">&laquo;</a></li>
    <li><a href="product_information.php?page=1">1</a></li>
    <li><a href="product_information.php?page=2">2</a></li>
    <li><a href="product_information.php?page=3">3</a></li>
    <li><a href="product_information.php?page=4">4</a></li>
    <li><a href="#">&raquo;</a></li>
  </ul><br>
</div>



        
    <div id="footer">
      <div>
        <p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
        <p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
      </div>
    </div>
  </div>


<script type="text/javascript">




  var foodName = <?php echo json_encode($foodName) ?>;//php array => json 
  $("#search_input").on("keyup",function(){
   var search_input=$("#search_input").val().toString();
   var result=filterArray(foodName,search_input);
   document.getElementById("table").innerHTML="<tr><td>1<td></tr>";
   var updateTable;
   for(let i=0;i<result.length;i++){
      updateTable+='<tr><td>';
      updateTable+=result[i];
      updateTable+='</td></tr>';
   }
   document.getElementById("table").innerHTML=updateTable;
   document.getElementById("pagination").innerHTML="";
  });





  $("#search_btn").on("click",function(){
   var search_input=$("#search_input").val().toString();
   var result=filterArray(foodName,search_input);
   document.getElementById("table").innerHTML="<tr><td>1<td></tr>";
   var updateTable;
   for(let i=0;i<result.length;i++){
      updateTable+='<tr><td>';
      updateTable+=result[i];
      updateTable+='</td></tr>';
   }
   document.getElementById("table").innerHTML=updateTable;
   document.getElementById("pagination").innerHTML="";
  })



  function filterArray(array,clue){
    var resultArray=[];
    for(let i=0;i<array.length;i++){
        var testString=array[i].toLowerCase();
        if(testString.indexOf(clue)>-1){
          resultArray.push(array[i]);
        } 
    }
    return resultArray;
  }

  

</script>

</body>
</html>