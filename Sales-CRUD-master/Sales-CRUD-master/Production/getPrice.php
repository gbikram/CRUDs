<?php
	include("common.php");
	$categ = $_GET['categ'];
	$query = "	Select PricePerKg
				From ProductCategory
				Where CategoryID = '$categ' ";
	$result = mysqli_query($db, $query);
	$rs = mysqli_fetch_array($result);
	echo $rs["PricePerKg"];
?>