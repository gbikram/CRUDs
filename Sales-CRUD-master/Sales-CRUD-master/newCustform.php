<?php
	include("common.php");
	top();
	navbar();
	checkState("login.php", false);
	setCustType($db);

	function setCustType($db) {
		if (!empty($_POST["f_name"])){
			$type = "i";
		} else {
			$type = "o";
		}
		
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$query = "Insert into customer(CustomerType, Email, Phone) values('$type', '$email', '$phone')";
		$db->query($query);
		$custID = mysqli_insert_id($db);
		insertCust($db, $type, $custID);
	}

	function insertCust($db, $type, $custID) {
		if ($type === "i") {	
			echo $type;	
			$FName = $_POST['f_name'];
			$LName = $_POST['l_name'];
			$query = "Insert into customer_indiv(CustomerID, FName, LName) VALUES ('$custID', '$FName', '$LName')";
			$db->query($query);
		} else if($type === "o") {
			echo $type;	
			$orgName = $_POST['org_name'];
			$query = "Insert into customer_org(CustomerID, OrgName) VALUES ('$custID', '$orgName')";
			$db->query($query);
		}
		header("Location: new-customer.php");
	}
?>