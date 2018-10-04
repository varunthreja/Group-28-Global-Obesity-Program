<?php 
	require_once "include.php";
	$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	if (isset($_COOKIE["username"])){
	$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		if($row["isAdmin"] == 0){
			echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
			exit;
		}
	}
	}else{
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
			exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="asset.css">
	<style type="text/css">
		.nav{
			flex:0 0 10%;
		}

		.main{
		  width:100%;
		  
		  margin:20px auto;
		  border:2px solid darkgray ;
		  overflow:hidden;
		  display: flex;
		  background: #fff;
		  color: #000;
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

		body{
			padding:0px 0px;
		}   
	</style>
</head>
<body>
<?php include("header.php");?>
<div class="main" id="showBox" >

<div class="showBox table-responsive" >
	
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>User Name</th>
			<th>Name</th>
			<th>Organisation</th>
			<th>Organisation Address</th>
			<th>Position</th>
			<th>Email</th>
			<th>Contact Number</th>
			<th>Status</th>
			<th>Admin</th>
		</tr>
	</thead>
  
	<tbody id="table">
		<?php
			//$conn = new mysqli('localhost','root','','scrappertest');
			$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
			$sql = "SELECT * FROM users";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					if ($row["confirmed"] == 1){
						$confirmed = "Confirmed";
					}else{
						$confirmed = "Unconfirmed";
					}
					if($row["isAdmin"] == 1){
						$admin="True";
					}else{
						$admin="False";
					}
					
					echo '<tr><td>'.$row["username"].'</td><td>'.$row["name"].'</td><td>'.$row["organisation"].'</td><td>'.$row["organisationAddress"].'</td><td>'.$row["position"].'</td><td>'.$row["email"].'</td><td>'.$row["contactNumber"].'</td><td><button onclick="changStatus('.$row["userID"].')" class="button btn btn-accent" > '.$confirmed.'</td><td><button onclick="changeAdmin('.$row["userID"].')" class="button btn btn-accent">'.$admin.'</td></tr>';
				}
			} else {
				echo "0 results";
			}
		?>
	</tbody>
    </table>

</div>


</div>
<?php include('footer.php'); ?>

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">	
function changStatus(value){
	var url='doAction.php?act=update';
	var data={"userID":value};
	var success=function(respond){
		if(respond==1){
			window.location="admin.php";
		}
		else if(respond==2){
			alert("User "+value+"'s status has not been changed");
		}
	};
	$.post(url,data,success,"json");
}

function changeAdmin(value){
	var url='doAction.php?act=updateAdmin';
	var data={"userID":value};
	var success=function(respond){
		if(respond==1){
			window.location="admin.php";
		}
		else if(respond==2){
			alert("User "+value+"'s status has not been changed");
		}
	};
	$.post(url,data,success,"json");
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