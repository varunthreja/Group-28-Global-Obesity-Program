<?php
    require_once 'config.php';

    
	$username=$_POST["username"];//User password
    $password=md5('salt1024'.htmlentities($_POST["password"]));
	$conn = new mysqli(DB_HOST,DB_USER,'',DB_TABLENAME);

	$sql="select * from users where password = '{$password}' and username = '{$username}'";
    $stmt=$conn->query($sql);
    
	if($row=$stmt->fetch_assoc()){
		echo 1;
	}else{
		echo 0;
    }
