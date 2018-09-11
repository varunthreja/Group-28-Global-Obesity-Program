
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
    
	
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="asset.css">

<style>

.error{color:red;position:relative;
		top:10px;
}

.registerTable{
  width:30%;
  height:200px;
  border:1px solid;
  display:flex;
  align-items:center;
  justify-content:center;
  position:absolute;
  top:0;
  left:0;
  right:0;
  bottom:0;
  margin:auto;
  padding:10px;
 }

.submit{
  position:relative;
  width:50%;
  margin:10px auto;
}



</style>


</head>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="color:white">Healthy Diets ASAP</a>
    </div>
</nav>	

<body >

   <div class="registerTable">
  
  
	 <form method="post" action="doAction.php?act=login" id="loginForm" > 
  
                            
                                <input type="text" name="username" id="1" placeholder="user name" onblur="get(this.value)" class="text" required >
								<p></p>
                                <input type="password" name="password" class="text" placeholder="password" id="123" onblur="show(this.value)"  required>
								<p></p>
                            
							    <div class="submit">
                                <button type="submit" id="loginButton">log in</button>
							     </div> 
							
							
							<div id="loginSuggestion" class="error">
							 
							</div>
							
							
     </form>
     </div>
    
	                       
    
</body>
    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->

<script>
     
	 var form=document.getElementById("loginForm");
	 var username;
	 var password;
	 var suggestion=document.getElementById("loginSuggestion");
	 // var a=document.getElementById("123");
	 // a.focus();
	  form.addEventListener("submit",function(e){
		 
		
		 
		 url="doAction.php?act=login";
		 data={"username":username,"password":password};
		 var success=function(respond){
			 if(respond==1){
				 suggestion.innerHTML="";
				 window.location="index.php";
			 }
			 else if(respond==2){
				  suggestion.innerHTML="password was incorrect";
			 }
			 else if(respond==3){
				 suggestion.innerHTML="";
				 window.location="admin.php";
			 }
	
		 };
		 $.post(url,data,success,"json");
		
		 
		 e.preventDefault();
		 
	 })
	 
	 function show(a){
		 password=a;
		 
	 }
	 
	 function get(a){
		 username=a;
		 
	 }
	 
	 // function getValue(){

	 // }
	 
	 // var enter=document.querySelector("#123");
	 // enter.addEventListener("keyup",function(e){
		 // if(e.keyCode==13){
			 // alert(1);
			 // document.querySelector("#loginButton").click();
			 // return false;
		 // }
	 // });


</script>

</body>

</html>
