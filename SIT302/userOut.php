<?php 

	session_start();
    setcookie(session_name(),"",time()-1);
    session_destroy();
    
    echo "<script>window.location.href='index.php'</script>";

?> 