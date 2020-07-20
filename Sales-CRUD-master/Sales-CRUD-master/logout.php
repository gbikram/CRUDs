<?php
	include("common.php");
	checkState("login.php", false);	// Redirects to start.php if user is logged out.
	
	// End session
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: login.php");
?>