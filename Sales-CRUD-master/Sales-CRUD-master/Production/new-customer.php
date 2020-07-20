<?php 
	include("common.php");
	top();
	navbar();
	checkState("login.php", false);
	CreateCustomerForm();
	
	function CreateCustomerForm() { ?>
 		<h2 class="formHead">Add Customer</h2>
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
			       Company
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
			    		if(document.getElementById("indiv").checked) {
			    			document.getElementById("lab_custFname").style.display = 'inline-block';
			    			document.getElementById("lab_custLname").style.display = 'inline-block';
			    			document.getElementById("inp_custFname").style.display = 'block';
			    			document.getElementById("inp_custLname").style.display = 'block';
			    			document.getElementById("lab_orgName").style.display = 'none';
			    			document.getElementById("inp_orgName").style.display = 'none';
			    		} else if (document.getElementById("org").checked) {
			    			document.getElementById("lab_custFname").style.display = 'none';
			    			document.getElementById("lab_custLname").style.display = 'none';
			    			document.getElementById("inp_custFname").style.display = 'none';
			    			document.getElementById("inp_custLname").style.display = 'none';
			    			document.getElementById("lab_orgName").style.display = 'inline-block';
			    			document.getElementById("inp_orgName").style.display = 'block';
			    		}
			    	}
			    </script>
			</fieldset>
	 		<form action="newCustform.php" method="post" id="newCustform">
		 		<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_custFname">First Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_custFname" name="f_name">
				  </div>
				</div>
				<div class="form-group row" >
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_custLname">Last Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_custLname" name="l_name">
				  </div>
				</div>
				<div class="form-group row" >
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_orgName">Organization Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_orgName" name="org_name">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-email-input" class="col-2 col-form-label">Email</label>
				  <div class="col-10">
				    <input class="form-control" type="email" required="true" name="email">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label">Phone</label>
				  <div class="col-10">
				    <input class="form-control" type="text" name="phone" required="true" pattern=".{10}" title="Input 10 Digit Number">
				  </div>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
 		<?php
	}
?>