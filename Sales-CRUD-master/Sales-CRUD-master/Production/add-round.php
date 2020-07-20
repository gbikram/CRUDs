<?php 
	include("common.php");
	top();
	CreateCustomerForm();
	
	function CreateCustomerForm() { ?>
 		<h2 class="formHead">Create Order</h2>
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
			    		document.getElementById("newOrderform").style.display = 'block';
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
	 		<form action="" id="newOrderform">
		 		<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_custFname">First Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_custFname">
				  </div>
				</div>
				<div class="form-group row" >
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_custLname">Last Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_custLname">
				  </div>
				</div>
				<div class="form-group row" >
				  <label for="example-text-input" class="col-2 col-form-label" id="lab_orgName">Organization Name</label>
				  <div class="col-10">
				    <input class="form-control" type="text" id="inp_orgName">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-email-input" class="col-2 col-form-label">Email</label>
				  <div class="col-10">
				    <input class="form-control" type="email">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-number-input" class="col-2 col-form-label">Phone</label>
				  <div class="col-10">
				    <input class="form-control" type="text">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-date-input" class="col-2 col-form-label">Date</label>
				  <div class="col-10">
				    <input class="form-control" type="date">
				  </div>
				   <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
 		<?php
	}
?>