<?php 
	// View All Orders
	// Sort By Status
	// Table Details: Customer Name -- ProdCateg -- Quantity -- Total Price -- Status -- Due Date
	include("common.php");
	top();
	navBar();
	$orderList = getAllOrders($db);
	if($_GET['stat'] == 'pend') {
		$orderList = getSelectedOrders($db, "Pending");
	} elseif ($_GET['stat'] == 'ip') {
		$orderList = getSelectedOrders($db, "In Progress");
	} elseif ($_GET['stat'] == 'disp') {
		$orderList = getSelectedOrders($db, "Dispatched");
	}
	generateTable($db, $orderList);
	function generateTable($db, $orderList) { ?>
		<div class="container" id="order-tab">
		  <h2>View Orders</h2>
		  <p>View By: <a href="viewOrders.php?stat=all">All | </a><a href="viewOrders.php?stat=pend">Pending | </a><a href="viewOrders.php?stat=ip">In Progress | </a><a href="viewOrders.php?stat=disp">Dispatched</a></p>
		  <table class="table">
		    <thead>
		      <tr>
		        <th>Customer Name</th>
		        <th>Product Type</th>
		        <th>Status</th>
		        <th>Due Date</th>
		        <th>Quantity</th>
		        <th>Total Price</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php echo $orderList?>
		    </tbody>
		  </table>
		</div>
		<?php
	}

	function getAllOrders($db) {
		$queryIndiv = "	Select CONCAT(ci.FName, ' ', ci.LName) as Name, 
					pc.CategoryName, 
					oq.OrderStatus, 
					oq.DueDate,
					oq.QuantityOrdered,
					oq.TotalPrice,
					op.ProductID,
					ci.CustomerID,
					oq.OrderDate,
					pc.CategoryID,
					op.Length_m,
					op.Thickness_mm,
					op.Weight_kg
					From customer c
					inner join customer_indiv ci
					on c.CustomerID = ci.CustomerID
					inner join orderquote oq
					on oq.CustomerID = c.CustomerID
					inner join orderproduct op
					on op.ProductID = oq.ProductID
					inner join productcategory pc
					on pc.CategoryID = op.CategoryID";
		$result = mysqli_query($db, $queryIndiv);
		$out = "";
		while($row = mysqli_fetch_array($result)) {
			$out .= '<form action="updateOrder.php" method="post">';			
			$out .= '<tr>';
			$out .= '<td>'.$row['Name'].'</td>';
			$out .= '<td>'.$row['CategoryName'].'</td>';
			$out .= '<td>'.$row['OrderStatus'].'</td>';
			$out .= '<td>'.$row['DueDate'].'</td>';
			$out .= '<td>'.$row['QuantityOrdered'].'</td>';
			$out .= '<td>'.$row['TotalPrice'].'</td>';
			$out .= '<td><button type="submit" class="btn">View</button></td>';
			$out .= '<td style="display: none;">
						<input type=number name="viewCustId" value='.$row['CustomerID'].'>
						<input type=number name="viewProdID" value='.$row['ProductID'].'>
						<input type=date name="viewOrdDate" value='.$row['OrderDate'].'>
						<input type=date name="viewDueDate" value='.$row['DueDate'].'>
						<input type=number name="viewCatId" value='.$row['CategoryID'].'>
						<input type=text name="viewOrdStatus" value="'.$row['OrderStatus'].'">
						<input type=text name="viewCustName" value="'.$row['Name'].'">
						<input type=text name="viewProdName" value="'.$row['CategoryName'].'">
						<input type=number name="viewQuan" value='.$row['QuantityOrdered'].'>
						<input type=number name="viewPrice" value='.$row['TotalPrice'].'>
						<input type=number name="viewLen" value='.$row['Length_m'].'>
						<input type=number name="viewThick" value='.$row['Thickness_mm'].'>
						<input type=number name="viewWt" value='.$row['Weight_kg'].'>
					</td>';
			$out .= '</tr>';
			$out .= '</form>';

		}

		$queryOrg = "	Select co.OrgName as Name, 
					pc.CategoryName, 
					oq.OrderStatus, 
					oq.DueDate,
					oq.QuantityOrdered,
					oq.TotalPrice,
					op.ProductID,
					co.CustomerID,
					oq.OrderDate,
					pc.CategoryID,
					op.Length_m,
					op.Thickness_mm,
					op.Weight_kg 
					From customer c
					inner join customer_org co
					on c.CustomerID = co.CustomerID
					inner join orderquote oq
					on oq.CustomerID = c.CustomerID
					inner join orderproduct op
					on op.ProductID = oq.ProductID
					inner join productcategory pc
					on pc.CategoryID = op.CategoryID";
		
		$result2 = mysqli_query($db, $queryOrg);
		while($row = mysqli_fetch_array($result2)) {
			$out .= '<form action="updateOrder.php" method="post">';
			$out .= '<tr>';
			$out .= '<td>'.$row['Name'].'</td>';
			$out .= '<td>'.$row['CategoryName'].'</td>';
			$out .= '<td>'.$row['OrderStatus'].'</td>';
			$out .= '<td>'.$row['DueDate'].'</td>';
			$out .= '<td>'.$row['QuantityOrdered'].'</td>';
			$out .= '<td>'.$row['TotalPrice'].'</td>';
			$out .= '<td><button type="submit" class="btn">View</button></td>';
			$out .= '<td style="display: none;">
						<input type=number name="viewCustId" value='.$row['CustomerID'].'>
						<input type=number name="viewProdID" value='.$row['ProductID'].'>
						<input type=date name="viewOrdDate" value='.$row['OrderDate'].'>
						<input type=date name="viewDueDate" value='.$row['DueDate'].'>
						<input type=number name="viewCatId" value='.$row['CategoryID'].'>
						<input type=text name="viewOrdStatus" value="'.$row['OrderStatus'].'>
						<input type=text name="viewCustName" value="'.$row['Name'].'">
						<input type=text name="viewProdName" value="'.$row['CategoryName'].'">
						<input type=number name="viewQuan" value='.$row['QuantityOrdered'].'>
						<input type=number name="viewPrice" value='.$row['TotalPrice'].'>
						<input type=number name="viewLen" value='.$row['Length_m'].'>
						<input type=number name="viewThick" value='.$row['Thickness_mm'].'>
						<input type=number name="viewWt" value='.$row['Weight_kg'].'>
					</td>';
			$out .= '</tr>';
			$out .= '</form>';
		}
		return $out;
	}

	function getSelectedOrders($db, $view) {
		$queryIndiv = "	Select CONCAT(ci.FName, ' ', ci.LName) as Name, 
					pc.CategoryName, 
					oq.OrderStatus, 
					oq.DueDate,
					oq.QuantityOrdered,
					oq.TotalPrice,
					op.ProductID,
					ci.CustomerID,
					oq.OrderDate,
					pc.CategoryID,
					op.Length_m,
					op.Thickness_mm,
					op.Weight_kg 
					From customer c
					inner join customer_indiv ci
					on c.CustomerID = ci.CustomerID
					inner join orderquote oq
					on oq.CustomerID = c.CustomerID
					inner join orderproduct op
					on op.ProductID = oq.ProductID
					inner join productcategory pc
					on pc.CategoryID = op.CategoryID
					Where oq.OrderStatus = '$view'";
		$result = mysqli_query($db, $queryIndiv);
		$out = "";
		while($row = mysqli_fetch_array($result)) {
			$out .= '<form action="updateOrder.php" method="post">';			
			$out .= '<tr>';
			$out .= '<td>'.$row['Name'].'</td>';
			$out .= '<td>'.$row['CategoryName'].'</td>';
			$out .= '<td>'.$row['OrderStatus'].'</td>';
			$out .= '<td>'.$row['DueDate'].'</td>';
			$out .= '<td>'.$row['QuantityOrdered'].'</td>';
			$out .= '<td>'.$row['TotalPrice'].'</td>';
			$out .= '<td><button type="submit" class="btn">View</button></td>';
			$out .= '<td style="display: none;">
						<input type=number name="viewCustId" value='.$row['CustomerID'].'>
						<input type=number name="viewProdID" value='.$row['ProductID'].'>
						<input type=date name="viewOrdDate" value='.$row['OrderDate'].'>
						<input type=date name="viewDueDate" value='.$row['DueDate'].'>
						<input type=number name="viewCatId" value='.$row['CategoryID'].'>
						<input type=text name="viewOrdStatus" value="'.$row['OrderStatus'].'">
						<input type=text name="viewCustName" value="'.$row['Name'].'">
						<input type=text name="viewProdName" value="'.$row['CategoryName'].'">
						<input type=number name="viewQuan" value='.$row['QuantityOrdered'].'>
						<input type=number name="viewPrice" value='.$row['TotalPrice'].'>
						<input type=number name="viewLen" value='.$row['Length_m'].'>
						<input type=number name="viewThick" value='.$row['Thickness_mm'].'>
						<input type=number name="viewWt" value='.$row['Weight_kg'].'>
					</td>';
			$out .= '</tr>';
			$out .= '</form>';

		}

		$queryOrg = "	Select co.OrgName as Name, 
					pc.CategoryName, 
					oq.OrderStatus, 
					oq.DueDate,
					oq.QuantityOrdered,
					oq.TotalPrice,
					op.ProductID,
					co.CustomerID,
					oq.OrderDate,
					pc.CategoryID,
					op.Length_m,
					op.Thickness_mm,
					op.Weight_kg  
					From customer c
					inner join customer_org co
					on c.CustomerID = co.CustomerID
					inner join orderquote oq
					on oq.CustomerID = c.CustomerID
					inner join orderproduct op
					on op.ProductID = oq.ProductID
					inner join productcategory pc
					on pc.CategoryID = op.CategoryID
					where oq.OrderStatus = '$view'";
		
		$result2 = mysqli_query($db, $queryOrg);
		while($row = mysqli_fetch_array($result2)) {
			$out .= '<form action="updateOrder.php" method="post">';			
			$out .= '<tr>';
			$out .= '<td>'.$row['Name'].'</td>';
			$out .= '<td>'.$row['CategoryName'].'</td>';
			$out .= '<td>'.$row['OrderStatus'].'</td>';
			$out .= '<td>'.$row['DueDate'].'</td>';
			$out .= '<td>'.$row['QuantityOrdered'].'</td>';
			$out .= '<td>'.$row['TotalPrice'].'</td>';
			$out .= '<td><button type="submit" class="btn">View</button></td>';
			$out .= '<td style="display: none;">
						<input type=number name="viewCustId" value='.$row['CustomerID'].'>
						<input type=number name="viewProdID" value='.$row['ProductID'].'>
						<input type=date name="viewOrdDate" value='.$row['OrderDate'].'>
						<input type=date name="viewDueDate" value='.$row['DueDate'].'>
						<input type=number name="viewCatId" value='.$row['CategoryID'].'>
						<input type=text name="viewOrdStatus" value="'.$row['OrderStatus'].'">
						<input type=text name="viewCustName" value="'.$row['Name'].'">
						<input type=text name="viewProdName" value="'.$row['CategoryName'].'">
						<input type=number name="viewQuan" value='.$row['QuantityOrdered'].'>
						<input type=number name="viewPrice" value='.$row['TotalPrice'].'>
						<input type=number name="viewLen" value='.$row['Length_m'].'>
						<input type=number name="viewThick" value='.$row['Thickness_mm'].'>
						<input type=number name="viewWt" value='.$row['Weight_kg'].'>
					</td>';
			$out .= '</tr>';
			$out .= '</form>';
		}
		return $out;	
	}

?>