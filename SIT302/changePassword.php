<?php
include "config.php";
    $username=$_POST["username"];
    $password=htmlentities($_POST["password"]);
	$password=md5('salt1024'.$password);
	$conn = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_TABLENAME);
    $sql="update users set password='{$password}' where username = '{$username}'";
    $conn->query($sql);
	
	
    
    echo 1;
?>