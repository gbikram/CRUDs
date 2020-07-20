<?php
	include("common.php");
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	processLogin($db);
	
	function processLogin($db) {
		$email = $_POST["email"];
		$password = $_POST["password"];
		$query = "Select *
					From useraccount
					Where UserPass = '$password'
					AND email = '$email'";
		$result = mysqli_query($db, $query);
		if (!$result) {
        	echo 'MySQL Error: ' . mysqli_error($db);
        	exit;
    	}	

		$num = mysqli_num_rows($result);

		if($num == 1) {
			startSession("on");
		} else {
			header("Location:login.php?error=1");
		}

	}

	function startSession($status) {
		session_start();
		$_SESSION["status"] = $status;
		date_default_timezone_set('America/Los_Angeles');
		setcookie("time", date("D y M d, g:i:s a"), time() + 60 * 60 * 24 * 7);
		header("Location:viewOrders.php?stat=all");
	}
?>