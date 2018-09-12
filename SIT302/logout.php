<?php
    setcookie('username', '',time() - 3600);
	setcookie('PHPSESSID', '', time() - 3600);
	
	if(session_id() != "") {
        session_destroy();
    }

	echo "<script>window.location='index.php'</script>";
?>