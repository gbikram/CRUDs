<?php
	include("common.php");
		top();
		checkState("dashboard.php", true);
		loginForm();
		
	function loginForm() { ?>
		<h1 id="app-head">ORDER PORTAL</h1>
		<div id = "login-form">
			<div class="container">
			  <form action="signin.php" method="post">
			    <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
			      <div class="col-sm-10">
			        <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" required="true">
			      </div>
			    </div>
			    <div class="form-group row">
			      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
			      <div class="col-sm-10">
			        <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password" required="true">
			      </div>
			    </div>
			    <div class="form-group row">
			      <div class="offset-sm-2 col-sm-10">
			        <button type="submit" class="btn btn-primary">Sign in</button>
			      </div>
			    </div>
			    <?php 
			    	if(isset($_GET['error']) == true) {
						echo('<p>Username/Password not  found</p>');
					}
				?>
			  </form>
			</div>
		</div>
		<?php
	}
?>