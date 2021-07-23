<?php    
	require 'dbconnection.php'; 
?>
<!doctype html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" >
		<link href="assets/css/all.css" rel="stylesheet" >
		<link href="assets/css/bootstrap-table.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet" >
	</head>
	<body>
		<?php
			if(isset($_SESSION['valid'])) {
		?>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5" style="background-color: #e3f2fd;">
				<div class="container">
					<!-- <a class="navbar-brand" href="#">Navbar</a> -->
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link" href="userlist.php">Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="rolelist.php">Roles</a>
							</li>
							<!-- <li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Users
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<li><a class="dropdown-item" href="userlist.php">List</a></li>
									<li><a class="dropdown-item" href="user.php">Add New User</a></li>
									<li><a class="dropdown-item" href="createuser.php">Add User</a></li>
								</ul>
							</li> -->
						</ul>
						<div class="d-flex">
							<p>Welcome, <?php echo $_SESSION['name']; ?></p>&nbsp;<a href="logout.php">Logout</a>
						</div>	
					</div>
				</div>
			</nav>
		<?php
			}
		?>
		<div class="container">