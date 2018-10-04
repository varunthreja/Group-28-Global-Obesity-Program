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
			background:#fff;
			color:#000;
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
<?php include("header.php");?> 
<div class="main" id="showBox" >

<div class="showBox table-responsive" >
	<form action="doAction.php?act=input" method="post">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Food Name</th>
			<th>Specific brand</th>
			<th>Your brand</th>
			<th>Specific size</th>
			<th>Your size</th>
		</tr>
		</thead>

	 
		<tbody id="table">
			<?php 
				$sql="select * from foodDetails";
				$conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
				$results=$conn->query($sql);
				echo '<tr><td><select name="foodName" id="foodName" class="required form-control h5-phone"><option value=""></option>';

				while($row=$results->fetch_assoc()){
					 if($row["foodName"][0]=='"')
					{
     					 echo '<option value='.$row["foodName"].'>'.$row["foodName"].'</option>';
    				}
   				 else {
     					 echo '<option value="'.$row["foodName"].'">'.$row["foodName"].'</option>';
    				}
				}

				echo '</select></td><td><input type="text" class="required form-control h5-phone" name="sbrand" id="specificBrand" readonly></td><td><input type="text" class="required form-control h5-phone" name="ybrand" required></td><td><input type="text" name="ssize" class="required form-control h5-phone" id="specificSize" readonly></td><td><input type="number" class="required form-control h5-phone"  name="ysize" required><select name="foodSize" class="required form-control h5-phone" id="foodSize1" required><option value="ml">ml</option><option value="L">L</option><option value="kg">per kg</option><option value="g">g</option></select></td></tr>';

				
			?>
		</tbody>
	</table>



	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Your cost</th>
				<th>Comments</th>
				<th>Price promoted</th>
			</tr>
		</thead>
		<p id="userSuggestion"></p>
		<tbody id="table2">
			<tr>
				<td>$<input type="number" class="form-control h5-phone" name="yourCost" required></td><td><br/><input type="text" class="form-control h5-phone"  name="comments" required></td><td><input type="radio" value="T" name="pricePromoted">True<br/><input type="radio" value="F" name="pricePromoted">False</td>
			</tr>
		</tbody>
	</table>
	<button type="submit" class="button btn btn-accent" id="button" style="margin-left: 20px;">Input</button>
</form>
</div>
</div>

       
<?php include ("footer.php");?>

<script type="text/javascript">
	var foodName;
    $("#foodName").change(function(){

    foodName=$("#foodName").val();
    var url="doAction.php?act=search";
    var data={"foodName":foodName};
    var success=function(respond){
    	if(respond){
    		var info=respond.split("+");
    		var brand=document.getElementById("specificBrand");
  			var size=document.getElementById("specificSize");
  			brand.value=info[0];
  			size.value=info[1];
    	}
 	 }
  $.post(url,data,success,'json');
  
 });

// function search(productName){
  
 
// }


// 	brand.addEventListener("keyup",function(){
//      if(typeof time=="number"){
//       clearTimeout(time);
//       }
//   alert(1);
//      time=setTimeout(function(){
//      check(brand.value,3);
//       },1000);
  

//   });

//   size.addEventListener("keyup",function(){
//      if(typeof time=="number"){
//       clearTimeout(time);
//       }
//   alert(1);
//      time=setTimeout(function(){
//      check(size.value,3);
//       },1000);
  

//   });
  
  
// function check(value,type){
//     var url="checkinfo.php";
//     var data={"text":value,"type":type};
    
    
    
//     var success=function(respond){
      
     
//       if(respond==30){
        
//         document.getElementById("userSuggestion").innerHTML="";
//         document.getElementById("button").disabled=false;
//       }
//       else if(respond==31){
        
//         document.getElementById("userSuggestion").innerHTML="more than 5 less than 30";
//         document.getElementById("button").disabled=true;
//       }
//       else if(respond==32){
//         document.getElementById("userSuggestion").innerHTML="letters numbers spaces - only";
//         document.getElementById("button").disabled=true;
//       }
      
//     }
//     $.post(url,data,success,"json");
//   }

</script>

</body>
</html>