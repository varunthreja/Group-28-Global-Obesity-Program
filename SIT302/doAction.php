<?php 
 
require_once 'dbfunction.php';
require_once 'config.php';
//session_start();


$act=$_REQUEST['act'];
if($act==="reg"){
    reg();
}elseif($act==="login"){
    login();
}elseif($act==="check"){
    check();
}else if($act==="update"){
	update();
}else if($act==="input"){
    input();
}else if($act==="update1"){
    update1();
}else if($act==="search"){
    search();
}
function update(){
    $connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    $userID=$_POST["userID"];
    $status="select confirmed from users where userID='{$userID}'";
    $result = $connect->query($status);

    $value="";
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row["confirmed"] == 1){
            $value = 0;
        }
        else{
            $value = 1;
        }
    }
    
    $sql="update users set confirmed='{$value}' where userID='{$userID}'";    
    if($connect->query($sql) === TRUE){
        echo 1;
    }else{
        echo 2;
    }
}

function update1(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    //apply  htmlentities function
    $username=$_COOKIE["username"];
    $organisation=htmlentities($_POST['organisation']);
    $organisationAddress=htmlentities($_POST['organisationAddress']);
    $position=htmlentities($_POST['position']);
    $email=htmlentities($_POST['email']);
    $contactNumber=htmlentities($_POST['contactNumber']);
    $name=htmlentities($_POST['realname']);

    $result="update users set name='{$name}',organisation='{$organisation}',organisationAddress='{$organisationAddress}',position='{$position}',email='{$email}',contactNumber='{$contactNumber}' where username='{$username}';";
    # $conn->exec($result);
    if (mysqli_query($conn, $result)) {
        
        echo "<script>window.location='account_setting.php'</script>";

    } else {
        echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
}

function reg(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    //apply  htmlentities function
    //$userID=htmlentities($_POST['userID']);
    $username=htmlentities($_POST['username']);
    $password=htmlentities($_POST['password']);
    $salt='salt1024';
    $password=md5($salt.$password);
    $organisation=htmlentities($_POST['organisation']);
    $organisationAddress=htmlentities($_POST['organisationAddress']);
    $position=htmlentities($_POST['position']);
    $email=htmlentities($_POST['email']);
    $contactNumber=htmlentities($_POST['contactNumber']);
    $name=htmlentities($_POST['realname']);

    $result="INSERT INTO users (username, password, name, organisation, organisationAddress, position, email, contactNumber,confirmed) VALUES ('{$username}','{$password}','{$name}','{$organisation}','{$organisationAddress}','{$position}','{$email}',$contactNumber,0)";
    # $conn->exec($result);
    if (mysqli_query($conn, $result)) {
        echo "<script>window.location='login.php'</script>";

    } else {
        echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
    
}

function login(){
    //apply  htmlentities function
    $username=htmlentities($_POST['username']);
    $password=htmlentities($_POST['password']);
	
	// //Random String of salt used for everyone
    $salt = 'salt1024';
    $password = md5($salt.$password);
      
    $conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
	$sql="SELECT * FROM users where username='{$username}' and password='{$password}'";
    $stmt=$conn->query($sql);
	$results=mysqli_fetch_array($stmt);
    
    if($results["username"]){
       /* 
        $_COOKIE['username']=$username;
        $connect=oci_connect(DB_USER,DB_PWD,DB_HOST);
        $sql="select * from u where username='{$username}'" ;
        $stmt=oci_parse($connect, $sql);
        oci_execute($stmt);
        $email=array();
        $i=0;
        while (oci_fetch_array($stmt)){ $email[$i]=oci_result($stmt,'EMAIL');$i++; }//****
        $_COOKIE['email']=$email[0];
        
        */
		if($username=="admin"){
			setcookie("username", $username, time()+3600);
			session_start();
			echo 3;
		}elseif ($results["confirmed"]==0){
			echo 4;
		}else {
			setcookie("username", $username, time()+3600);
			session_start();
			echo 1;
		}	
        
    }else{
       echo 2;
       
    }
    
}

function check(){
	 $connect=oxci_connectci_connect(DB_USER,DB_PWD,DB_HOST) ;
	
    if (!$connect) {
    echo "error, couldn't connect to ".DB_HOST." database.";
    exit;	
}
    $username=$_POST["username"];
    $sql="select * from users where username='{$username}'";
    $stmt=oci_parse($connect,$sql);
    $result=oci_execute($stmt);
	$row=oci_fetch_array($stmt);
    if($row){
        echo 1;
    }
    else{
        echo 2;
    }
}
function input(){
    //apply  htmlentities function
    $foodName=htmlentities($_POST['foodName']);
    $brand=htmlentities($_POST['ybrand']);
    $servingSize=htmlentities($_POST['ysize']);
    $foodSize=htmlentities($_POST['foodSize']);
    $price=htmlentities($_POST['yourCost']);
    $comments=htmlentities($_POST['comments']);
    $pricePromoted=htmlentities($_POST['pricePromoted']);
    $pricePer=1;
    $servingSize=$servingSize.$foodSize;
    $conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    $collectionDate=date("Y-m-d")." ".date("H:i:s");
    $sql="select * from fooddetails where foodName ='{$foodName}'";
    $stmt=$conn->query($sql);
    $results=mysqli_fetch_array($stmt);
    if($results){
        
       $foodID=$results["foodID"];
    }
    else {
    $foodName1='"'.$foodName.'"';
    $sql="select * from fooddetails where foodName ='{$foodName1}'";
    $stmt=$conn->query($sql);
    $results=mysqli_fetch_array($stmt);
    $foodID=$results["foodID"];
}




    $sql="INSERT INTO main (foodID, collectionDate, brand, servingSize, price, pricePer, pricePromoted,comments) VALUES ('{$foodID}','{$collectionDate}','{$brand}','{$servingSize}','{$price}','{$pricePer}','F','{$comments}')";


    if(mysqli_query($conn, $sql)){
        
      echo "<script>window.location='product_detail.php'</script>";
    }
}





function search(){
    $foodName=htmlentities($_POST['foodName']);
    $conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    $sql="select * from fooddetails where foodName ='{$foodName}'";
    $stmt=$conn->query($sql);
    $results=mysqli_fetch_array($stmt);
    if($results){
        
        echo '"'.$results["foodSpecificBrand"].'+'.$results["servingSize"].'"';
    }
    $foodName='"'.$foodName.'"';
    $sql="select * from fooddetails where foodName ='{$foodName}'";
    $stmt=$conn->query($sql);
    $results=mysqli_fetch_array($stmt);
    if($results){
        
        echo '"'.$results["foodSpecificBrand"].'+'.$results["servingSize"].'"';
    }
}

?>
