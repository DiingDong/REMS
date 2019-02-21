<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="author">
	<link rel="icon" href="images/favicon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>Home Page</title>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #050936">
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <img src="images/logonav.png"><strong style="color: white"><?php echo $_SESSION['username'] ?></strong>
                </li>
            </ul>
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active">
			    	<strong><a class="nav-link active" href="index.php">Home<span class="sr-only">(current)</span></a></strong>
			 	</li>
			 	<li class="nav-item active">
					<strong><a class="nav-link active" href="listings.php">Listings</a></strong>
				</li>
				<li class="nav-item active">
			    	<strong><a class="nav-link active" href="users.php">Agents</a></strong>
				</li>
			</ul>
			<br>
			<ul class="navbar-nav">
				<li style="padding-right: 5px;"><?php if (isset($_SESSION['user_type']) && $_SESSION['user_type']) {
				echo "
					<div class='dropdown'>
						<button class='btn btn-outline-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Control Panel</button>
						<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
							<a class='dropdown-item' href='adminUsers.php'>Users</a>
							<a class='dropdown-item' href='adminListings.php'>Listings</a>
							<a class='dropdown-item' href='adminPosts.php'>Posts</a>
						</div>
					</div>
				";
				} ?></li>
				<li><a href="logout.php" class="btn btn-outline-danger">Log Out</a></li>
			</ul>
			
		</div>
	</nav>
	<!-- Jumbotron -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-auto">
					<h1 class="display-5">Real Estate Management System</h1>
					<h4>Welcome <?php echo $_SESSION['username'] ?></h4>
				</div>
				<div class="col-auto">
					<img src="images/logo.jpg">
				</div>	
			</div>
		</div>
	</div>
</head>
<body>
	<div class="container">
		<!-- column for newsfeed -->
		<div class="row">
			<!-- column for newsfeed -->			
			<div id="postsList" style="overflow-y: scroll; height:400px;" class="col">
				<h3 class='title'>Messages</h3>


			</div>
			<!-- column for post input -->
			<div class="col-4">
				<!-- Adjust using js or php to display current user logged in -->				
				<h5 class="title">Make a post here, <?php  echo $_SESSION['username']?></h5>
				<div class="form-group">
					<label>Subject:</label>
					<input class="form-control" type="text" id="subject"  maxlength="45" placeholder="Subject">
				</div>
				<div class="form-group">
					<label>Message:</label>
					<textarea class="form-control" id="message" rows="4" cols="50" maxlength="255" placeholder="Message"></textarea>
				</div>
				<div class="form-group">
					<div class="container">
						<div class="row">
							<div style="padding-right: 15px;">
								<button class="btn btn-primary" id="submit">Post</button>
							</div>
							<div>
								<button class="btn btn-secondary" id="clear">Clear</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="javascript/index.js"></script> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>