<?php
	require_once "include.php" 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju Your Fashion Shop">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
  <script
  src="https://code.jquery.com/jquery-2.1.1.min.js"
  integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="asset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" />

<style>

.error{color:red;}

.registerTable{
  width:30%;
  height:500px;
  border:1px solid;
  display:flex;
  align-items:center;
  justify-content:center;
  //position:absolute;
  top:0;
  left:0;
  right:0;
  bottom:0;
  margin:auto;
 }


.submit{
  position:relative;
  width:50%;
  margin:0 auto;
}



</style>


</head>

<body>
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
				echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Basket Analysis</span></a></li>';
			} 
		?>
		<li><a href="about.php"><span>About Us</span></a></li>
		<li><a href="contactus.php"><span>Contact Us</span></a></li>
		<?php
			if (isset($_COOKIE["username"])){	
				$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
				$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					if($row["isAdmin"] == 1){
						echo '<li><a href="admin.php"><span>Admin Panel</span></a></li>';
					}
				}
			}
		?>
	</ul>
    </div>
  </div>

   <div class="registerTable">
  
  <div>
   <form method="post" action="doAction.php?act=reg" id="myForm" > 
  
                            <div>
                                <input type="text" onblur="validate(this.value, 'username')" name="username" placeholder="User name" id="username" required>
                                <p></p>
                            </div>
                           
                            <div>
                                <input type="password" onblur="validate(this.value, 'password')" name="password" placeholder="Password" id="password"  required>
                                <p id="passwordSuggestion" class="error"></p>
                            </div>
              <div>
                                <input type="text" onblur="validate(this.value, 'name')" name="realname" placeholder="Full name" id="realname" required>
                                <p></p>
                            </div>
            
                <div>
                                <input type="text" onblur="validate(this.value, 'organisation')" name="organisation" placeholder="Organisation" id="organisation" required>
                                <p></p>
                            </div>
                            <div>
                                <input type="text" onblur="validate(this.value, 'organisationAddress')" name="organisationAddress" placeholder="Organisation Address" id="organisationAddress" required>
                                <p></p>
                            </div>
                             <div>
                                <input type="text" onblur="validate(this.value, 'position')" name="position" placeholder="position" id="position" required>
                                <p></p>
                            </div>
                           <div>
                                <input type="email" onblur="validate(this.value, 'email')" name="email" placeholder="email" id="email" required>
                                <p></p>
                            </div>
                             <div>
                                <input type="text" onblur="validate(this.value, 'contactNumber')" name="contactNumber" placeholder="contactNumber" id="contactNumber" maxlength="10" required>
                                <p></p>
                            </div>
              
                            <div class="submit">
                                <button type="submit" id="button"> Register</button>
                            </div>
              </br>
              <p id="userSuggestion" class="error"></p>
              
     </form>
</div>    
    
</div>

    <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="checkinfo.js"></script>
</body>
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->

