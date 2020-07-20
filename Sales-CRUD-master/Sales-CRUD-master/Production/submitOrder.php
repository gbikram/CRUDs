<?php 
include("common.php");
// Submit Values to Product Table
// Submit to Order Table
$prodID;
createProduct($db);
function createProduct($db) {
	$prodType = $_POST['productType'];
	$length = $_POST['length'];
	$thick = $_POST['thick'];
	$weight = $_POST['weight'];
	$query = "	Insert into orderproduct(CategoryID, Length_m, Thickness_mm, Weight_kg) 
				values('$prodType', '$length', '$thick', '$weight')";
	$db->query($query);
	$prodID = mysqli_insert_id($db);
	if($prodType == 1) {
		$outDia = $_POST['oDia'];
		$query2 = "	Insert into productround(ProductID, OutsideDiameter_mm)
					values('$prodID', '$outDia')";
	} else if($prodType == 2) {
		$sideA = $_POST['sA'];
		$sideB = $_POST['sB'];
		$query2 = "	Insert into productrectsquare(ProductID, SideA_mm, SideB_mm)
					values('$prodID', '$sideA', '$sideB')";
	} else if($prodType == 3) {
		$width = $_POST['width'];
		$query2 = "	Insert into productcoil(ProductID, Width_m)
					values('$prodID', '$width')";
	}
	$db->query($query2);
	echo("Product Create Success");
	createOrderQuote($db, $prodID);
}

function createOrderQuote($db, $pID) {
	$customerID = $_POST['customerId'];
	$dueDate = $_POST['dueDate'];
	$orderDate = $_POST['orderDate'];
	$orderStatus = $_POST['currentStatus'];
	$quant = $_POST['quan'];
	$totalPrice = $_POST['totPrice'];	
	$query = "	Insert into orderquote(CustomerID, ProductID, OrderDate, DueDate, OrderStatus, QuantityOrdered, 				TotalPrice) values ('$customerID', '$pID', '$orderDate', '$dueDate', '$orderStatus', '$quant', '$totalPrice')";
	$db->query($query);
	echo("Quote Created");
	header("Location: indivorder.php?type=o");

}
?>