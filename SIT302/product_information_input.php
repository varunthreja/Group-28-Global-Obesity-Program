<?php 
 require_once "include.php" 
 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
  border:2px solid ;
  overflow:hidden;
  display: flex;

}
.footer{
  width:100%;
  height:;
  border:2px solid;
  margin-bottom:-100px;
  text-align:left;
  background-color: #EEEEEE;
   margin-top:20px;
   overflow: auto;
  
}

.fa-instagram:before {
  content: "\f16d";
}

.pagination{
	
	display: flex;
	justify-content: center;
	
}

a{
	color: white;
}

.Input_button{
	float:right;
	width:100px;
	height:50px;
	margin:10px;
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

#navigation{
	list-style: none;
	border: 1px solid;
	width: 200px;
	
	position: fixed;
	left: 0;
	top:55%;
	transform: translateY(-50%); 
	border-radius: 10px;
	background-color: #FF9100;
	color: white;
} 

.menu{
	width: 60px;
	height: 30px
	border:1px solid;
	position: relative;
	left: 180px;
	top:370px;
	background-color: #00E676;
	border-radius: 2px;
	text-align: center;
  transform: rotate(90deg);

} 








	</style>
</head>
<body>


  
    <!-- 	<ul class="nav nav-pills">
		<li><a href="#">Log in</a></li>
		<li><a href="#">Log out</a></li>
	</ul> -->

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="color:white">Healthy Diet Affordability Evaluator</a>
		<a class="navbar-brand" href="product_information_input.php" style="color:white">| Product Detail Input</a>
    </div>
	<div id="user" >
