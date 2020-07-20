<?php
include("common.php");
$orderDate = $_POST['orderDate'];
$dueDate = $_POST['dueDate'];
$stat = $_POST['currentStatus'];
$pID = $_POST['pID'];
$cID = $_POST['cID'];

$query = "	Update orderquote 
			Set OrderStatus='$stat' 
			where CustomerID = '$cID' 
			and ProductID = '$pID'
			and OrderDate='$orderDate'
			and DueDate='$dueDate'";
$db->query($query);
header("Location: viewOrders.php?stat=all");
?>