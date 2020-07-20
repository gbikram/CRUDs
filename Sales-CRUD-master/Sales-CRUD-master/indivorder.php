<?php 
	include("common.php");
	top();
	navbar();
	checkState("login.php", false);
	$custList = getCustomers_Org($db);
	$custType = "Company";
	$selectedProduct = "";
	if($_GET['type'] == "i") {
		$custList = getCustomers_Indiv($db);
		$custType = "Individual";
	}

	new_order_indiv($db, $custList, $custType);
	
	function new_order_indiv($db, $customerList, $custType) { ?>
		<h2 class="formHead">Create Order - <?php echo $custType ?></h2>
		<p>If new customer, <a href="new-customer.php">click here</a> to add to database.</p>
		<form action="submitOrder.php" id="newOrderForm" method="post">
	  		<div class="form-group">
	    		<label for="exampleSelect1">Select Customer</label>
	    		<select class="form-control" name="customerId">
	    			<?php 
	    			echo $customerList;
	    			?>
	    		</select>
	  		</div>
	  		<div class="form-group">
	    		<label for="exampleSelect1">Select Product</label>
	    		<select class="form-control" id="ProductSelection" onchange="dynamicProdForm()" name="productType">
		    		<option>No Selection</option>
		    		<option value="1">Round Tube</option>
		    		<option value="2">Rectangular/Square</option>
		    		<option value="3">Coil</option>
	    		</select>
	  		</div>
	  		<script type="text/javascript">
	  			function dynamicProdForm() {
	  				document.getElementById("productDetails").style.display = "block";
	  				var prod = document.getElementById("ProductSelection").value;
	  				if(prod == 1) {
	  					document.getElementById("lab-sideA").style.display = "none";
	  					document.getElementById("lab-sideB").style.display = "none";
	  					document.getElementById("lab-width").style.display = "none";
	  					document.getElementById("lab-od").style.display = "inline-block";
	  					document.getElementById("inp-sideA").style.display = "none";
	  					document.getElementById("inp-sideB").style.display = "none";
	  					document.getElementById("inp-width").style.display = "none";
	  					document.getElementById("inp-od").style.display = "inline-block";
	  					<?php $selectedProduct = "round"; ?>
	  				} else if(prod == 2) {
	  					document.getElementById("lab-sideA").style.display = "inline-block";
	  					document.getElementById("lab-sideB").style.display = "inline-block";
	  					document.getElementById("lab-width").style.display = "none";
	  					document.getElementById("lab-od").style.display = "none";
	  					document.getElementById("inp-sideA").style.display = "block";
	  					document.getElementById("inp-sideB").style.display = "block";
	  					document.getElementById("inp-width").style.display = "none";
	  					document.getElementById("inp-od").style.display = "none";
	  					<?php $selectedProduct = "rect"; ?>
	  				} else if (prod == 3) {
	  					document.getElementById("lab-sideA").style.display = "none";
	  					document.getElementById("lab-sideB").style.display = "none";
	  					document.getElementById("lab-width").style.display = "inline-block";
	  					document.getElementById("lab-od").style.display = "none";
	  					document.getElementById("inp-sideA").style.display = "none";
	  					document.getElementById("inp-sideB").style.display = "none";
	  					document.getElementById("inp-width").style.display = "inline-block";
	  					document.getElementById("inp-od").style.display = "none";
	  					<?php $selectedProduct = "coil"; ?>
	  				} else {
	  					document.getElementById("productDetails").style.display = "none";
	  					<?php $selectedProduct = ""; ?>
	  				}

	  			}
	  		</script>
	  		<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Order Date</label>
			  	<div class="col-10">
			    	<input class="form-control" type="date" value="yyyy-mm-dd" name="orderDate">
				</div>
			</div>
	  		<div class="form-group row">
			  	<label for="example-date-input" class="col-2 col-form-label">Due Date</label>
			  	<div class="col-10">
			    	<input class="form-control" type="date" value="yyyy-mm-dd" name="dueDate">
				</div>
			</div>
		  		<div class="form-group">
	    		<label for="exampleSelect1">Order Status</label>
	    		<select class="form-control" name="currentStatus">
	    			<option>No Selection</option>
		    		<option value="Pending">Pending</option>
		    		<option value="In Progress">In Progress</option>
		    		<option value="Dispatched">Dispatched</option>
	    		</select>
	  		</div>
	  		<div id="productDetails">
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label">Length(m)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-len" value="0" name="length">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label">Thickness(mm)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-thick" value="0" name="thick">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label" id="lab-sideA">Side A(mm)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-sideA" value="0" name="sA">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label" id="lab-sideB">Side B(mm)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-sideB" value="0" name="sB">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label" id="lab-od">Outside Diameter(mm)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-od" value="0" name="oDia">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label" id="lab-width">Width(m)</label>
				  <div class="col-10">
				    <input class="form-control" type="number" step="0.01" id="inp-width" value="0" name="width">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label">Quantity</label>
				  <div class="col-10">
				    <input class="form-control" type="number" value="0" name="quan" id="inp-quan">
				  </div>
				</div>
				<button type="button" class="btn btn-primary" onclick="setWeightPrice()">Next</button>
				<div id="calc-values" style="display: none;">
					<div class="form-group row">
					  <label for="example-number-input" class="col-2 col-form-label">Individual Weight(kg)</label>
					  <div class="col-10">
					    <input class="form-control" type="number" readonly id="calc-wt" name="weight">
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-number-input" class="col-2 col-form-label">Price/Kg</label>
					  <div class="col-10">
					    <input class="form-control" type="number" readonly id="calc-price-perKg" name="perPrice">
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-number-input" class="col-2 col-form-label">Total Price</label>
					  <div class="col-10">
					    <input class="form-control" type="number" readonly id="calc-total" name="totPrice">
					  </div>
					  <button type="submit" class="btn btn-primary">Submit</button>
					</div>

				</div>
				<script type="text/javascript">
					function setWeightPrice() {
						document.getElementById("calc-values").style.display = "block";
						var prodSel = document.getElementById("ProductSelection").value;
						var od = 0;
						var weight = 0;
						var len = document.getElementById("inp-len").value;
						var thick = document.getElementById("inp-thick").value;
						var quan = document.getElementById("inp-quan").value;
						switch(prodSel) {
							case "1":
								od = document.getElementById("inp-od").value;
								weight = (od - thick) * thick * 0.02465 * len;
								break;
							case "2":
								var sideA = parseInt(document.getElementById("inp-sideA").value);
								var sideB = parseInt(document.getElementById("inp-sideB").value);
								od = ((2 * (sideA + sideB)) * 4.4) / 14;
								weight = (od - thick) * thick * 0.02465 * len;
								break;
							case "3":
								var width = document.getElementById("inp-width").value;
								weight = 7.85 * thick * width * len;
								break;
						}
						document.getElementById("calc-wt").value = weight;
						$(function () 
							{
								$.ajax({
									url: 'getPrice.php',
									data: "categ=" + prodSel,
									success: function(data)
									{
										$("#calc-price-perKg").val(data);
										$("#calc-total").val(data * weight * quan);
									} ,
									error: function()
									{
										alert();
										$("#calc-price-perKg").val("0.00");
									}
								});
							});
					}
				</script>
			</div>
		</form>

		<?php
	}

	function getCustomers_Indiv($db) {
		$query = '	Select CustomerID, CONCAT(FName, " ", LName) as Full_Name
					From Customer_Indiv
					Order By Full_Name';
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0) {
			$select = "<option>No Selection</option>";
			while($rs = mysqli_fetch_array($result)) {
				$select .= '<option value="'.$rs['CustomerID'].'">'.$rs['Full_Name'].'</option>';
			}
			return $select;
		}
	}

	function getCustomers_Org($db) {
		$query = '	Select CustomerID, OrgName
					From customer_org
					Order By OrgName';
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0) {
			$select = "<option>No Selection</option>";
			while($rs = mysqli_fetch_array($result)) {
				$select .= '<option value="'.$rs['CustomerID'].'">'.$rs['OrgName'].'</option>';
			}
			return $select;
		}
	}
?>