<?php  

	
    if (isset($_COOKIE["username"])){
       echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="#" style="color:white"><span ></span>'.$_COOKIE["username"].'</a></li>
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

<!--         <div class="navbar-collapse collapse right" id="basket-overview">
            <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>
        </div> -->

    </div>
</nav>


<!-- <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="doAction.php?act=login" method="post" id="loginForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" id="loginButton">Log in</button>
                            </p>
						</form>
                        

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted">! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

-->
	



<!-- <div class="panel-group collapseNav" id="accordion">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseTwo">
                Menu
            </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
            <ul class="nav nav-pills nav-stacked ">
					<li><a href="#">1</a></li>
  					<li><a href="#">2</a></li>
  					<li><a href="#">3</a></li>
  					<li><a href="#">4</a></li>
  					<li><a href="#">5</a></li>
  				</ul>
        </div>
        </div>
    </div>
</div> -->
<div id="navigation">

<div class="menu" >
	Menu
</div>
<ul  class="affixMenu nav nav-pills nav-stacked ">
        		<li><a href="index.php">Home Page</a></li>
  					<li><a href="product_detail.php">Product Page</a></li>
  					<li><a href="product_detail.php?CategoryID=1">1.Alcohol</a></li>
  					<li><a href="product_detail.php?CategoryID=2">2.Discretionary Foods</a></li>
					<li><a href="product_detail.php?CategoryID=3">3.Extra Item Not in Supermarket</a></li>
					<li><a href="product_detail.php?CategoryID=4">4.Fruit</a></li>
					<li><a href="product_detail.php?CategoryID=5">5.Grain Cereal Foods - Wholegrain & Refined</a></li>
					<li><a href="product_detail.php?CategoryID=6">6.Lean Meats and Poultry,Fish Eggs Nuts and Seeds</a></li>
					<li><a href="product_detail.php?CategoryID=7">7.Milk, Youhurt, Chees and Alternatives</a></li>
					<li><a href="product_detail.php?CategoryID=8">8.Other</a></li>
					<li><a href="product_detail.php?CategoryID=9">9.Other Foods is Core Foods Not in Both Basket and/or Mixed Foods</a></li>
					<li><a href="product_detail.php?CategoryID=10">10.Unsaturated Oils and Spreds or Foods from Which These are Derives</a></li>
					<li><a href="product_detail.php?CategoryID=11">11.Vegetables and Legumes</a></li>
					
  					
</ul>



</div>


<div class="main" id="showBox" >

<div class="showBox table-responsive" >

	<table class="table table-bordered table-hover">
  <thead>
    <tr>
      
      <th>Food Name</th>
      <th>Specific brand</th>
	  <th>Your brand</th>
      <th>Specific size</th>
	  <th>Your size</th>
	  <th>Your cost</th>
	  <th>Comments</th>
	  <th>Price promoted</th>
      

    </tr>
  </thead>
  
<!--
	var id=parseInt(window.location.search.slice(12));
		if(id == ""){
		
		}
-->
 
	<tbody id="table">
 <?php 
		$id=substr($_SERVER['REQUEST_URI'],-1);
		if($id=='p'){
			$sql="select * from foodDetails";
		}
		else {
			$sql="select * from foodDetails where categoryID=".$id;
		}
		$connect=oci_connect(DB_USER,DB_PWD,DB_HOST);
		echo $_server["request_url"];
		
		$stmt=oci_parse($connect,$sql);
        oci_execute($stmt);
		$quality=0;
		$table="<script>";

    echo '<tr><td><select name="foodName" id="foodName">';

        while($row=oci_fetch_array($stmt)){
				
		
    echo '<option value="'.$row[1].'">'.$row[1].'</option>';
          
				
		}

    echo '</select></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td><td><select name="foodName" id="foodName">
        <option value="ml">ml</option>
        <option value="L">L</option>
        <option value="kg">per kg</option>
        <option value="g">g</option>
        <option value="pizza">pizza</option>
    </select></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td></tr>';
		
	    $table+='</script>';

		
		
  ?>
	</tbody>
    </table>

</div>





</div>


    

    

<div>
	<button class="Input_button" id="product_submit">Input</button>
</div>
<!--
 <div class="pagination-js" id="pagination">
	<ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>
</div>
-->
<div class="footer" id="footer">
  <p>The cost of healthy food is one of the most important health issues facing people living in remote areas of Australia.  Without access to good quality healthy food at affordable prices, people living in remote areas are unable to nourish themselves adequately to enjoy consistent good health and a long healthy life.</p>
<p>The calculator below is designed to help you measure the cost of a selection of healthy foods from your local community store that would be sufficient to meet the needs of a family  of 6 people for 14 days.  From this point forward, this selection of foods will be termed the 14 DAY FAMILY FOOD SELECTION.  You can read about the methodology behind the development of the selection of healthy foods here.</p>
<p>People who would find this calculator useful include anyone concerned about the cost of healthy foods in remote areas of Australia.  This could include:</p>
<ul>
    <li>remote community store managers</li>
    <li>remote community teachers and nurses</li>
    <li>community council clerks</li>
    <li>women's centre coordinators</li>
    <li>store committee members</li>
    <li>health and/or nutrition and dietetics students</li>
    <li>members of the Country Women's association</li>
    <li>District Medical Officers</li>
    <li>Public Health Nutritionists</li> 
    <li>And many, many others</li>
</ul>
<p>Anyone with an average amount of literacy and numeracy will find the calculator easy to use.</p>
<p>Compare your store food cost results with other store's results </p>
<p>(Source: Market Basket Survey of Remote Community Stores in the Northern Territory April - June 2005.  NT Department of Health and Community Services.)</p>
<p>Since 1998, surveys using the above methodology have only been conducted in the Northern Territory where the Market Basket Survey (MBS) of Remote Community Stores is conducted annually.  However, food security issues affect many people living in remote settlements outside the NT and in WA, SA, Qld and NSW.  </p>
<p>Food costing surveys are carried out annually in the Kimberley of WA and occasionally in Far North Queensland but there is not an agreed standard measure of food affordability between health authorities.</p>
<p>Nevertheless, if you live in a remote community anywhere in Australia, it will be useful to compare the affordability of healthy food in your community store with results obtained in the NT 2005 Market Basket Survey (MBS).  </p>
<p>How does the cost of your community food supply compare with the results below?</p>

                      

                        
                      
</div>

<script type="text/javascript">
var bt=document.getElementById("product_submit");
bt.addEventListener("click",function(){
	alert("submit")
})
	$(function() {
                $('#navigation').stop().animate({'marginLeft':'-200px'},1000);

                $('#navigation').hover(
                    function () {
                        $(this).stop().animate({'marginLeft':'-2px'},200);
                    },
                    function () {
                        $(this).stop().animate({'marginLeft':'-200px'},200);
                    }
                );
        });
		


   document.getElementsByClassName("header")[0].style.display="none";
/*    
	var table=document.getElementById("table").innerHTML;
	table="";
	var temp_table="";
	for(let i=0;i<60;i++){
		temp_table+="<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	
	}
	table=temp_table;
	document.getElementById("table").innerHTML=table;


*/
  

  
  


  function userOut(){
    <?php
    setcookie("username", "", time()-3600);
    ?>
    
    var s='<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" ><span class="glyphicon glyphicon-user"></span>  Register</a></li>';
    s+='<li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
    
    
    //document.getElementById("user").innerHTML=s;
    document.querySelector("#user").innerHTML=s;
            
    
  }
 
  
  


// var form=document.getElementById("myForm");
// var username=form.elements[0].value;
// var password.form.elements[1].value;
 // var url="addCart.php";
 //   var data={"id":productid,"src":src,"name":productname,"price":price};
 //   var num=document.getElementById('pr').innerHTML;
 //   num=parseInt(num);
   
 //   num++;
 //   var success=function(respond){
 //     if(respond==2){
       
 //       window.location.href='register.php';
 //     }
  
      
 //   }
 //   $.post(url,data,success,"json");
 //   document.getElementById('pr').innerHTML=num;
 //   alert('add successfully!');

</script>

</body>
</html>