<?php
	include("common.php");
	top();
	navbar();
	showOrderDetails($db);

	function showOrderDetails($db) {
		$orderDate = $_POST['viewOrdDate'];
		$dueDate = $_POST['viewDueDate'];
		$orderStatus = $_POST['viewOrdStatus'];
		$custName = $_POST['viewCustName'];
		$prodCateg = $_POST['viewProdName'];
		$quant = $_POST['viewQuan'];
		$price = $_POST['viewPrice'];
		$productID = $_POST['viewProdID'];
		$custID = $_POST['viewCustId'];
		$len = $_POST['viewLen'];
		$thick = $_POST['viewThick'];
		$wt = $_POST['viewWt'];
		?>
		<form id="updateOrderForm" action="submitChange.php" method="post">
			<div class="form-group row" style="display: none;">
			  	<label for="example-date-input" class="col-2 col-form-label">Customer ID</label>
			  	<div class="col-10">
			    	<input name="cID" class="form-control" type="text" value="<?php echo $custID;?>" readonly>
				</div>
			</div>
			<div class="form-group row" style="display: none;">
			  	<label for="example-date-input" class="col-2 col-form-label">Product ID</label>
			  	<div class="col-10">
			    	<input name="pID" class="form-control" type="text" value="<?php echo $productID;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Customer Name</label>
			  	<div class="col-10">
			    	<input class="form-control" type="text" value="<?php echo $custName;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Order Date</label>
			  	<div class="col-10">
			    	<input readonly class="form-control" type="date" value=<?php echo $orderDate;?> name="orderDate">
				</div>
			</div>
	  		<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Due Date</label>
			  	<div class="col-10">
			    	<input readonly class="form-control" type="date" value=<?php echo $dueDate;?> name="dueDate">
				</div>
			</div>
		  		<div class="form-group">
	    		<label for="exampleSelect1">Order Status</label>
	    		<select class="form-control" name="currentStatus" id="upd-stat">
	    			<option>No Selection</option>
		    		<option value="Pending">Pending</option>
		    		<option value="In Progress">In Progress</option>
		    		<option value="Dispatched">Dispatched</option>
	    		</select>
	    		<script type="text/javascript">window.onload = function() {document.getElementById('upd-stat').value = "<?php echo $orderStatus; ?>" }</script>
	  		</div>
	  		<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Product Category</label>
			  	<div class="col-10">
			    	<input class="form-control" type="text" value="<?php echo $prodCateg;?>" readonly>
				</div>
			</div>
	  		<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Quantity Ordered</label>
			  	<div class="col-10">
			    	<input class="form-control" type="number" value="<?php echo $quant;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Total Price</label>
			  	<div class="col-10">
			    	<input class="form-control" type="number" value="<?php echo $price;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Length(m)</label>
			  	<div class="col-10">
			    	<input class="form-control" type="number" value="<?php echo $len;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Thickness(mm)</label>
			  	<div class="col-10">
			    	<input class="form-control" type="number" value="<?php echo $thick;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Weigth(kg)</label>
			  	<div class="col-10">
			    	<input class="form-control" type="number" value="<?php echo $wt;?>" readonly>
				</div>
			</div>
		<?php
		$prodCategId = $_POST['viewCatId'];
		switch ($prodCategId) {
			case '1':
				$query = "	Select OutsideDiameter_mm
							From productround
							where ProductID = '$productID'";
				$result = mysqli_fetch_array(mysqli_query($db, $query));
				$od = $result['OutsideDiameter_mm'];
				?>
				<div class="form-group row">
				  	<label for="example-date-input" class="col-2 col-form-label">Outside Diameter(mm)</label>
				  	<div class="col-10">
				    	<input class="form-control" type="number" value="<?php echo $od;?>" readonly>
					</div>
				</div>
				<?php
				break;
			case '2':
				$query = "	Select SideA_mm, SideB_mm
							From productrectsquare
							where ProductID = '$productID'";
				$result = mysqli_fetch_array(mysqli_query($db, $query));
				$sA = $result['SideA_mm'];
				$sB = $result['SideB_mm'];
				?>
				<div class="form-group row">
				  	<label for="example-date-input" class="col-2 col-form-label">Side A(mm)</label>
				  	<div class="col-10">
				    	<input class="form-control" type="number" value="<?php echo $sA;?>" readonly>
					</div>
				</div>
				<div class="form-group row">
				  	<label for="example-date-input" class="col-2 col-form-label">Side B(mm)</label>
				  	<div class="col-10">
				    	<input class="form-control" type="number" value="<?php echo $sB;?>" readonly>
					</div>
				</div>
				<?php
				break;
			case '3':
				$query = "	Select Width_m
							From productcoil
							where ProductID = '$productID'";
				$result = mysqli_fetch_array(mysqli_query($db, $query));
				$width = $result['Width_m'];
				?>
				<div class="form-group row">
				  	<label for="example-date-input" class="col-2 col-form-label">Width(m)</label>
				  	<div class="col-10">
				    	<input class="form-control" type="number" value="<?php echo $width;?>" readonly>
					</div>
				</div>
				<?php
			default:
				break;
		}
		?>
		<button type="submit" class="btn btn-primary">Save Changes</button>
		</form>
		<?php
	}

?>