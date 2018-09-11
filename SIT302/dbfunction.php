<?php 
include "config.php";
/**
 * 连接数据库
 * @return resource
 */
function connect(){
    // $connect=new mysqli('localhost','root','','scrappertest');
    //The variables below are imported from the info you should have placed in the config.php file
    $connect=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_TABLENAME);
	
    if ($connect->connect_error) {
		die("Connection failed: " . $connect->connect_error);
	}
	 
    return $connect;
}

/**
 * 完成记录插入的操作
 * @param string $username,$password,$email
 * @return number
 */
function insert($username,$password,$name,$organisiation,$organisiationAddress,$position,$email,$contactNumber){
	
    
	$user_id=rand(1,999999);
	$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	//NOTE I made it so that the confirmed and isAdmin columns are set to 0 by default 
	$sql="INSERT INTO users (userID, username, password, name, organisation, organsiationAddress , position, email, contactNumber, confirmed, isAdmin) VALUES ('{$user_id}','{$username}','{$password}','{$name}','{$organisiation}','{$organisiationAddress}','{$position}','{$email}','{$contactNumber}',0, 0)";
    //mysqli_query($connect, $sql);
    
    //NOTE This block isn't necessary I just used this for testing
    if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	return 1;
   
}

 

//update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 * @param string $username,$password
 * @return string
 */


/**
 *得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function execute($sql){
	//$connect=new mysqli(DB_USER,DB_PWD,DB_HOST);	
    //$stmt=mysqli_query($connect,$sql);
    //return $stmt;

    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    $result = $conn->query($sql);
    return $result
}





?>