<script>
  

  var username=document.getElementById("username");
  var password=document.getElementById("password");
  var time;
  var organisation=document.getElementById("organisation");
  var organisationAddress=document.getElementById("organisationAddress");
  var position=document.getElementById("position");
  var contactNumber=document.getElementById("contactNumber");
  var name=document.getElementById("realname");
  
    username.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(username.value,1);
      },1000);
  

  });
  
   username.addEventListener("blur",function (){
    
  var url="doAction.php?act=check";
  var data={"username":username.value};
  var success=function(respond){
    if(respond==2){
      document.getElementById("userSuggestion").innerHTML="";
      document.getElementById("button").disabled=false;
    
    }
    else if(respond==1){
      document.getElementById("userSuggestion").innerHTML="username has existed";
      document.getElementById("button").disabled=true;
    }
  };
  $.post(url,data,success,"json");
});
  
  
  password.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(password.value,2);
      },1000);
  

  });
    name.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  alert(1);
     time=setTimeout(function(){
     check(name.value,1);
      },1000); 

  });
    
  organisation.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(organisation.value,3);
      },1000);
  

  });
  organisationAddress.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(organisationAddress.value,3);
      },1000);
  

  });
  
  
  position.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(position.value,4);
      },1000);
  

  });
  contactNumber.addEventListener("keyup",function(){
     if(typeof time=="number"){
      clearTimeout(time);
      }
  
     time=setTimeout(function(){
     check(contactNumber.value,5);
      },1000);
  

  });
  



  function check(value,type){
    var url="checkinfo.php";
    var data={"text":value,"type":type};
    
    
    
    var success=function(respond){
      
      if(respond==10){
        
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==11){
        
        document.getElementById("userSuggestion").innerHTML="The username needs to be between 4 to 20 characters long";
        document.getElementById("button").disabled=true;
      }
      else if(respond==12){
        document.getElementById("userSuggestion").innerHTML="The username should only contain alphanumeric characters and hypens";
        document.getElementById("button").disabled=true;
      }
      else if(respond==20){
        
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==21){
        
        document.getElementById("userSuggestion").innerHTML="The password should only be between 6 to 32 characters long";
        document.getElementById("button").disabled=true;
      }
      else if(respond==22){
        document.getElementById("userSuggestion").innerHTML="The password can only be 6 to 32 characters containing alphanumeric characters and hypens";
        document.getElementById("button").disabled=true;
      }
      else if(respond==30){
        
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==31){
        
        document.getElementById("userSuggestion").innerHTML="The organisation should only be between 2 to 20 characters long";
        document.getElementById("button").disabled=true;
      }
      else if(respond==32){
        document.getElementById("userSuggestion").innerHTML="The organisation can only contain alphanumeric characters, hypens and spaces";
        document.getElementById("button").disabled=true;
      }
      else if(respond==40){
        
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==41){
        
        document.getElementById("userSuggestion").innerHTML="The position should only be between 2 to 200 characters long";
        document.getElementById("button").disabled=true;
      }
      else if(respond==42){
        document.getElementById("userSuggestion").innerHTML="The position can only be 2 to 200 characters containing alphanumeric characters, hypens and spaces";
        document.getElementById("button").disabled=true;
      }
      else if(respond==52){
        document.getElementById("userSuggestion").innerHTML="The contact number cannot be empty";
        document.getElementById("button").disabled=true;
      }
      else if(respond==50){
        document.getElementById("userSuggestion").innerHTML="";
        document.getElementById("button").disabled=false;
      }
      else if(respond==51){
        document.getElementById("userSuggestion").innerHTML="The contact number can only contain 10 numbers";
        document.getElementById("button").disabled=true;
      }
    }
    $.post(url,data,success,"json");
  }

function isEmpty(value){
    value = value.trim();
    var valid = false;
    if(value != ""){
      valid = true;
    }
    return valid;
}

function isValid(value){
    value = value.trim();
    var valid = false;
    if(value.length >= 2){
      valid = true;
    }
    return valid;
}

function validate(value, prefix){
    var status = false;
    var id = "userSuggestion";
    switch (prefix){
      case 'username':
        if(isEmpty(value)){
          if(isValid(value)){
            if(/[a-zA-Z0-9\-]{4,20}$/.test(value)){
              status = true;
              document.getElementById(id).innerHTML = "";
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " can only contain alphanumeric characters, hypens and spaces";
            }  
          }
          else{
            document.getElementById(id).innerHTML = "The " + prefix + " should only be between 4 to 20 characters long";           
          }
        }
        else {      
          document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
        }
        break;
      case "password":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/[0-9\w\-]{6,32}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only be 6 to 32 characters containing alphanumeric characters and hypens";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 6 to 32 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
      case "name":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[A-Za-z ]{2,100}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only contain letters and spaces";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 2 to 100 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
      case "organisation":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[0-9A-Za-z -]{2,20}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only contain alphanumeric characters, hypens and spaces";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 2 to 20 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
    
    case "organisationAddress":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[0-9A-Za-z -]{4,200}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only contain alphanumeric characters, hypens and spaces";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 2 to 200 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
    case "position":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[A-Za-z ]{4,50}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only be 2 to 200 characters containing alphanumeric characters, hypens and spaces";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 2 to 200 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
    case "email":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[a-zA-Z.0-9_-]+@[a-zA-Z]+\.[a-zA-Z.]+$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only contain alphanumeric characters, periods, hypens, spaces and underscores";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " should only be between 4 to 50 characters long";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
    case "contactNumber":
        if(isEmpty(value)){
            if(isValid(value)){
              if(/^[0-9]{10}$/.test(value)){
                status = true;
                document.getElementById(id).innerHTML = "";
              }
              else{
                document.getElementById(id).innerHTML = "The " + prefix + " can only contain 10 numbers";
              }  
            }
            else{
              document.getElementById(id).innerHTML = "The " + prefix + " can only contain 10 numbers";           
            }
          }
          else {      
            document.getElementById(id).innerHTML = "The " + prefix + " cannot be empty nor be whitespace";
          }
        break;
    }

    return status;
}
    



</script>

</body>

</html>
