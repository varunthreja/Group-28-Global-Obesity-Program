<?php 
function reg(){
    //apply  htmlentities function
    $username=htmlentities($_POST['username']);
	$password=htmlentities($_POST['password']);
//Random String of salt used for everyone
	//$salt = 'salt1024';
	
	# Hash password
	//$password = md5($salt.$user_password);
	
    $email=htmlentities($_POST['email']);
    
    if(insert($username,$password,$email)){
		$_COOKIE['username']=$username;
		$_COOKIE['email']=$email;
        echo '<script>window.location.href="index.php"</script>';
    }
    
}

function login(){
    //apply  htmlentities function
    $username=htmlentities($_POST['username']);
	
    $password=htmlentities($_POST['password']);


	
	//Random String of salt used for everyone
	//$salt = 'salt1024';
	
	# Hash password
	//$password = md5($salt.$user_password);
	
	
    $sql="select * from user_detail where username='{$username}' and password='{$password}'";
   
    
    $row=fetchOne($sql);
    
    if($row){
        
        $_COOKIE['username']=$username;
		$connect=oci_connect("liteng", "Li86459451","SSID");
        $sql="select * from user_detail where username='{$username}'" ;
        $stmt=oci_parse($connect, $sql);
        oci_execute($stmt);
        $email=array();
		$i=0;
        while (oci_fetch_array($stmt)){ $email[$i]=oci_result($stmt,'EMAIL');$i++; }
		$_COOKIE['email']=$email[0];
		
		
        echo '<script>window.location.href="index.php"</script>';
		
    }else{
       echo "false！<a href='index.php'>log again</a>";
	   
    }
    
}

function userOut(){
    
    setcookie(session_name(),"",time()-1);
    session_destroy();
    
	echo "<script>window.location.href='index.php'</script>";
}




