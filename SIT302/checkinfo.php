<?php
    $text=$_POST['text'];
	$type=$_POST['type'];
	checkType($type,$text);

	
	function checkType($type,$text){
		if ($type==1){
			checkName($text);		
		}
		else if ($type==2){		
			checkPassword($text);
		}
		else if ($type==3){
			checkOrganisation($text);
		}
		else if ($type==4){
			checkPosition($text);	
		}
		else if($type == 5){
			checkNumber($text);
		}
		else if($type == 6){
			checkEmail($text);
		}	
		else if($type == 7){
			checkOrgAddr($text);
		}
		else if($type == 8){
			checkUsername($text);
		}
	}

	function clean($data){
		$data = trim($data);
	    $data = stripslashes($data);
	    $data = strip_tags($data);
	    $data = htmlspecialchars($data);
	    $data = htmlentities($data);
	    return $data;
	}

	function checkName($text){
		$text = clean($text);
	    $regex = '/^[A-Za-z]+[A-Za-z -]*$/';
	    if (preg_match($regex,$text)) {   
			if (strlen($text)>5&&strlen($text)<=100){
				echo 10;
			}
			else{
				echo 11;		
			}
		}        	 
		else{ 
	       echo  12;         
	    } 
	}

	function checkPassword($text){
		$text = clean($text);
		$regex = '/^[0-9\w-]+$/';
		if (preg_match($regex,$text)){       
			if (strlen($text)>5&&strlen($text)<=32){
				echo 20;
			}
			else{
				echo 21;		
			}
		}  
		else{ 
			echo  22; 
		} 
	}

	function checkOrganisation($text){
		$text = clean($text);
	    $regex = '/^[0-9A-Za-z -]+$/';
		if (preg_match($regex,$text)){   
			if (strlen($text)>2&&strlen($text)<=20){
				echo 30;
			}
			else{
				echo 31;	
			}
		}   
		else{ 
			echo 32; 
		} 
	}

	function checkPosition($text){
		$text = clean($text);
		$regex = '/^[A-Za-z ]+$/';
		if (preg_match($regex,$text)){   
			if (strlen($text)>4&&strlen($text)<=50){
				echo 40;			
			}
			else{				
				echo 41;
			}
		}  
		else{ 
			echo  42; 
		} 
	}

	function checkNumber($text){
		$text = clean($text);
		$regex = '/^[0-9]{10}$/';
		if(strlen($text) == 0){
			echo 52;
		}
		else{
			if (preg_match($regex,$text)){   
				echo 50;
			}  
			else{ 
				echo  51; 
			} 
		}
	}

	function checkOrgAddr($text){
		$text = clean($text);
	    $regex = '/^[0-9A-Za-z -]+$/';
		if (preg_match($regex,$text)){   
			if (strlen($text)>4&&strlen($text)<=200){
				echo 60;
			}
			else{
				echo 61;	
			}
		}   
		else{ 
			echo 62; 
		} 
	}

	function checkEmail($text){
		$text = clean($text);
	    $regex = "/^[a-zA-Z.0-9_-]+@[a-zA-Z]+\.[a-zA-Z.]+$/";
		if (preg_match($regex,$text)){   
			if (strlen($text)>4&&strlen($text)<=50){
				echo 70;
			}
			else{
				echo 71;	
			}
		}   
		else{ 
			echo 72; 
		} 
	}

	function checkUsername($text){
		$text = clean($username);
        $regex = '/^[A-Za-z0-9]*$/';
        if (preg_match($regex,$text)) {   
            if (strlen($text)>5&&strlen($text)<=20){
                echo 80;
            }
            else{
                echo 81;        
            }
        }            
        else{ 
           echo  82;         
        }  
	}

	




















