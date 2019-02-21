<?php
session_start();
if($_SESSION['user_type']!=1){
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
    <title>Admin Users</title>
    <!-- Main Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #050936">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <img src="images/logonav.png"><strong style="color: white">Control Panel</strong>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto mt-2 mt-lg">
                <li class="nav-item active">
                    <strong><a href="index.php" class="nav-link active">Home</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="adminListings.php" class="nav-link active">Listings</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="adminPosts.php" class="nav-link active">Posts</a></strong>
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
                    <button class="btn btn-outline-primary" name="c_user" data-toggle="modal" data-target="#createuModal">Create User</button>
                </div>
                <!-- search bar -->
                <div class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" id="se_input" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="se_submit">Search</button>    
                </div>
            </div> 
        </div>
        <!-- Create User Modal -->
        <div class="modal fade" id="createuModal" tabindex="-1" role="dialog" aria-labelledby="createuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createuModal">Create user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <label>First Name</label>
                        <input id="cr_name" type="text" name="name" maxlength="50" class="form-control" placeholder="*First Name">
                        <br>
                        <label>Last Name</label>
                        <input id="cr_lastname" type="text" maxlength="50" name="last_name" class="form-control" placeholder="*Last Name">
                        <br>
                        <label>Username</label>
                        <input id="cr_user" type="text" maxlength="60" name="username" class="form-control" placeholder="*User Name">
                        <br>
                        <label>email</label>
                        <input id="cr_email" type="email" maxlength="62" name="email" class="form-control" minlength="10" placeholder="*email">
                        <br>
                        <label>Phone Number</label>
                        <input id="cr_celNum" type="number" maxlength="10" name="celNum" class="form-control" step="1" placeholder="*Phone Number">
                        <br>
                        <label>Password:</label>
                        <input id="cr_pass" type="password" maxlength="72" name="password" class="form-control" placeholder="*Password (at least 6 characters)">
                        <br>
                        <label>Confirm Password:</label>
                        <input id="cr_passVer" type="password" maxlength="72" name="confirm_password" class="form-control" placeholder="*Confirm Password">
                        <small id="passHelp" class="form-text text-muted">Ensure both password fields contain the same password</small>
                        <br>
                        
                    </div>
                    <div class="modal-footer">
                        <small id="cr_errorHelp" style="width:90%;" class="form-text text-muted"></small>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="cr_submit">Create User</button>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Update User Modal -->
        <div class="modal fade" id="updateuModal" tabindex="-1" role="dialog" aria-labelledby="updateuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateuModal">Update an user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            </select>
                            <input id="up_name" type="text" maxlength="50" class="form-control" name="name" placeholder="*Name">
                            <br>
                            <input id="up_lastname" type="text" maxlength="50" class="form-control" name="last_name" placeholder="*Last Name">
                            <br>
                            <input id="up_user"  type="text" maxlength="60" class="form-control" name="username" placeholder="*User Name">
                            <br>
                            <input id="up_email" type="email"  maxlength="62" name="email" class="form-control" minlength="10" placeholder="*E-Mail">
                            <br>
                            <input id="up_celNum" type="number"  maxlength="10" name="celNum" class="form-control" step="1" placeholder="*Phone Number">
                            <br>
                            <small id="passHelp" class="form-text text-muted">Ensure both password fields contain the same password</small>
                            <input id="up_pass" type="password"  maxlength="72" name="password" class="form-control" placeholder="New Password (at least 6 characters)">
                            <br>
                            <input id="up_passVer" class="form-control" type="password"  maxlength="72" name="confirm_password" placeholder="*Confirm New Password">
                            <br>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <small id="up_errorHelp" style="width:90%;" class="form-text text-muted"></small>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="up_submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remove User Modal, when the ID is selected the whole user will be removed -->
        <div class="modal fade" id="removeuModal" tabindex="-1" role="dialog" aria-labelledby="removeuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id2="re_title" id="removeuModal">Remove User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <div class="form-group" action="#" method="POST">
                            <br>
                            <small id="re_errorHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="re_submit">Yes</button>
                    </div>
                </div>
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

     <script src="javascript/adminUsers.js"></script> 
</body>
</html>