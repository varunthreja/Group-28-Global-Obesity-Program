<?php 
/**
 * 连接数据库
 * @return resource
 */
function connect(){
    $connect=new mysqli('localhost','root','','scrappertest') ;
	
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
	$connect=new mysqli(DB_USER,DB_PWD,DB_HOST) ;
	$sql="INSERT INTO users VALUES ('{$user_id}','{$username}','{$password}','{$name}','{$organisiation}','{$organisiationAddress}','{$position}','{$email}','{$contactNumber}','N')";
    # $stmt=oci_parse($connect,$sql);
    mysqli_query($connect, $sql);
		#return 1;
   
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
	$connect=new mysqli(DB_USER,DB_PWD,DB_HOST);
    $stmt=mysqli_query($connect,$sql);
    return $stmt;
}





?>