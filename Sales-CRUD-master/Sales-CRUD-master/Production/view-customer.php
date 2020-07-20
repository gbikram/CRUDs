<?php 
	include("common.php");
	top();
	navbar();
	checkState("login.php", false);
	CreateCustomerForm();
	
	function CreateCustomerForm() { ?>
		<style>
		table, th, td {
			border: 2px solid black;

		}
	</style>
 		<h2 class="formHead">View Customer</h2>
 		<div id="full-order-form">
	 		<h3 class="form-section">Customer Details</h3>
	 		<fieldset class="form-group">
			    <legend id="custRad">Select Customer Type</legend>
			    <div class="form-check">
			      <label class="form-check-label">
			        <input type="radio" class="form-check-input" name="optionsRadios" id="indiv" value="" onclick="getCustomerType()">
			        Individual
			      </label>
			    </div>
			    <div class="form-check">
			    <label class="form-check-label">
			        <input type="radio" class="form-check-input" name="optionsRadios" id="org" onclick="getCustomerType()">
			       Organization
			      </label>
			    </div>
			    <div class="form-check" style="display: none;">
			    <label class="form-check-label">
			        <input type="radio" class="form-check-input" name="optionsRadios" checked>
			      </label>
			    </div>
			    <p id="demo"></p>
			    <script type="text/javascript">
			    	function getCustomerType() {
			    		document.getElementById("newCustform").style.display = 'block';
			    		if(document.getElementById("org").checked) {
			    			document.getElementById("lab_custFname").style.display = 'inline-block';
			    			document.getElementById("lab_orgName").style.display = 'none';
			    		} else if (document.getElementById("indiv").checked) {
			    			document.getElementById("lab_custFname").style.display = 'none';
			    			document.getElementById("lab_orgName").style.display = 'inline-block';
			    		}
			    	}
			    </script>
			</fieldset>
	 		<form action="newCustform.php" method="post" id="newCustform">
		 		<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_custFname">
				    <?php
						$db = new mysqli('localhost', 'root', '', 'orderportal');
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						$sql = "Select c.CustomerID, co.OrgName, c.Email, c.Phone FROM customer c inner join customer_org co on c.CustomerID = co.CustomerID";
						$result = $db->query($sql);

						if (mysqli_num_rows($result) > 0) {
							echo "<table class='table'><tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Email</th></tr>";
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>" . $row['CustomerID']. "</td><td>" . $row['OrgName']."</td><td>" . $row['Phone']. "</td><td>" . $row['Email']. "</td></tr>";
						}
							echo "</table>";
						} else {
							echo "0 results";
						}
					?>
					</label>
				</div>

				<div class="form-group row" >
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_orgName">
					  <?php
							$sql = "Select c.CustomerID, ci.FName, ci.LName, c.Email,  c.Phone FROM Customer c inner join customer_indiv ci on c.CustomerID = ci.CustomerID";
							$result = $db->query($sql);

							if (mysqli_num_rows($result) > 0) {
							echo "<table class='table'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th></tr>";
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>" . $row["CustomerID"]. "</td><td>" . $row["FName"]. "</td><td>" .$row["LName"]."</td><td>" . $row["Phone"]. "</td><td>" . $row["Email"]. "</td></tr>";
							}
							echo "</table>";
							} else {
							echo "0 results";
							}
					  ?>
				  </label>
				</div>


			</form>
		</div>
 		<?php
	}
?>