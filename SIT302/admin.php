<?php 
 require_once "include.php" 
 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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









/*.collapseNav{
	width: 70px;
	height: 30px;
	position: fixed;
	text-align: center;
	z-index: 999;

}*/

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
    </div>
	<div id="user">
<?php  

	
    if (isset($_COOKIE["username"])){
       echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="#" ><span ></span>'.$_COOKIE["username"].'</a></li>
            <li><a href="javascript:userOut()">Log out</a></li></ul>';
      }
    else{
		
      echo  '<ul class="nav nav-pills navbar-nav navbar-right"> 
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
    }   
 
?>


</div></nav>






<div class="main" id="showBox" >

<div class="showBox table-responsive" >

	<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>User Id</th>
      <th>User Name</th>
      <!-- <th>Food Brand</th> -->
      <th>Password</th>
	  <th>Name</th>
      <th>organisiation</th>
	  <th>organisiationAddress</th>
	  <th>position</th>
	  <th>email</th>
	  <th>contactNumber</th>
	  <th>Status</th>
	  
      

    </tr>
  </thead>
  
<!--
	var id=parseInt(window.location.search.slice(12));
		if(id == ""){
		
		}
-->
 
	<tbody id="table">
 <?php 

		/*
		$sql="select * from users";
		$connect=new mysqli('127.0.0.1', 'root', '', 'scrappertest');
		$results=$connect->query($sql);
		
		if ($result->num_rows > 0) {
			while($row=$result->fetch_assoc()){
					
				echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td><td>'.$row[8].'</td><td><button onclick="changStatus('.$row[0].')" > '.$row[9].'</td></tr>';
					
			};
		} else {
			echo "0 Results to show";			
		};
		
		$connect->close();
		*/




		//$conn = new mysqli('localhost','root','','scrappertest');
		$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo '<tr><td>'.$row["userID"].'</td><td>'.$row["username"].'</td><td>'.$row["password"].'</td><td>'.$row["name"].'</td><td>'.$row["organisation"].'</td><td>'.$row["organisationAddress"].'</td><td>'.$row["position"].'</td><td>'.$row["email"].'</td><td>'.$row["contactNumber"].'</td><td><button onclick="changStatus('.$row["userID"].')" > '.$row["confirmed"].'</td></tr>';
				#echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
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

function userOut(){
	  <?php
	  session_destroy();
	  ?>
	  
	 window.location="index.php";
	  
            
	  
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