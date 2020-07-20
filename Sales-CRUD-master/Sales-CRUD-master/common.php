<?php
	$db = new mysqli('localhost', 'root', '', 'testdb');
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	session_start();
	
	function top() { ?>
		<!DOCTYPE html lang="en">
		<html>
			<head>
				<meta charset="utf-8" />
				<title>Business Admin</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
				<link rel="stylesheet" href="style.css">
				<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
				<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
			</head>
		<?php
	}
			function navbar() {	?>
				<body>
					<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
					  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>
					  <a class="navbar-brand" href="#">Order Portal</a>
					  <div class="collapse navbar-collapse" id="navbarNav">
					    <ul class="navbar-nav">
					      	<li class="nav-item dropdown">
					       		<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          	Customers
					        	</a>
					        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					        		<a class="dropdown-item" href="new-customer.php">Add New Customer</a>
					        		<a class="dropdown-item" href="view-customer.php">View Customers</a>
					        	</div>
					      	<li class="nav-item dropdown">
					        	<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          	Orders
					        	</a>
					        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					        		<a class="dropdown-item" href="viewOrders.php?stat=all">View Orders</a>
					        		<a class="dropdown-item" href="indivorder.php?type=o">Add Order(Company)</a>
					        		<a class="dropdown-item" href="indivorder.php?type=i">Add Order(Individual)</a>
					        	</div>
					      	</li>
					      	<li class="nav-item">
	        					<a class="nav-link" href="logout.php" id="app-logout">Logout</a>
	      					</li>
					    </ul>
					  </div>
					</nav>
				<?php
			}				

	function checkState($page, $state) {
		if($state) {
			if(isset($_SESSION["status"])) {
				header("Location: ".$page);
			}
		} else {
			if(!isset($_SESSION["status"])) {
				header("Location: ".$page);
			}

		}
	}
?>