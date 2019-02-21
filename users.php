<?php
session_start();
if(!isset($_SESSION['userID'])){
  header("location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <!-- CSS/JS Online Links -->
    <link rel="icon" href="images/favicon.png" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Users</title>
    <!-- Main Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #050936">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <img src="images/logonav.png"><strong style="color: white"><?php echo $_SESSION['username']?></strong>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto mt-2 mt-lg">
                <li class="nav-item active">
                    <strong><a href="index.php" class="nav-link active">Home</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="listings.php" class="nav-link active">Listings</a></strong>
                </li>
            </ul>
            <a class="btn btn-outline-danger" href="logout.php">Log Out</a>
        </div>
    </nav>
</head>
<body>
    <div class="container">
        <div style="padding: 10px">
           <div class="row">
               <div class="col" style="padding: 10px">
                    
                </div>
                <!-- search bar -->
                <form class="form-inline my-2 my-lg-0" action="#" method="GET">
                    <input class="form-control mr-sm-2" type="text" id="se_input" placeholder="Search by name">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="se_submit">Search</button>    
                </form>
            </div> 
        </div>
        <!-- Database Table, use a $row with a while cycle to summon everything but the passwords on the screen-->
        <div class="">
            <table id="usersTable" class="table table-bordered table-striped">
                
            </table>
        </div>
        <!-- Database Table end -->
    </div>
    <!-- Main form container-->

     <script src="javascript/users.js"></script> 
</body>
</html>