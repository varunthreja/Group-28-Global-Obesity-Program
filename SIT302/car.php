	<?php   

      $connect=oci_connect(DB_USER,DB_PWD,DB_HOST) ;
	  if(!$connect){
		  echo "false";
		  exit;
		  
	  }
	  if (isset($_COOKIE)){
	  $username=$_COOKIE['username'];
	  
	  $sql="select * from product_detail where username='{$username}'";
	  $stmt=oci_parse($connect,$sql);
	  oci_execute($stmt);
	         $id=array();
            
			 $i=0;
		     
			 
			 while(oci_fetch_array($stmt)){

				 $id[$i]=oci_result($stmt,'ID');
				 $i++;
				 
				 }
    }		 
 

