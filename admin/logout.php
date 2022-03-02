<?php
include('../inc/admins.php'); 
// Logout
		$tv  = time();
	    $act = "Logged Out";
        session_destroy();
        header("Location: ../auth");
		
?>